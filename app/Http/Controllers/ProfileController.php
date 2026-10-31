<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Assessment;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    private const TYPES = [
        'R' => 'Realistik',
        'I' => 'Investigatif',
        'A' => 'Artistik',
        'S' => 'Sosial',
        'E' => 'Enterprising',
        'C' => 'Konvensional',
    ];

    /**
     * Halaman Profil (kartu profil, tes terakhir, pengaturan, keluar).
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        $completedCount = $user->assessments()
            ->where('status', Assessment::STATUS_COMPLETED)
            ->count();

        $last = $user->assessments()
            ->where('status', Assessment::STATUS_COMPLETED)
            ->latest('completed_at')
            ->first();

        return view('profile.edit', [
            'user' => $user,
            'completedCount' => $completedCount,
            'lastTest' => $last ? $this->summarize($last) : null,
        ]);
    }

    /**
     * Halaman Informasi Pribadi.
     */
    public function info(Request $request): View
    {
        return view('profile.informasi', [
            'user' => $request->user(),
            'levels' => ProfileUpdateRequest::LEVELS,
            'classes' => ProfileUpdateRequest::classOptions(),
        ]);
    }

    /**
     * Halaman Ubah Kata Sandi & Keamanan.
     */
    public function security(Request $request): View
    {
        return view('profile.keamanan', ['user' => $request->user()]);
    }

    /**
     * Simpan Informasi Pribadi.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Hapus akun.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Ringkas tes yang sudah selesai untuk kartu "Tes Terakhir Diambil".
     */
    private function summarize(Assessment $a): array
    {
        $code = strtoupper(substr((string) $a->holland_code, 0, 1));
        $score = $code !== '' ? (int) $a->{'score_'.strtolower($code)} : 0;
        $max = $code !== '' ? Question::where('category', $code)->count() * 5 : 0;
        $percent = $max > 0 ? (int) round($score / $max * 100) : 0;

        return [
            'id' => $a->id,
            'title' => 'Tes RIASEC Minat & Bakat',
            'date' => $a->completed_at?->locale('id')->translatedFormat('j F Y') ?? '-',
            'level' => match (true) {
                $percent >= 70 => 'Tinggi',
                $percent >= 40 => 'Sedang',
                default => 'Rendah',
            },
            'type' => self::TYPES[$code] ?? '-',
        ];
    }
}