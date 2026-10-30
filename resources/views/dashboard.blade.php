<x-student-layout title="Beranda">

    {{-- Baris profil --}}
    <div class="flex items-center gap-4">
        <div class="relative">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#DDE9FF] text-pivot-link">
                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7z" />
                </svg>
            </div>
            <span class="absolute -bottom-0.5 -right-0.5 flex h-4 w-4 items-center justify-center rounded-full border-[1.5px] border-pivot-bg bg-pivot-accent text-white">
                <svg class="h-2.5 w-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12l5 5 9-10" />
                </svg>
            </span>
        </div>

        <div class="min-w-0 flex-1">
            <h1 class="truncate text-lg font-semibold leading-[26px] text-pivot-ink">{{ $greeting }}</h1>
            <p class="truncate text-xs leading-[18px] text-pivot-muted">Siswa &bull; {{ $user->email }}</p>
        </div>

        {{-- Tombol notifikasi (halamannya menyusul) --}}
        <a href="#" aria-label="Notifikasi"
            class="flex h-10 w-10 items-center justify-center rounded-full bg-[#E6EEFF] text-pivot-ink transition hover:bg-pivot-line">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 9a6 6 0 1112 0c0 5 2 6 2 6H4s2-1 2-6z" />
                <path d="M10 19a2 2 0 004 0" />
            </svg>
        </a>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-5">

        {{-- Kartu ajakan tes --}}
        <section class="relative overflow-hidden rounded-[32px] bg-pivot-dark p-6 lg:col-span-3 lg:p-8">
            <div class="pointer-events-none absolute -right-12 -top-12 h-44 w-44 rounded-full bg-pivot-accent/25 blur-3xl"></div>
            @if (file_exists(public_path('images/logo.png')))
            <img src="{{ asset('images/logo.png') }}" alt=""
                class="pointer-events-none absolute bottom-14 right-4 h-[120px] w-[120px] object-contain opacity-20">
            @else
            <svg class="pointer-events-none absolute bottom-14 right-4 h-[120px] w-[120px] text-pivot-accent opacity-20"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="9" />
                <path d="M15.5 8.5l-2 5-5 2 2-5 5-2z" />
            </svg>
            @endif

            <div class="relative">
                <div class="flex items-center justify-between">
                    <span class="inline-flex items-center gap-1 rounded-full bg-pivot-accent/20 px-3 py-1 text-xs font-semibold text-pivot-accent">
                        <span class="h-2 w-2 rounded-full bg-pivot-accent"></span>
                        Asesmen Tersedia
                    </span>
                    <span class="text-[10px] font-bold leading-[14px] text-[#76849F]">{{ $today }}</span>
                </div>

                <h2 class="mt-4 text-[22px] font-bold leading-[27px] text-white">Ayo Mulai Tes Minat &amp; Bakat!</h2>
                <p class="mt-1 text-xs leading-[18px] text-[#76849F]">
                    Temukan potensi karier masa depan dan jurusan<br class="hidden sm:block">
                    kuliah terbaik sesuai profil unikmu.
                </p>

                <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs font-semibold text-white">
                    <span class="inline-flex items-center gap-1">
                        <svg class="h-3.5 w-3.5 text-pivot-accent" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M9.5 9.5a2.5 2.5 0 114 2c-1 .6-1.5 1-1.5 2M12 17h.01" />
                        </svg>
                        {{ $totalQuestions }} Soal
                    </span>
                    <span class="text-[#76849F]">&bull;</span>
                    <span class="inline-flex items-center gap-1">
                        <svg class="h-3.5 w-3.5 text-pivot-accent" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 7v5l3 2" />
                        </svg>
                        Estimasi {{ $estimatedMinutes }} Menit
                    </span>
                </div>

                <a href="{{ route('tes.info') }}"
                    class="mt-5 flex h-[52px] w-full items-center justify-center gap-2 rounded-full bg-pivot-accent text-sm font-semibold text-[#004465] transition hover:brightness-95">
                    Mulai Sekarang
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </a>
            </div>
        </section>

        {{-- Riwayat tes terbaru --}}
        <section class="lg:col-span-2">
            <h2 class="px-1 text-base font-semibold text-pivot-ink">Riwayat Tes Terbaru</h2>

            <div class="mt-2 rounded-3xl bg-pivot-card p-4">
                @if ($lastTest)
                <div class="flex items-center gap-4">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-pivot-accent text-pivot-link">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 4a3 3 0 00-3 3 3 3 0 00-2 5 3 3 0 002 5 3 3 0 006 0V7a3 3 0 00-3-3z" />
                            <path d="M15 4a3 3 0 013 3 3 3 0 012 5 3 3 0 01-2 5 3 3 0 01-3 2" />
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-base font-semibold text-pivot-ink">{{ $lastTest['title'] }}</p>
                        <p class="text-xs leading-[18px] text-pivot-muted">Selesai pada {{ $lastTest['date'] }}</p>
                    </div>

                    <span class="shrink-0 rounded-full bg-pivot-line px-2.5 py-1 text-[10px] font-bold leading-[14px] text-pivot-dark">
                        {{ $lastTest['percent'] }}% Cocok
                    </span>
                </div>

                <div class="mt-4 flex items-center justify-between rounded-2xl bg-pivot-bg p-2">
                    <div class="px-1">
                        <p class="text-[10px] font-bold leading-[14px] text-pivot-muted">Tipe Dominan</p>
                        <p class="text-sm font-semibold text-pivot-link">{{ $lastTest['dominant'] }}</p>
                    </div>
                    <div class="mr-1 h-2 w-24 overflow-hidden rounded-full bg-[#DDE9FF]">
                        <div class="h-full rounded-full bg-pivot-accent"
                            @style(['width: ' . min(max($lastTest['percent'], 0), 100) . '%' ])></div>
                    </div>
                </div>
                @else
                <p class="px-2 py-6 text-center text-sm text-pivot-muted">
                    Belum ada tes yang selesai. Mulai tes pertamamu sekarang!
                </p>
                @endif
            </div>
        </section>
    </div>
</x-student-layout>