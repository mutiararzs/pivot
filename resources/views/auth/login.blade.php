<x-auth-layout title="Masuk">
    <div x-data="{ showPassword: false, soon: '' }">

        {{-- Header --}}
        <div class="text-center">
            @if (file_exists(public_path('images/logo.png')))
            <img src="{{ asset('images/logo.png') }}" alt="Peta Masa Depanku"
                class="mx-auto h-[104px] w-[104px] object-contain">
            @else
            {{-- Cadangan jika logo belum ada: taruh logo di public/images/logo.png --}}
            <svg class="mx-auto h-[104px] w-[104px] text-pivot-link" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="9" />
                <path d="M15.5 8.5l-2 5-5 2 2-5 5-2z" />
            </svg>
            @endif

            <h1 class="mt-6 text-[22px] font-bold tracking-tight text-pivot-ink">Selamat Datang Kembali</h1>
            <p class="mt-2 text-sm leading-[22px] text-pivot-muted">
                Masuk untuk melanjutkan asesmen minat<br>&amp; bakat Anda
            </p>
        </div>

        {{-- Kartu form --}}
        <div class="mt-8 rounded-[32px] bg-pivot-card p-6 shadow-sm">

            @if (session('status'))
            <div class="mb-4 rounded-lg bg-white px-3 py-2 text-xs text-pivot-link">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="text-xs font-semibold text-pivot-ink">Email Siswa</label>
                    <div class="relative mt-1.5">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-pivot-muted">
                            <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="5" width="18" height="14" rx="2" />
                                <path d="M3 7l9 6 9-6" />
                            </svg>
                        </span>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            placeholder="Masukkan email terdaftar" autocomplete="email" required autofocus
                            class="block w-full rounded-[10px] border-0 bg-white py-3.5 pl-10 pr-3 text-sm text-pivot-ink placeholder:text-pivot-muted/50 focus:ring-[1.5px] focus:ring-pivot-link
                                      @error('email') ring-1 ring-pivot-error @enderror">
                    </div>
                    @error('email')
                    <p class="mt-1 text-xs text-pivot-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kata sandi --}}
                <div class="mt-4">
                    <label for="password" class="text-xs font-semibold text-pivot-ink">Kata Sandi</label>
                    <div class="relative mt-1.5">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-pivot-muted">
                            <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="5" y="11" width="14" height="9" rx="2" />
                                <path d="M8 11V8a4 4 0 118 0v3" />
                            </svg>
                        </span>
                        <input id="password" name="password" :type="showPassword ? 'text' : 'password'"
                            placeholder="Minimal 8 karakter" autocomplete="current-password" required
                            class="block w-full rounded-[10px] border-0 bg-white py-3.5 pl-10 pr-11 text-sm text-pivot-ink placeholder:text-pivot-muted/50 focus:ring-[1.5px] focus:ring-pivot-link
                                      @error('password') ring-1 ring-pivot-error @enderror">
                        <button type="button" @click="showPassword = !showPassword"
                            :aria-label="showPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-pivot-muted hover:text-pivot-ink">
                            {{-- mata terbuka --}}
                            <svg x-show="!showPassword" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            {{-- mata dicoret --}}
                            <svg x-show="showPassword" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 3l18 18" />
                                <path d="M10.6 5.1A10.7 10.7 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-3.2 4.1M6.6 6.6A16.6 16.6 0 002 12s3.5 7 10 7a10.5 10.5 0 004.4-.9" />
                                <path d="M9.9 9.9a3 3 0 004.2 4.2" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-1 text-xs text-pivot-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ingat saya & lupa sandi --}}
                <div class="mt-3 flex items-center justify-between">
                    <label for="remember_me" class="inline-flex cursor-pointer items-center gap-2">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 rounded-[3px] border-[#767676] text-pivot-link focus:ring-pivot-link">
                        <span class="text-xs text-pivot-muted">Ingat Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-semibold text-pivot-link hover:underline">
                        Lupa Kata Sandi?
                    </a>
                    @endif
                </div>

                {{-- Tombol masuk --}}
                <button type="submit"
                    class="mt-6 flex h-12 w-full items-center justify-center gap-2 rounded-full bg-black text-sm font-semibold text-white shadow-md transition hover:bg-pivot-dark">
                    Masuk
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </button>
            </form>

            {{-- Pemisah --}}
            <div class="mt-7 flex items-center gap-3">
                <div class="h-px flex-1 bg-pivot-line"></div>
                <span class="text-[10px] font-bold tracking-wider text-[#75777E]">ATAU MASUK DENGAN</span>
                <div class="h-px flex-1 bg-pivot-line"></div>
            </div>

            {{-- Tombol sosial (belum aktif, sama seperti versi mobile) --}}
            <div class="mt-4 grid grid-cols-2 gap-[9px]">
                <button type="button" @click="soon = 'Masuk dengan Google'"
                    class="flex h-12 items-center justify-center gap-2 rounded-xl bg-white text-xs font-semibold text-pivot-ink shadow-sm hover:bg-white/70">
                    <span class="text-lg font-extrabold text-[#4285F4]">G</span> Google
                </button>
                <button type="button" @click="soon = 'Masuk dengan Apple'"
                    class="flex h-12 items-center justify-center gap-2 rounded-xl bg-white text-xs font-semibold text-pivot-ink shadow-sm hover:bg-white/70">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M16.4 12.6c0-2.3 1.9-3.4 2-3.5-1.1-1.6-2.8-1.8-3.4-1.8-1.4-.1-2.8.9-3.5.9-.7 0-1.8-.8-3-.8-1.5 0-3 .9-3.8 2.3-1.6 2.8-.4 7 1.2 9.3.8 1.1 1.7 2.4 2.9 2.3 1.2 0 1.6-.7 3-.7s1.8.7 3 .7c1.3 0 2.1-1.1 2.8-2.3.9-1.3 1.2-2.5 1.3-2.6-.1 0-2.5-1-2.5-3.8zM14.2 5.8c.6-.8 1.1-1.8.9-2.8-.9 0-2 .6-2.6 1.4-.6.7-1.1 1.7-.9 2.7 1 .1 2-.5 2.6-1.3z" />
                    </svg>
                    Apple
                </button>
            </div>
            <p x-show="soon" x-cloak x-text="soon + ' belum tersedia'" class="mt-3 text-center text-xs text-pivot-muted"></p>
        </div>

        {{-- Footer --}}
        <p class="mt-6 text-center text-sm text-pivot-muted">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-pivot-link hover:underline">Daftar Sekarang</a>
        </p>
    </div>
</x-auth-layout>