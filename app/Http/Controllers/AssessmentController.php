<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AssessmentController extends Controller
{
    /**
     * Halaman Informasi Tes (sebelum siswa mulai mengerjakan).
     */
    public function info(): View
    {
        // TODO: jumlah soal nanti diambil dari tabel questions (Question::count()).
        $totalQuestions = 60;
        $estimatedMinutes = 25;

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
}
