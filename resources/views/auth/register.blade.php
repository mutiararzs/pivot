<x-auth-layout title="Daftar">
    <div x-data="{ showPw: false, showPw2: false, soon: '' }">

        {{-- Header --}}
        <div class="text-center">
            @if (file_exists(public_path('images/logo.png')))
            <img src="{{ asset('images/logo.png') }}" alt="Peta Masa Depanku"
                class="mx-auto h-[104px] w-[104px] object-contain">
            @else
            <svg class="mx-auto h-[104px] w-[104px] text-pivot-link" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="9" />
                <path d="M15.5 8.5l-2 5-5 2 2-5 5-2z" />
            </svg>
            @endif

            <h1 class="mt-6 text-[26px] font-bold leading-[34px] text-pivot-ink">Buat Akun Baru</h1>
            <p class="mt-2 text-sm leading-[22px] text-pivot-muted">
                Daftarkan diri Anda untuk menemukan potensi<br>terbaik Anda
            </p>
        </div>

        {{-- Kartu form --}}
        <div class="mt-8 rounded-[32px] bg-pivot-card p-6 shadow-sm">
            <form method="POST" action="{{ route('register') }}" novalidate>
                @csrf

                {{-- Nama lengkap --}}
                <div>
                    <label for="name" class="ml-1 text-xs font-semibold text-pivot-muted">Nama Lengkap</label>
                    <div class="relative mt-1.5">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-pivot-muted">
                            <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="4" />
                                <path d="M4 20c0-4 3.6-6 8-6s8 2 8 6" />
                            </svg>
                        </span>
                        <input id="name" name="name" type="text" value="{{ old('name') }}"
                            placeholder="cth. Arya Putra Pratama" autocomplete="name" required autofocus
                            class="block w-full rounded-full border-0 bg-white py-3.5 pl-11 pr-4 text-sm text-pivot-ink placeholder:text-[#75777E] focus:ring-[1.5px] focus:ring-pivot-link
                                      @error('name') ring-1 ring-pivot-error @enderror">
                    </div>
                    @error('name')
                    <p class="ml-1 mt-1 text-xs text-pivot-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal lahir --}}
                <div class="mt-4">
                    <label for="tanggal_lahir" class="ml-1 text-xs font-semibold text-pivot-muted">Tanggal Lahir</label>
                    <div class="relative mt-1.5">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-pivot-muted">
                            <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="5" width="18" height="16" rx="2" />
                                <path d="M3 10h18M8 3v4M16 3v4" />
                            </svg>
                        </span>
                        <input id="tanggal_lahir" name="tanggal_lahir" type="date" value="{{ old('tanggal_lahir') }}"
                            max="{{ now()->toDateString() }}" required
                            class="block w-full rounded-full border-0 bg-white py-3.5 pl-11 pr-4 text-sm text-pivot-ink focus:ring-[1.5px] focus:ring-pivot-link
                                      @error('tanggal_lahir') ring-1 ring-pivot-error @enderror">
                    </div>
                    @error('tanggal_lahir')
                    <p class="ml-1 mt-1 text-xs text-pivot-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mt-4">
                    <label for="email" class="ml-1 text-xs font-semibold text-pivot-muted">Email Siswa</label>
                    <div class="relative mt-1.5">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-pivot-muted">
                            <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="5" width="18" height="14" rx="2" />
                                <path d="M3 7l9 6 9-6" />
                            </svg>
                        </span>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            placeholder="nama@sekolah.sch.id" autocomplete="username" required
                            class="block w-full rounded-full border-0 bg-white py-3.5 pl-11 pr-4 text-sm text-pivot-ink placeholder:text-[#75777E] focus:ring-[1.5px] focus:ring-pivot-link
                                      @error('email') ring-1 ring-pivot-error @enderror">
                    </div>
                    @error('email')
                    <p class="ml-1 mt-1 text-xs text-pivot-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kata sandi --}}
                <div class="mt-4">
                    <label for="password" class="ml-1 text-xs font-semibold text-pivot-muted">Kata Sandi</label>
                    <div class="relative mt-1.5">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-pivot-muted">
                            <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="5" y="11" width="14" height="9" rx="2" />
                                <path d="M8 11V8a4 4 0 118 0v3" />
                            </svg>
                        </span>
                        <input id="password" name="password" :type="showPw ? 'text' : 'password'"
                            placeholder="Minimal 8 karakter" autocomplete="new-password" required
                            class="block w-full rounded-full border-0 bg-white py-3.5 pl-11 pr-12 text-sm text-pivot-ink placeholder:text-[#75777E] focus:ring-[1.5px] focus:ring-pivot-link
                                      @error('password') ring-1 ring-pivot-error @enderror">
                        <button type="button" @click="showPw = !showPw"
                            :aria-label="showPw ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-pivot-muted hover:text-pivot-ink">
                            <svg x-show="!showPw" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <svg x-show="showPw" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 3l18 18" />
                                <path d="M10.6 5.1A10.7 10.7 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-3.2 4.1M6.6 6.6A16.6 16.6 0 002 12s3.5 7 10 7a10.5 10.5 0 004.4-.9" />
                                <path d="M9.9 9.9a3 3 0 004.2 4.2" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <p class="ml-1 mt-1 text-xs text-pivot-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi kata sandi --}}
                <div class="mt-4">
                    <label for="password_confirmation" class="ml-1 text-xs font-semibold text-pivot-muted">Konfirmasi Kata Sandi</label>
                    <div class="relative mt-1.5">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-pivot-muted">
                            <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="5" y="11" width="14" height="9" rx="2" />
                                <path d="M8 11V8a4 4 0 118 0v3" />
                            </svg>
                        </span>
                        <input id="password_confirmation" name="password_confirmation" :type="showPw2 ? 'text' : 'password'"
                            placeholder="Ulangi kata sandi" autocomplete="new-password" required
                            class="block w-full rounded-full border-0 bg-white py-3.5 pl-11 pr-12 text-sm text-pivot-ink placeholder:text-[#75777E] focus:ring-[1.5px] focus:ring-pivot-link">
                        <button type="button" @click="showPw2 = !showPw2"
                            :aria-label="showPw2 ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-pivot-muted hover:text-pivot-ink">
                            <svg x-show="!showPw2" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <svg x-show="showPw2" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 3l18 18" />
                                <path d="M10.6 5.1A10.7 10.7 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-3.2 4.1M6.6 6.6A16.6 16.6 0 002 12s3.5 7 10 7a10.5 10.5 0 004.4-.9" />
                                <path d="M9.9 9.9a3 3 0 004.2 4.2" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Persetujuan --}}
                <div class="mt-5">
                    <div class="flex items-start gap-2.5">
                        <input id="terms" name="terms" type="checkbox" value="1" @checked(old('terms'))
                            class="mt-0.5 h-4 w-4 rounded-[3px] text-pivot-link focus:ring-pivot-link
                                      @error('terms') border-pivot-error @else border-[#767676] @enderror">
                        <label for="terms" class="text-xs leading-5 text-pivot-muted">
                            Saya menyetujui
                            <button type="button" @click.prevent="soon = 'Ketentuan Layanan'" class="font-semibold text-pivot-link hover:underline">Ketentuan Layanan</button>
                            &amp;
                            <button type="button" @click.prevent="soon = 'Kebijakan Privasi'" class="font-semibold text-pivot-link hover:underline">Kebijakan Privasi</button>
                            asesmen.
                        </label>
                    </div>
                    @error('terms')
                    <p class="ml-[26px] mt-1.5 text-xs text-pivot-error">Kamu harus menyetujui ketentuan untuk melanjutkan.</p>
                    @enderror
                </div>

                {{-- Tombol daftar --}}
                <button type="submit"
                    class="mt-6 flex h-[52px] w-full items-center justify-center gap-2 rounded-full bg-pivot-dark text-sm font-semibold text-white shadow-md transition hover:bg-black">
                    Daftar Sekarang
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </button>
            </form>
        </div>

        {{-- Kartu sosial (belum aktif, sama seperti versi mobile) --}}
        <div class="mt-4 rounded-[32px] bg-pivot-card p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="h-px flex-1 bg-pivot-line"></div>
                <span class="text-[10px] font-bold tracking-wider text-[#75777E]">ATAU MASUK DENGAN</span>
                <div class="h-px flex-1 bg-pivot-line"></div>
            </div>
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
        </div>

        <p x-show="soon" x-cloak x-text="soon + ' belum tersedia'" class="mt-3 text-center text-xs text-pivot-muted"></p>

        {{-- Footer --}}
        <p class="mt-4 text-center text-sm text-pivot-muted">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-pivot-link hover:underline">Masuk</a>
        </p>
    </div>
</x-auth-layout>