<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Assessment;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class AssessmentController extends Controller
{
    private const PAGE_SIZE = 10;

    private const SCALE_LABELS = [
        1 => 'Sangat Tidak Suka',
        2 => 'Tidak Suka',
        3 => 'Netral / Ragu-ragu',
        4 => 'Suka',
        5 => 'Sangat Suka',
    ];

    /**
     * Halaman Informasi Tes (sebelum siswa mulai mengerjakan).
     */
    public function info(): View
    {
        $totalQuestions = Question::count();
        $estimatedMinutes = 5;

        return view('tes.informasi', [
            'badge' => 'Asesmen Minat Bakat',
            'title' => 'Tes Minat & Bakat (RIASEC)',
            'description' => 'Asesmen ini dirancang untuk memetakan kepribadian, minat aktivitas, '
                . 'dan potensi karier ideal berdasarkan teori Holland Code.',

            'stats' => [
                ['icon' => 'question', 'value' => "{$totalQuestions} Soal", 'label' => 'Jumlah Pertanyaan'],
                ['icon' => 'clock', 'value' => "{$estimatedMinutes} Menit", 'label' => 'Estimasi Waktu'],
                ['icon' => 'scale', 'value' => 'Skala 1 - 5', 'label' => 'Tipe Jawaban'],
                ['icon' => 'rule', 'value' => 'Tanpa Skoring', 'label' => 'Tidak Ada Benar/Salah'],
            ],

            'instructions' => [
                'Jawablah secara jujur sesuai kondisi diri Anda saat ini.',
                'Tidak ada jawaban benar atau salah dalam tes ini.',
                'Usahakan menjawab seluruh pertanyaan tanpa ada yang terlewat.',
                'Kemajuan tes akan tersimpan otomatis jika terjadi kendala jaringan.',
            ],

            'tip' => 'Kerjakan di tempat tenang untuk hasil psikogram optimal.',

            'dimensionTitle' => 'Analisis 6 Dimensi Holland',
            'dimensionSubtitle' => 'Realistik, Investigatif, Artistik, Sosial, Enterprising, & Konvensional',
        ]);
    }

    /**
     * Mulai tes: pakai tes yang masih berjalan, atau buat yang baru.
     */
    public function start(Request $request): RedirectResponse
    {
        $user = $request->user();

        $assessment = $user->assessments()
            ->where('status', Assessment::STATUS_IN_PROGRESS)
            ->latest()
            ->first();

        if (! $assessment) {
            $assessment = $user->assessments()->create([
                'status' => Assessment::STATUS_IN_PROGRESS,
                'started_at' => now(),
            ]);
        }

        // Lanjut dari soal pertama yang belum dijawab.
        $answeredIds = $assessment->answers()->pluck('question_id');
        $next = Question::whereNotIn('id', $answeredIds)->orderBy('sort_order')->first();

        return redirect()->route('tes.soal', [
            'assessment' => $assessment->id,
            'no' => $next?->sort_order ?? 1,
        ]);
    }

    /**
     * Tampilkan satu soal.
     */
    public function show(Request $request, Assessment $assessment, int $no): View|RedirectResponse
    {
        $this->authorizeAssessment($request, $assessment);

        if ($assessment->isCompleted()) {
            return redirect()->route('dashboard');
        }

        $total = Question::count();
        $question = Question::where('sort_order', $no)->firstOrFail();

        $answeredIds = $assessment->answers()->pluck('question_id')->all();
        $answeredNos = Question::whereIn('id', $answeredIds)->pluck('sort_order')->all();

        $selected = $assessment->answers()->where('question_id', $question->id)->value('value');

        // Panel "Nomor Soal": jendela 10 soal yang memuat soal aktif.
        $windowStart = intdiv($no - 1, self::PAGE_SIZE) * self::PAGE_SIZE + 1;
        $windowEnd = min($windowStart + self::PAGE_SIZE - 1, $total);

        return view('tes.soal', [
            'assessment' => $assessment,
            'question' => $question,
            'no' => $no,
            'total' => $total,
            'selected' => $selected,
            'labels' => self::SCALE_LABELS,
            'answeredNos' => $answeredNos,
            'answeredCount' => count($answeredNos),
            'windowStart' => $windowStart,
            'windowEnd' => $windowEnd,
            'isFirst' => $no <= 1,
            'isLast' => $no >= $total,
        ]);
    }

    /**
     * Simpan jawaban soal ini, lalu pindah soal atau kirim jawaban.
     */
    public function answer(Request $request, Assessment $assessment, int $no): RedirectResponse
    {
        $this->authorizeAssessment($request, $assessment);

        if ($assessment->isCompleted()) {
            return redirect()->route('dashboard');
        }

        $request->validate([
            'jawaban' => ['nullable', 'integer', 'between:1,5'],
            'aksi' => ['nullable', 'string', 'max:20'],
        ]);

        $total = Question::count();
        $question = Question::where('sort_order', $no)->firstOrFail();

        if ($request->filled('jawaban')) {
            Answer::updateOrCreate(
                ['assessment_id' => $assessment->id, 'question_id' => $question->id],
                ['value' => (int) $request->input('jawaban')],
            );
        }

        $aksi = (string) $request->input('aksi', '');

        if ($aksi === 'kirim') {
            return $this->submit($assessment, $no, $total);
        }

        $target = match (true) {
            $aksi === 'sebelumnya' => $no - 1,
            $aksi === 'selanjutnya' => $no + 1,
            str_starts_with($aksi, 'ke-') => (int) substr($aksi, 3),
            default => $no,
        };

        $target = max(1, min($total, $target));

        return redirect()->route('tes.soal', ['assessment' => $assessment->id, 'no' => $target]);
    }

    /**
     * Kirim jawaban: pastikan semua soal terjawab, hitung skor per dimensi Holland.
     */
    private function submit(Assessment $assessment, int $no, int $total): RedirectResponse
    {
        $answered = $assessment->answers()->count();

        if ($answered < $total) {
            return redirect()
                ->route('tes.soal', ['assessment' => $assessment->id, 'no' => $no])
                ->with('error', 'Masih ada ' . ($total - $answered) . ' soal yang belum dijawab.');
        }

        $totals = Answer::query()
            ->where('answers.assessment_id', $assessment->id)
            ->join('questions', 'questions.id', '=', 'answers.question_id')
            ->selectRaw('questions.category as category, SUM(answers.value) as total')
            ->groupBy('questions.category')
            ->pluck('total', 'category');

        $counts = Question::selectRaw('category, COUNT(*) as n')->groupBy('category')->pluck('n', 'category');
        $order = ['R', 'I', 'A', 'S', 'E', 'C'];
        $scores = [];
        foreach ($order as $c) {
            $scores[$c] = (int) ($totals[$c] ?? 0);
        }

        // Tiga skor tertinggi = kode Holland (seri diurutkan R, I, A, S, E, C).
        $ranked = $order;
        $ratio = fn($c) => $scores[$c] / max(($counts[$c] ?? 1) * 5, 1);
        usort($ranked, fn($a, $b) => [$ratio($b), array_search($a, $order)] <=> [$ratio($a), array_search($b, $order)]);
        $holland = implode('', array_slice($ranked, 0, 3));

        $assessment->update([
            'status' => Assessment::STATUS_COMPLETED,
            'completed_at' => now(),
            'score_r' => $scores['R'],
            'score_i' => $scores['I'],
            'score_a' => $scores['A'],
            'score_s' => $scores['S'],
            'score_e' => $scores['E'],
            'score_c' => $scores['C'],
            'holland_code' => $holland,
        ]);

        // Halaman Hasil dibuat di tahap berikutnya.
        if (Route::has('tes.hasil')) {
            return redirect()->route('tes.hasil', ['assessment' => $assessment->id]);
        }

        return redirect()->route('dashboard');
    }

    /**
     * Halaman Hasil Tes: interpretasi, karier, dan jurusan berdasarkan kode Holland.
     */
    public function hasil(Request $request, Assessment $assessment): View|RedirectResponse
    {
        $this->authorizeAssessment($request, $assessment);

        if (! $assessment->isCompleted() || strlen((string) $assessment->holland_code) < 3) {
            return redirect()->route('tes.info');
        }

        $types = config('holland.types');
        $letters = str_split($assessment->holland_code);
        [$first, $second, $third] = [$types[$letters[0]], $types[$letters[1]], $types[$letters[2]]];

        $names = [$first['name'], $second['name'], $third['name']];

        $scores = [];
        foreach (['R', 'I', 'A', 'S', 'E', 'C'] as $c) {
            $scores[] = [
                'code' => $c,
                'name' => $types[$c]['name'],
                'score' => (int) $assessment->{'score_' . strtolower($c)},
                'max' => Question::where('category', $c)->count() * 5,
            ];
        }

        return view('tes.hasil', [
            'assessment' => $assessment,
            'completedText' => $assessment->completed_at->locale('id')->translatedFormat('j F Y'),
            'dominantCode' => implode(' • ', $letters),
            'dominantLabel' => implode(' - ', $names),
            'profileTitle' => "Profil Utama: {$first['name']} & {$second['name']}",
            'profileDescription' => $first['description'],
            'traits' => $first['traits'],
            'careers' => [$first['careers'][0], $first['careers'][1], $second['careers'][0]],
            'majors' => [$first['majors'][0], $first['majors'][1], $second['majors'][0]],
            'scores' => $scores,
        ]);
    }

    private function authorizeAssessment(Request $request, Assessment $assessment): void
    {
        abort_unless($assessment->user_id === $request->user()->id, 403);
    }
}
