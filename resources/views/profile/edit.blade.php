<x-student-layout title="Profil">
    @php
        $flash = session('status') === 'profile-updated' ? 'Informasi pribadi berhasil disimpan' : '';
        $summaryUrl = ($lastTest && Route::has('tes.hasil')) ? route('tes.hasil', ['assessment' => $lastTest['id']]) : null;
    @endphp

    <div x-data="{
            toast: '',
            t: null,
            confirmLogout: false,
            notify(msg) {
                this.toast = msg;
                clearTimeout(this.t);
                this.t = setTimeout(() => this.toast = '', 2800);
            }
        }"
        x-init="@js($flash) && notify(@js($flash))"
        @keydown.escape.window="confirmLogout = false">

        <h1 class="hidden text-2xl font-bold text-pivot-ink lg:block">Profil</h1>

        <div class="grid gap-4 lg:mt-6 lg:grid-cols-5 lg:items-start lg:gap-6">

            {{-- Kartu profil --}}
            <section class="rounded-[32px] bg-white p-6 text-center lg:col-span-2">
                {{-- Avatar --}}
                <div class="relative mx-auto h-[120px] w-36">
                    <div class="absolute inset-0 flex items-center justify-center" aria-hidden="true">
                        <div class="h-36 w-36 rounded-full bg-pivot-accent/15 blur-3xl"></div>
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="h-28 w-28 rounded-full bg-[#E6EEFF] p-1">
                            <div class="flex h-full w-full items-center justify-center rounded-full bg-[#DDE9FF] text-pivot-link">
                                <svg class="h-16 w-16" viewBox="0 0 24 24" fill="currentColor">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <button type="button" @click="notify('Ubah foto profil belum tersedia')" aria-label="Ubah foto profil"
                        class="absolute bottom-0 right-3 flex h-7 w-7 items-center justify-center rounded-full border-2 border-white bg-pivot-accent text-white transition hover:brightness-95">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 8h3l2-3h6l2 3h3v11H4z" />
                            <circle cx="12" cy="13" r="3.5" />
                        </svg>
                    </button>
                </div>

                <h2 class="mt-4 break-words text-[22px] font-bold leading-[30px] text-pivot-ink">{{ $user->name }}</h2>
                <p class="mt-1 text-sm font-semibold text-pivot-link">{{ $user->student_info }}</p>

                <div class="mt-1 flex items-center justify-center gap-1.5">
                    <span class="h-1 w-1 shrink-0 rounded-full bg-[#C5C6CD]"></span>
                    @if ($user->school)
                    <p class="text-xs leading-[18px] text-pivot-muted">{{ $user->school }}</p>
                    @else
                    <a href="{{ route('profile.info') }}" class="text-xs leading-[18px] text-pivot-link hover:underline">Lengkapi asal sekolahmu</a>
                    @endif
                </div>

                <div class="mt-4 flex flex-wrap justify-center gap-1">
                    @if ($user->email_verified_at)
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-[#DDE9FF] px-3 py-1.5 text-xs font-semibold text-pivot-ink">
                        <svg class="h-[13px] w-[13px] text-pivot-link" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3l2.4 2 3.1-.2.9 3 2.6 1.7-1 2.9 1 2.9-2.6 1.7-.9 3-3.1-.2L12 21l-2.4-2-3.1.2-.9-3L3 14.5l1-2.9-1-2.9 2.6-1.7.9-3 3.1.2z" />
                            <path d="M8.5 12l2.5 2.5 4.5-5" />
                        </svg>
                        Akun Terverifikasi
                    </span>
                    @endif
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-[#CAE6FF] px-3 py-1.5 text-xs font-semibold text-[#004B70]">
                        <svg class="h-[13px] w-[13px] text-pivot-link" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13 2L4 14h6l-1 8 9-12h-6z" />
                        </svg>
                        {{ $completedCount }} Asesmen Selesai
                    </span>
                </div>
            </section>

            <div class="space-y-4 lg:col-span-3 lg:space-y-6">

                {{-- Tes terakhir diambil --}}
                <section class="rounded-[32px] bg-pivot-card p-4">
                    <div class="flex items-center justify-between px-1">
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-pivot-link" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 109-9 9 9 0 00-6.7 3L3 8" />
                                <path d="M3 3v5h5M12 7v5l3 2" />
                            </svg>
                            <h2 class="text-base font-semibold text-pivot-ink">Tes Terakhir Diambil</h2>
                        </div>
                        @if ($lastTest)
                        <span class="rounded-full bg-pivot-line px-2 py-0.5 text-[10px] font-bold leading-[14px] text-pivot-muted">Terbaru</span>
                        @endif
                    </div>

                    @if ($lastTest)
                    <div class="mt-2 flex items-center justify-between gap-2 rounded-2xl bg-white p-4">
                        <div class="flex min-w-0 flex-1 items-center gap-3">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-pivot-link text-white">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 4a3 3 0 00-3 3 3 3 0 00-2 5 3 3 0 002 5 3 3 0 006 0V7a3 3 0 00-3-3z" />
                                    <path d="M15 4a3 3 0 013 3 3 3 0 012 5 3 3 0 01-2 5 3 3 0 01-3 2" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-base font-semibold leading-5 text-pivot-ink">{{ $lastTest['title'] }}</p>
                                <p class="mt-0.5 flex items-center gap-1 text-xs leading-[18px] text-pivot-muted">
                                    <svg class="h-[11px] w-[11px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="5" width="18" height="16" rx="2" />
                                        <path d="M3 10h18M8 3v4M16 3v4" />
                                    </svg>
                                    {{ $lastTest['date'] }}
                                </p>
                            </div>
                        </div>
                        <div class="shrink-0 text-right">
                            <p class="text-xs font-semibold text-pivot-link">{{ $lastTest['level'] }}</p>
                            <p class="text-xs leading-[18px] text-pivot-muted">{{ $lastTest['type'] }}</p>
                        </div>
                    </div>

                    @if ($summaryUrl)
                    <a href="{{ $summaryUrl }}"
                        class="mt-1 flex items-center justify-center gap-2 rounded-full bg-[#DDE9FF] px-4 py-2.5 text-xs font-semibold text-pivot-ink transition hover:brightness-95">
                    @else
                    <button type="button" @click="notify('Ringkasan hasil belum tersedia')"
                        class="mt-1 flex w-full items-center justify-center gap-2 rounded-full bg-[#DDE9FF] px-4 py-2.5 text-xs font-semibold text-pivot-ink transition hover:brightness-95">
                    @endif
                        Lihat Ringkasan Hasil
                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    @if ($summaryUrl)
                    </a>
                    @else
                    </button>
                    @endif
                    @else
                    <div class="mt-2 rounded-2xl bg-white p-4 text-center">
                        <p class="text-sm text-pivot-muted">Belum ada tes yang selesai.</p>
                        <a href="{{ route('tes.info') }}"
                            class="mt-3 inline-flex items-center justify-center gap-2 rounded-full bg-[#DDE9FF] px-4 py-2.5 text-xs font-semibold text-pivot-ink transition hover:brightness-95">
                            Mulai Tes Sekarang
                            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </a>
                    </div>
                    @endif
                </section>

                {{-- Pengaturan profil --}}
                <section>
                    <h2 class="px-2 text-xs font-semibold uppercase text-pivot-muted underline">Pengaturan Profil</h2>

                    <div class="mt-1 space-y-1">
                        <a href="{{ route('profile.info') }}"
                            class="flex items-center gap-4 rounded-b-lg rounded-t-3xl bg-white p-4 transition hover:bg-white/70">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#E6EEFF] text-pivot-ink">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M4 20c0-4 3.6-6 8-6s8 2 8 6" />
                                </svg>
                            </span>
                            <span class="min-w-0 flex-1">
                                <span class="block text-base font-semibold text-pivot-ink">Informasi Pribadi</span>
                                <span class="block text-xs leading-[18px] text-pivot-muted">Biodata diri</span>
                            </span>
                            <svg class="h-3 w-3 shrink-0 text-[#75777E]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 5l7 7-7 7" />
                            </svg>
                        </a>

                        <a href="{{ route('profile.security') }}"
                            class="flex items-center gap-4 rounded-b-3xl rounded-t-lg bg-white p-4 transition hover:bg-white/70">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#E6EEFF] text-pivot-ink">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="5" y="11" width="14" height="10" rx="2" />
                                    <path d="M8 11V8a4 4 0 018 0v3" />
                                </svg>
                            </span>
                            <span class="min-w-0 flex-1">
                                <span class="block text-base font-semibold text-pivot-ink">Ubah Kata Sandi &amp; Keamanan</span>
                                <span class="block text-xs leading-[18px] text-pivot-muted">Kata sandi &amp; hapus akun</span>
                            </span>
                            <svg class="h-3 w-3 shrink-0 text-[#75777E]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </section>

                {{-- Keluar --}}
                <div class="px-1 pt-2 text-center lg:px-0">
                    <button type="button" @click="confirmLogout = true"
                        class="flex w-full items-center justify-center gap-2 rounded-full bg-[#FFDAD6] py-4 text-sm font-semibold text-[#93000A] transition hover:brightness-95">
                        <svg class="h-[15px] w-[15px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 4H5a2 2 0 00-2 2v12a2 2 0 002 2h4" />
                            <path d="M16 17l5-5-5-5M21 12H9" />
                        </svg>
                        Keluar dari Akun
                    </button>
                    <p class="mt-2 text-xs leading-[18px] text-pivot-muted">{{ config('app.name', 'PIVOT') }} Web v1.0.0</p>
                </div>
            </div>
        </div>

        {{-- Dialog konfirmasi keluar --}}
        <div x-show="confirmLogout" x-cloak x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-pivot-ink/40 px-6"
            @click.self="confirmLogout = false" role="dialog" aria-modal="true" aria-labelledby="logout-title">
            <div class="w-full max-w-sm rounded-[28px] bg-pivot-bg p-6 shadow-xl">
                <h3 id="logout-title" class="text-lg font-semibold text-pivot-ink">Keluar dari akun?</h3>
                <p class="mt-3 text-sm text-pivot-muted">Kamu perlu masuk lagi untuk melanjutkan asesmen.</p>
                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" @click="confirmLogout = false"
                        class="rounded-full px-4 py-2 text-sm font-semibold text-pivot-link transition hover:bg-pivot-line/60">Batal</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="rounded-full px-4 py-2 text-sm font-semibold text-[#93000A] transition hover:bg-[#FFDAD6]">Keluar</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Toast --}}
        <div x-show="toast" x-cloak x-transition
            class="fixed bottom-24 left-1/2 z-50 -translate-x-1/2 rounded-full bg-pivot-dark px-5 py-3 text-xs font-medium text-white shadow-lg lg:bottom-8"
            role="status" x-text="toast"></div>
    </div>
</x-student-layout>