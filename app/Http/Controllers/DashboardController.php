<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $hour = now()->hour;
        $salam = match (true) {
            $hour < 11 => 'Selamat Pagi',
            $hour < 15 => 'Selamat Siang',
            $hour < 18 => 'Selamat Sore',
            default => 'Selamat Malam',
        };

        $firstName = explode(' ', trim($user->name))[0];

        return view('dashboard', [
            'user' => $user,
            'greeting' => "{$salam}, {$firstName}!",
            'today' => Carbon::now()->locale('id')->translatedFormat('j F Y'),

            // Info tes
            'totalQuestions' => 60,
            'estimatedMinutes' => 25,

            // TODO: ganti dengan data asli dari tabel assessments saat fitur tes selesai.
            // Isi null jika siswa belum pernah menyelesaikan tes.
            'lastTest' => [
                'title' => 'Tes RIASEC Minat & Bakat',
                'date' => '18 Mei 2024',
                'percent' => 98,
                'dominant' => 'Visual • Spasial',
            ],
        ]);
    }
}