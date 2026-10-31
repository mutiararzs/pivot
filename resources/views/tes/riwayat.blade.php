
<x-student-layout title="Riwayat Tes">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-pivot-ink">
            Riwayat Tes
        </h1>
        <p class="mt-1 text-sm text-pivot-muted">
            Lihat aktivitas dan perkembangan tes minat dan bakatmu.
        </p>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 mb-6">

        <div class="rounded-2xl bg-pivot-card p-5">
            <p class="text-sm text-pivot-muted">Total Tes</p>
            <p class="mt-2 text-2xl font-bold text-pivot-ink">
                {{ $totalAssessments }}
            </p>
        </div>

        <div class="rounded-2xl bg-pivot-card p-5">
            <p class="text-sm text-pivot-muted">Tes Selesai</p>
            <p class="mt-2 text-2xl font-bold text-green-600">
                {{ $completedCount }}
            </p>
        </div>

        <div class="rounded-2xl bg-pivot-card p-5 col-span-2 sm:col-span-1">
            <p class="text-sm text-pivot-muted">Dalam Proses</p>
            <p class="mt-2 text-2xl font-bold text-pivot-link">
                 {{ $inProgressCount }}
            </p>
        </div>

    </div>

    {{-- Daftar Riwayat --}}
    <div class="rounded-3xl bg-pivot-card p-5 sm:p-6">

        <div class="mb-5 flex items-center justify-between">
            <h2 class="text-lg font-bold text-pivot-ink">
                Aktivitas Tes
            </h2>
            <span class="text-xs text-pivot-muted">
                Terbaru
            </span>
        </div>

        @forelse ($assessments as $assessment)

            @php
                $progress = $totalQuestions > 0
                    ? min(100, round(
                        ($assessment->answers_count / $totalQuestions) * 100
                    ))
                    : 0;

                $isCompleted = $assessment->status === 'completed';
            @endphp

            <div class="mb-4 rounded-2xl border border-pivot-line p-4">

                {{-- Judul dan Status --}}
                <div class="flex flex-wrap items-start justify-between gap-3">

                    <div>
                        <h3 class="font-bold text-pivot-ink">
                            Tes RIASEC Minat & Bakat
                        </h3>

                        <p class="mt-1 text-xs text-pivot-muted">
                            ID Tes: #{{ $assessment->id }}
                        </p>
                    </div>

                    @if ($isCompleted)
                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            Selesai
                        </span>
                    @else
                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                            Dalam Proses
                        </span>
                    @endif

                </div>

                {{-- Tanggal --}}
                <div class="mt-4 flex items-center gap-2 text-sm text-pivot-muted">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="17" rx="2"/>
                        <path d="M16 2v4M8 2v4M3 10h18"/>
                    </svg>

                    <span>
                        {{ ($isCompleted ? $assessment->completed_at : $assessment->started_at)
                            ?->locale('id')->translatedFormat('d F Y, H:i') ?? '-' }}
                    </span>
                </div>

                {{-- Progress --}}
                <div class="mt-4">

                    <div class="mb-2 flex justify-between text-xs">
                        <span class="text-pivot-muted">
                            {{ $assessment->answers_count }} dari {{ $totalQuestions }} soal dijawab
                        </span>

                        <span class="font-semibold text-pivot-link">
                            {{ $progress }}%
                        </span>
                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-pivot-line">
                        <div
                            class="h-full rounded-full bg-pivot-accent"
                            style="width: {{ $progress }}%">
                        </div>
                    </div>

                </div>

                {{-- Hasil atau Lanjutkan --}}
                @if ($isCompleted)

                    <div class="mt-4 rounded-xl bg-pivot-bg p-4">

                        <p class="text-xs text-pivot-muted">
                            Holland Code
                        </p>

                        <p class="mt-1 text-xl font-bold tracking-widest text-pivot-link">
                            {{ $assessment->holland_code ?? '-' }}
                        </p>

                        <div class="mt-3 grid grid-cols-3 gap-2 text-center">

                            @foreach ([
                                'R' => $assessment->score_r,
                                'I' => $assessment->score_i,
                                'A' => $assessment->score_a,
                                'S' => $assessment->score_s,
                                'E' => $assessment->score_e,
                                'C' => $assessment->score_c,
                            ] as $type => $score)

                                <div class="rounded-lg bg-white p-2">
                                    <p class="text-xs text-pivot-muted">
                                        {{ $type }}
                                    </p>
                                    <p class="font-bold text-pivot-ink">
                                        {{ $score ?? 0 }}
                                    </p>
                                </div>

                            @endforeach

                        </div>
                    </div>

                @else

                    <a href="{{ route('tes.info') }}"
                        class="mt-4 inline-flex w-full items-center justify-center rounded-full bg-pivot-accent px-5 py-3 text-sm font-semibold text-pivot-link transition hover:brightness-95">

                        Lanjutkan Tes

                        <svg class="ml-2 h-4 w-4" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M5 12h14m-6-6 6 6-6 6"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"/>
                        </svg>

                    </a>

                @endif

            </div>

        @empty

            {{-- Jika belum ada riwayat --}}
            <div class="py-12 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-pivot-bg">

                    <svg class="h-8 w-8 text-pivot-muted"
                        fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 7v5l3 2"/>
                    </svg>

                </div>

                <h3 class="mt-4 font-bold text-pivot-ink">
                    Belum Ada Riwayat Tes
                </h3>

                <p class="mt-2 text-sm text-pivot-muted">
                    Kamu belum memiliki aktivitas tes.
                    Yuk, mulai tes minat dan bakatmu!
                </p>

                <a href="{{ route('tes.info') }}"
                    class="mt-5 inline-flex rounded-full bg-pivot-accent px-6 py-3 text-sm font-semibold text-pivot-link hover:brightness-95">

                    Mulai Tes Sekarang

                </a>

            </div>

        @endforelse

        {{-- Pagination --}}
        @if ($assessments->hasPages())
            <div class="mt-5 border-t border-pivot-line pt-4">
                {{ $assessments->links() }}
            </div>
        @endif

    </div>

</x-student-layout>
