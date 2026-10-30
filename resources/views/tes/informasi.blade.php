@php
$statIcons = [
'question' => '
<circle cx="12" cy="12" r="9" />
<path d="M9.5 9.5a2.5 2.5 0 114 2c-1 .6-1.5 1-1.5 2M12 17h.01" />',
'clock' => '
<circle cx="12" cy="12" r="9" />
<path d="M12 7v5l3 2" />',
'scale' => '
<path d="M4 12h16" />
<circle cx="6" cy="12" r="2" />
<circle cx="12" cy="12" r="2" />
<circle cx="18" cy="12" r="2" />',
'rule' => '
<path d="M4 7h10M4 12h10M4 17h6" />
<path d="M17 15l2 2 3-4" />',
];

// Halaman "Mulai" (POST) dibuat di tahap berikutnya; sementara tombolnya belum aktif.
$mulaiReady = Route::has('tes.mulai');
@endphp

<x-student-layout title="Informasi Tes">

    {{-- Judul + tombol kembali --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('dashboard') }}" aria-label="Kembali"
            class="flex h-10 w-10 items-center justify-center rounded-full bg-pivot-card text-pivot-ink transition hover:bg-pivot-line">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 5l-7 7 7 7" />
            </svg>
        </a>
        <h1 class="text-lg font-semibold text-pivot-ink">Informasi Tes</h1>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">

        {{-- Kolom kiri: ringkasan --}}
        <div class="space-y-6">

            {{-- Kartu utama --}}
            <section class="relative overflow-hidden rounded-[32px] bg-pivot-card p-6">
                {{-- Cahaya biru lembut di pojok kanan atas --}}
                <div class="pointer-events-none absolute -right-14 -top-14 h-40 w-40 rounded-full bg-pivot-accent/30 blur-3xl"></div>

                <div class="relative">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-pivot-line px-3 py-1 text-xs font-semibold text-pivot-link">
                        <span class="h-1.5 w-1.5 rounded-full bg-pivot-link"></span>
                        {{ $badge }}
                    </span>

                    <h2 class="mt-4 text-[22px] font-bold leading-[30px] text-pivot-ink">{{ $title }}</h2>
                    <p class="mt-1 text-sm leading-[22px] text-pivot-muted">{{ $description }}</p>
                </div>
            </section>

            {{-- Ringkasan tes --}}
            <section>
                <h3 class="px-1 text-xs font-bold tracking-wider text-pivot-muted">RINGKASAN TES</h3>
                <div class="mt-2 grid grid-cols-2 gap-3">
                    @foreach ($stats as $stat)
                    <div class="flex items-center gap-3 rounded-2xl bg-white p-3.5 shadow-sm">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-pivot-accent text-pivot-link">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">{!! $statIcons[$stat['icon']] !!}</svg>
                        </span>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-semibold text-pivot-ink">{{ $stat['value'] }}</p>
                            <p class="truncate text-[11px] text-pivot-muted">{{ $stat['label'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>

        {{-- Kolom kanan: petunjuk & tombol mulai --}}
        <div class="space-y-6">

            {{-- Petunjuk pengerjaan --}}
            <section class="rounded-3xl bg-pivot-card p-5">
                <div class="flex items-center gap-3">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-pivot-dark text-white">
                        <svg class="h-[15px] w-[15px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 6h11M9 12h11M9 18h11M4 6l1 1 2-2M4 12l1 1 2-2M4 18l1 1 2-2" />
                        </svg>
                    </span>
                    <h3 class="text-base font-semibold text-pivot-ink">Petunjuk Pengerjaan</h3>
                </div>

                <ul class="mt-4 space-y-2">
                    @foreach ($instructions as $item)
                    <li class="flex items-start gap-3 rounded-2xl bg-white p-3.5">
                        <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-pivot-accent text-pivot-link">
                            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12l5 5 9-10" />
                            </svg>
                        </span>
                        <span class="text-sm leading-[22px] text-pivot-ink">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>

                <div class="mt-4 flex items-start gap-3 rounded-2xl bg-[#DDE9FF] p-3.5">
                    <span class="text-lg leading-[27px]">💡</span>
                    <p class="text-sm leading-[22px] text-pivot-ink">Tips: {{ $tip }}</p>
                </div>
            </section>

            {{-- Dimensi Holland --}}
            <section class="flex items-center gap-4 rounded-3xl bg-white p-4 shadow-sm">
                <span class="flex h-[52px] w-[52px] shrink-0 items-center justify-center rounded-2xl bg-pivot-accent text-pivot-link">
                    <svg class="h-[25px] w-[25px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3l8 4.5v9L12 21l-8-4.5v-9L12 3z" />
                    </svg>
                </span>
                <div class="min-w-0">
                    <h3 class="text-sm font-semibold text-pivot-ink">{{ $dimensionTitle }}</h3>
                    <p class="text-xs leading-[18px] text-pivot-muted">{{ $dimensionSubtitle }}</p>
                </div>
            </section>

            {{-- Tombol mulai --}}
            <form method="POST" action="{{ $mulaiReady ? route('tes.mulai') : '#' }}"
                x-data="{ loading: false }"
                @submit="{{ $mulaiReady ? 'loading = true' : '$event.preventDefault()' }}">
                @csrf
                <button type="submit" :disabled="loading"
                    class="flex h-[52px] w-full items-center justify-center gap-2 rounded-full bg-pivot-dark text-sm font-semibold text-white shadow-md transition hover:bg-black disabled:opacity-60">
                    <svg x-show="loading" x-cloak class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="3" class="opacity-25" />
                        <path d="M21 12a9 9 0 00-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                    </svg>
                    <span x-show="!loading">Mulai Kerjakan Soal</span>
                    <svg x-show="!loading" class="h-[13px] w-[13px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</x-student-layout>