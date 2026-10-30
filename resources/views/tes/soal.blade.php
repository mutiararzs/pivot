<x-student-layout title="Sesi Penilaian Aktif">

    {{-- Judul + tombol kembali --}}
    <div class="flex items-center gap-3">
        {{-- Jawaban tersimpan otomatis, jadi cukup kembali ke Beranda --}}
        <a href="{{ route('dashboard') }}" aria-label="Kembali ke Beranda"
            class="flex h-10 w-10 items-center justify-center rounded-full bg-pivot-card text-pivot-ink transition hover:bg-pivot-line">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 5l-7 7 7 7" />
            </svg>
        </a>
        <div>
            <h1 class="text-lg font-semibold leading-[26px] text-pivot-ink">Sesi Penilaian Aktif</h1>
            <p class="text-xs text-pivot-muted">Soal {{ $no }} dari {{ $total }} &bull; {{ $answeredCount }} terjawab</p>
        </div>
    </div>

    {{-- Bilah kemajuan --}}
    <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-pivot-line">
        <div class="h-full rounded-full bg-pivot-accent"
            @style(['width: ' . round($answeredCount / max($total, 1) * 100) . ' %'])></div>
    </div>

    @if (session('error'))
    <div class="mt-4 rounded-[10px] bg-white px-4 py-3 text-sm text-pivot-error shadow-sm">
        {{ session('error') }}
    </div>
    @endif

    {{-- Satu formulir untuk jawaban, panel nomor soal, dan tombol navigasi --}}
    <form method="POST" action="{{ route('tes.jawab', ['assessment' => $assessment->id, 'no' => $no]) }}"
        class="mt-6 grid gap-6 lg:grid-cols-3">
        @csrf

        {{-- Kolom kiri: soal + pilihan jawaban + tombol --}}
        <div class="space-y-4 lg:col-span-2">

            {{-- Kartu soal --}}
            <section class="rounded-xl bg-[#E6EEFF] p-5">
                <span class="inline-block rounded-md bg-pivot-line px-2 py-1 text-[10px] font-bold leading-[14px] tracking-wider text-pivot-link">
                    KATEGORI: {{ $question->category_label }}
                </span>
                <h2 class="mt-2 text-lg font-semibold leading-[26px] text-pivot-ink">
                    {{ $question->text }}
                </h2>
            </section>

            {{-- Pilihan jawaban skala 1-5 --}}
            <div class="space-y-2.5">
                @foreach ($labels as $value => $label)
                <label class="block cursor-pointer">
                    <input type="radio" name="jawaban" value="{{ $value }}" class="peer sr-only"
                        @checked((int) $selected===$value)>
                    <div class="flex items-center gap-3 rounded-[10px] bg-white p-3.5 text-[#251838] shadow-sm transition
                                    hover:bg-white/80 peer-checked:bg-pivot-dark peer-checked:text-white
                                    peer-focus-visible:ring-2 peer-focus-visible:ring-pivot-link
                                    peer-checked:[&_.num]:bg-white/20 peer-checked:[&_.chk]:opacity-100">
                        <span class="num flex h-6 w-6 shrink-0 items-center justify-center rounded-md bg-pivot-line text-xs font-semibold">
                            {{ $value }}
                        </span>
                        <span class="flex-1 text-[15px] leading-[22px]">{{ $label }}</span>
                        <svg class="chk h-4 w-4 opacity-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12l5 5 9-10" />
                        </svg>
                    </div>
                </label>
                @endforeach
            </div>

            {{-- Tips --}}
            <div class="flex items-center gap-2 rounded-[10px] bg-pivot-line p-3">
                <span class="text-lg leading-none">💡</span>
                <p class="text-[13px] leading-[18px] text-pivot-ink">Pilih jawaban secara jujur agar hasil akurat.</p>
            </div>

            {{-- Tombol navigasi --}}
            <div class="flex items-center gap-2 pt-2">
                <button type="submit" name="aksi" value="sebelumnya" @disabled($isFirst)
                    class="flex h-12 flex-1 items-center justify-center gap-2 rounded-[10px] bg-pivot-line text-xs font-bold tracking-wider text-[#251838] transition hover:brightness-95 disabled:cursor-not-allowed disabled:opacity-40 sm:flex-none sm:px-6">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M11 6l-6 6 6 6" />
                    </svg>
                    SEBELUMNYA
                </button>

                @if ($isLast)
                <button type="submit" name="aksi" value="kirim"
                    class="flex h-12 flex-[2] items-center justify-center gap-2 rounded-[10px] bg-pivot-dark text-xs font-bold tracking-wider text-white shadow-md transition hover:bg-black sm:flex-none sm:px-8">
                    KIRIM JAWABAN
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" />
                    </svg>
                </button>
                @else
                <button type="submit" name="aksi" value="selanjutnya"
                    class="flex h-12 flex-[2] items-center justify-center gap-2 rounded-[10px] bg-pivot-dark text-xs font-bold tracking-wider text-white shadow-md transition hover:bg-black sm:flex-none sm:px-8">
                    SELANJUTNYA
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </button>
                @endif
            </div>
        </div>

        {{-- Kolom kanan: panel nomor soal --}}
        <aside class="lg:col-span-1">
            <div class="rounded-xl bg-white p-4 shadow-sm lg:sticky lg:top-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-semibold text-pivot-ink">Nomor Soal</h3>
                    <span class="rounded-full bg-pivot-line px-2 py-0.5 text-[10px] leading-[15px] text-pivot-link">
                        {{ $windowEnd - $windowStart + 1 }} Soal
                    </span>
                </div>

                <div class="mt-3 grid grid-cols-5 gap-1">
                    @for ($i = $windowStart; $i <= $windowEnd; $i++)
                        @php
                        $isCurrent=$i===$no;
                        $isAnswered=in_array($i, $answeredNos, true);
                        @endphp
                        <button type="submit" name="aksi" value="ke-{{ $i }}"
                        class="flex h-9 items-center justify-center rounded-lg text-xs font-semibold transition
                                       {{ $isCurrent
                                           ? 'bg-pivot-dark text-white'
                                           : ($isAnswered
                                               ? 'bg-[#C9EE9E] text-[#251838]'
                                               : 'border border-slate-200 bg-slate-100 text-slate-600 hover:bg-slate-200') }}">
                        {{ $i }}
                        </button>
                        @endfor
                </div>

                <div class="mt-4 space-y-1.5 text-[11px] text-pivot-muted">
                    <p class="flex items-center gap-2"><span class="h-3 w-3 rounded bg-pivot-dark"></span> Soal aktif</p>
                    <p class="flex items-center gap-2"><span class="h-3 w-3 rounded bg-[#C9EE9E]"></span> Sudah dijawab</p>
                    <p class="flex items-center gap-2"><span class="h-3 w-3 rounded border border-slate-200 bg-slate-100"></span> Belum dijawab</p>
                </div>
            </div>
        </aside>
    </form>
</x-student-layout>