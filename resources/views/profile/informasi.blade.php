<x-student-layout title="Informasi Pribadi">
    @php
        $field = 'block w-full rounded-full border-0 bg-white py-3.5 pl-11 pr-4 text-sm text-pivot-ink placeholder:text-[#75777E] focus:ring-[1.5px] focus:ring-pivot-link';
        $label = 'ml-1 text-xs font-semibold text-pivot-muted';
        $ico = 'h-[18px] w-[18px]';
        $iconWrap = 'pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-pivot-muted';
    @endphp

    <div class="mx-auto max-w-xl">
        {{-- Bar judul + tombol kembali --}}
        <div class="flex items-center gap-2">
            <a href="{{ route('profile.edit') }}" aria-label="Kembali"
                class="flex h-10 w-10 items-center justify-center rounded-full text-pivot-ink transition hover:bg-pivot-line/60">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 5l-7 7 7 7" />
                </svg>
            </a>
            <h1 class="text-lg font-semibold leading-[26px] text-pivot-ink">Informasi Pribadi</h1>
        </div>

        {{-- Heading --}}
        <div class="mt-4">
            <span class="inline-flex items-center gap-1 rounded-full bg-[#CAE6FF] px-2 py-1 text-[10px] font-bold leading-[14px] text-[#004B70]">
                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 3l8 3v6c0 4.5-3.2 8-8 9-4.8-1-8-4.5-8-9V6z" />
                    <path d="M8.5 12l2.5 2.5 4.5-5" />
                </svg>
                Verifikasi Profil Resmi
            </span>
            <h2 class="mt-1 text-[26px] font-bold leading-[34px] text-pivot-ink">Lengkapi Identitas Diri</h2>
            <p class="mt-1 text-sm leading-[22px] text-pivot-muted">
                Informasi ini akan dicantumkan secara resmi dalam Laporan Hasil Asesmen PDF milikmu.
            </p>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-3" novalidate>
            @csrf
            @method('patch')

            {{-- Nama lengkap --}}
            <div class="rounded-[32px] bg-pivot-card p-4">
                <label for="name" class="{{ $label }}">Nama Lengkap</label>
                <div class="relative mt-1.5">
                    <span class="{{ $iconWrap }}">
                        <svg class="{{ $ico }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4" /><path d="M4 20c0-4 3.6-6 8-6s8 2 8 6" /></svg>
                    </span>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                        placeholder="Masukkan nama lengkap" autocomplete="name" required
                        class="{{ $field }} @error('name') ring-1 ring-pivot-error @enderror">
                </div>
                @error('name')<p class="ml-1 mt-1 text-xs text-pivot-error">{{ $message }}</p>@enderror
            </div>

            {{-- Email --}}
            <div class="rounded-[32px] bg-pivot-card p-4">
                <label for="email" class="{{ $label }}">Email</label>
                <div class="relative mt-1.5">
                    <span class="{{ $iconWrap }}">
                        <svg class="{{ $ico }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2" /><path d="M3 7l9 6 9-6" /></svg>
                    </span>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                        placeholder="nama@email.com" autocomplete="username" required
                        class="{{ $field }} @error('email') ring-1 ring-pivot-error @enderror">
                </div>
                @error('email')<p class="ml-1 mt-1 text-xs text-pivot-error">{{ $message }}</p>@enderror
            </div>

            {{-- Tanggal lahir --}}
            <div class="rounded-[32px] bg-pivot-card p-4">
                <label for="tanggal_lahir" class="{{ $label }}">Tanggal Lahir</label>
                <div class="relative mt-1.5">
                    <span class="{{ $iconWrap }}">
                        <svg class="{{ $ico }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2" /><path d="M3 10h18M8 3v4M16 3v4" /></svg>
                    </span>
                    <input id="tanggal_lahir" name="tanggal_lahir" type="date"
                        value="{{ old('tanggal_lahir', $user->tanggal_lahir?->format('Y-m-d')) }}"
                        max="{{ now()->subDay()->format('Y-m-d') }}" required
                        class="{{ $field }} @error('tanggal_lahir') ring-1 ring-pivot-error @enderror">
                </div>
                @error('tanggal_lahir')<p class="ml-1 mt-1 text-xs text-pivot-error">{{ $message }}</p>@enderror
            </div>

            {{-- Nomor WhatsApp --}}
            <div class="rounded-[32px] bg-pivot-card p-4">
                <label for="phone" class="{{ $label }}">Nomor WhatsApp Siswa</label>
                <div class="relative mt-1.5">
                    <span class="{{ $iconWrap }}">
                        <svg class="{{ $ico }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 005 5L15 13l5 2v4a2 2 0 01-2 2A16 16 0 013 6a2 2 0 012-2z" /></svg>
                    </span>
                    <input id="phone" name="phone" type="tel" value="{{ old('phone', $user->phone) }}"
                        placeholder="+62 8xx-xxxx-xxxx" autocomplete="tel" required
                        class="{{ $field }} @error('phone') ring-1 ring-pivot-error @enderror">
                </div>
                @error('phone')<p class="ml-1 mt-1 text-xs text-pivot-error">{{ $message }}</p>@enderror
            </div>

            {{-- Asal sekolah --}}
            <div class="rounded-[32px] bg-pivot-card p-4">
                <label for="school" class="{{ $label }}">Asal Sekolah</label>
                <div class="relative mt-1.5">
                    <span class="{{ $iconWrap }}">
                        <svg class="{{ $ico }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round"><path d="M2 9l10-5 10 5-10 5z" /><path d="M6 11v5c0 1.5 2.7 3 6 3s6-1.5 6-3v-5" /></svg>
                    </span>
                    <input id="school" name="school" type="text" value="{{ old('school', $user->school) }}"
                        placeholder="contoh: SMA Negeri 70 Jakarta" required
                        class="{{ $field }} @error('school') ring-1 ring-pivot-error @enderror">
                </div>
                @error('school')<p class="ml-1 mt-1 text-xs text-pivot-error">{{ $message }}</p>@enderror
            </div>

            {{-- Jenjang --}}
            <div class="rounded-[32px] bg-pivot-card p-4">
                <label for="level" class="{{ $label }}">Jenjang</label>
                <div class="relative mt-1.5">
                    <span class="{{ $iconWrap }}">
                        <svg class="{{ $ico }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round"><path d="M4 19V6a2 2 0 012-2h13v15H6a2 2 0 00-2 2z" /><path d="M4 19a2 2 0 002 2h13" /></svg>
                    </span>
                    <select id="level" name="level" required
                        class="{{ $field }} appearance-none @error('level') ring-1 ring-pivot-error @enderror">
                        <option value="" disabled @selected(! old('level', $user->level))>Pilih jenjang</option>
                        @foreach ($levels as $opt)
                        <option value="{{ $opt }}" @selected(old('level', $user->level) === $opt)>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
                @error('level')<p class="ml-1 mt-1 text-xs text-pivot-error">{{ $message }}</p>@enderror
            </div>

            {{-- Kelas --}}
            <div class="rounded-[32px] bg-pivot-card p-4">
                <label for="kelas" class="{{ $label }}">Kelas</label>
                <div class="relative mt-1.5">
                    <span class="{{ $iconWrap }}">
                        <svg class="{{ $ico }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3" /><circle cx="17" cy="9" r="2.5" /><path d="M3 20c0-3.3 2.7-5 6-5s6 1.7 6 5M15 15c3 0 6 1 6 4" /></svg>
                    </span>
                    <select id="kelas" name="kelas" required
                        class="{{ $field }} appearance-none @error('kelas') ring-1 ring-pivot-error @enderror">
                        <option value="" disabled @selected(! old('kelas', $user->kelas))>Pilih kelas</option>
                        @foreach ($classes as $opt)
                        <option value="{{ $opt }}" @selected(old('kelas', $user->kelas) === $opt)>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
                @error('kelas')<p class="ml-1 mt-1 text-xs text-pivot-error">{{ $message }}</p>@enderror
            </div>

            {{-- Kota --}}
            <div class="rounded-[32px] bg-pivot-card p-4">
                <label for="city" class="{{ $label }}">Kota / Kabupaten</label>
                <div class="relative mt-1.5">
                    <span class="{{ $iconWrap }}">
                        <svg class="{{ $ico }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z" /><circle cx="12" cy="10" r="2.5" /></svg>
                    </span>
                    <input id="city" name="city" type="text" value="{{ old('city', $user->city) }}"
                        placeholder="contoh: Tangerang" required
                        class="{{ $field }} @error('city') ring-1 ring-pivot-error @enderror">
                </div>
                @error('city')<p class="ml-1 mt-1 text-xs text-pivot-error">{{ $message }}</p>@enderror
            </div>

            <div class="pt-5">
                <button type="submit"
                    class="flex h-[54px] w-full items-center justify-center rounded-full bg-pivot-dark text-sm font-semibold text-white transition hover:brightness-110">
                    Simpan Perubahan
                </button>
                <p class="mt-2 flex items-center justify-center gap-1 text-center text-[10px] font-bold leading-[14px] text-pivot-muted">
                    <svg class="h-[11px] w-[11px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="5" y="11" width="14" height="10" rx="2" /><path d="M8 11V8a4 4 0 018 0v3" />
                    </svg>
                    Data tersimpan aman dan hanya dipakai untuk laporan asesmenmu
                </p>
            </div>
        </form>
    </div>
</x-student-layout>