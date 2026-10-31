<x-student-layout title="Hasil">

    {{-- Judul + tombol kembali --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('dashboard') }}" aria-label="Kembali ke Beranda"
            class="flex h-10 w-10 items-center justify-center rounded-full bg-pivot-card text-pivot-ink transition hover:bg-pivot-line">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 5l-7 7 7 7" />
            </svg>
        </a>
        <h1 class="text-lg font-semibold text-pivot-ink">Hasil</h1>
    </div>

    {{-- Kepala hasil --}}
    <div class="mt-6">
        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#E6EEFF] px-3 py-1 text-xs text-pivot-muted">
            <svg class="h-3.5 w-3.5 text-pivot-link" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="5" width="18" height="16" rx="2" />
                <path d="M3 10h18M8 3v4M16 3v4M9 16l2 2 4-4" />
            </svg>
            Selesai {{ $completedText }}
        </span>
        <h2 class="mt-2 text-[26px] font-bold leading-[34px] text-pivot-ink">Hasil Asesmen Anda</h2>
        <p class="mt-1 text-sm leading-[22px] text-pivot-muted">
            Pemetaan komprehensif minat vokasional, potensi karier, dan rumpun studi akademik Anda.
        </p>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">

        {{-- Kolom kiri --}}
        <div class="space-y-4">

            {{-- Tipe dominan --}}
            <section class="flex items-center gap-3 rounded-2xl bg-pivot-line p-4">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-pivot-link text-white">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="9" r="6" />
                        <path d="M8.5 14L7 22l5-3 5 3-1.5-8" />
                    </svg>
                </span>
                <div class="min-w-0">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-pivot-muted">Tipe Dominan Anda</p>
                    <p class="text-lg font-bold leading-[26px] text-pivot-ink">{{ $dominantCode }}</p>
                    <p class="text-xs text-pivot-muted">{{ $dominantLabel }}</p>
                </div>
            </section>

            {{-- Interpretasi --}}
            <section class="rounded-2xl bg-pivot-card p-5">
                <p class="flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-pivot-link">
                    <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 4a3 3 0 00-3 3 3 3 0 00-2 5 3 3 0 002 5 3 3 0 006 0V7a3 3 0 00-3-3z" />
                        <path d="M15 4a3 3 0 013 3 3 3 0 012 5 3 3 0 01-2 5 3 3 0 01-3 2" />
                    </svg>
                    Interpretasi Psikometrik
                </p>
                <h3 class="mt-2 text-base font-semibold text-pivot-ink">{{ $profileTitle }}</h3>
                <p class="mt-1 text-sm leading-[23px] text-pivot-muted">{{ $profileDescription }}</p>

                <div class="mt-3 flex flex-wrap gap-2">
                    @foreach ($traits as $trait)
                    <span class="rounded-full bg-pivot-bg px-3 py-1 text-[10px] font-semibold leading-[14px] text-pivot-ink">
                        {{ $trait }}
                    </span>
                    @endforeach
                </div>
            </section>

            {{-- Skor per dimensi --}}
            <section class="rounded-2xl bg-white p-5 shadow-sm">
                <h3 class="text-sm font-semibold text-pivot-ink">Skor Dimensi Holland</h3>
                <div class="mt-3 space-y-3">
                    @foreach ($scores as $row)
                    @php
                    $percent = min(100, round($row['score'] / max($row['max'], 1) * 100));
                    $isTop = str_contains(str_replace(' • ', '', $dominantCode), $row['code']);
                    @endphp
                    <div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-semibold text-pivot-ink">{{ $row['name'] }} ({{ $row['code'] }})</span>
                            <span class="text-pivot-muted">{{ $row['score'] }}/{{ $row['max'] }}</span>
                        </div>
                        <div class="mt-1 h-2 w-full overflow-hidden rounded-full bg-[#DDE9FF]">
                            <div class="h-full rounded-full {{ $isTop ? 'bg-pivot-accent' : 'bg-pivot-line' }}"
                                @style(['width: ' . $percent . ' %'])></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>

        {{-- Kolom kanan --}}
        <div class="space-y-4">

            {{-- Top karir --}}
            <section class="rounded-2xl bg-pivot-card p-4">
                <div class="flex items-center gap-2">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-[#CAE6FF] text-[#001E30]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="7" width="18" height="13" rx="2" />
                            <path d="M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2M3 13h18" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <h3 class="text-base font-semibold text-pivot-ink">Top Karir Rekomendasi</h3>
                        <p class="text-xs text-pivot-muted">Kesesuaian jalur profesional masa depan</p>
                    </div>
                </div>

                <div class="mt-4 space-y-2">
                    @foreach ($careers as $career)
                    <div class="rounded-2xl bg-pivot-bg p-4">
                        <div class="flex items-center gap-3">
                            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#CAE6FF] text-pivot-link">
                                <svg class="h-[22px] w-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 8l-5 4 5 4M16 8l5 4-5 4M14 5l-4 14" />
                                </svg>
                            </span>
                            <div class="min-w-0">
                                <p class="text-base font-semibold text-pivot-ink">{{ $career['title'] }}</p>
                                <p class="text-xs text-pivot-muted">{{ $career['subtitle'] }}</p>
                            </div>
                        </div>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach ($career['tags'] as $tag)
                            <span class="rounded-full bg-[#DDE9FF] px-2.5 py-0.5 text-[10px] font-semibold text-pivot-ink">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            {{-- Rekomendasi jurusan --}}
            <section class="rounded-2xl bg-[#E6EEFF] p-4">
                <div class="flex items-center gap-2">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-[#8CCDFF] text-[#004465]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 10L12 5 2 10l10 5 10-5zM6 12v5c3 2.5 9 2.5 12 0v-5" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <h3 class="text-base font-semibold text-pivot-ink">Rekomendasi Jurusan</h3>
                        <p class="text-xs text-pivot-muted">Rumpun studi yang paling sesuai</p>
                    </div>
                </div>

                <div class="mt-4 space-y-2">
                    @foreach ($majors as $major)
                    <div class="rounded-2xl bg-pivot-bg p-4">
                        <p class="text-sm font-semibold text-pivot-ink">{{ $major['title'] }}</p>
                        <p class="text-xs text-pivot-muted">{{ $major['faculty'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

            <a href="{{ route('dashboard') }}"
                class="flex h-[52px] w-full items-center justify-center rounded-full bg-pivot-dark text-sm font-semibold text-white shadow-md transition hover:bg-black">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</x-student-layout>