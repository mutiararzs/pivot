<x-student-layout title="Keamanan">
    @php
        $field = 'block w-full rounded-full border-0 bg-white py-3.5 px-5 text-sm text-pivot-ink placeholder:text-[#75777E] focus:ring-[1.5px] focus:ring-pivot-link';
        $label = 'ml-1 text-xs font-semibold text-pivot-muted';
        $hasDeleteErrors = $errors->userDeletion->isNotEmpty();
    @endphp

    <div class="mx-auto max-w-xl" x-data="{ confirmDelete: @js($hasDeleteErrors) }"
        @keydown.escape.window="confirmDelete = false">

        {{-- Bar judul + tombol kembali --}}
        <div class="flex items-center gap-2">
            <a href="{{ route('profile.edit') }}" aria-label="Kembali"
                class="flex h-10 w-10 items-center justify-center rounded-full text-pivot-ink transition hover:bg-pivot-line/60">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 5l-7 7 7 7" />
                </svg>
            </a>
            <h1 class="text-lg font-semibold leading-[26px] text-pivot-ink">Kata Sandi &amp; Keamanan</h1>
        </div>

        {{-- Ubah kata sandi --}}
        <section class="mt-4 rounded-[32px] bg-pivot-card p-5">
            <h2 class="text-base font-semibold text-pivot-ink">Ubah Kata Sandi</h2>
            <p class="mt-1 text-xs leading-[18px] text-pivot-muted">
                Gunakan kata sandi yang panjang dan unik agar akunmu tetap aman.
            </p>

            <form method="POST" action="{{ route('password.update') }}" class="mt-4 space-y-3" novalidate>
                @csrf
                @method('put')

                <div>
                    <label for="current_password" class="{{ $label }}">Kata Sandi Saat Ini</label>
                    <input id="current_password" name="current_password" type="password" autocomplete="current-password"
                        class="{{ $field }} mt-1.5 @if ($errors->updatePassword->has('current_password')) ring-1 ring-pivot-error @endif">
                    @if ($errors->updatePassword->has('current_password'))
                    <p class="ml-1 mt-1 text-xs text-pivot-error">{{ $errors->updatePassword->first('current_password') }}</p>
                    @endif
                </div>

                <div>
                    <label for="password" class="{{ $label }}">Kata Sandi Baru</label>
                    <input id="password" name="password" type="password" autocomplete="new-password"
                        class="{{ $field }} mt-1.5 @if ($errors->updatePassword->has('password')) ring-1 ring-pivot-error @endif">
                    @if ($errors->updatePassword->has('password'))
                    <p class="ml-1 mt-1 text-xs text-pivot-error">{{ $errors->updatePassword->first('password') }}</p>
                    @endif
                </div>

                <div>
                    <label for="password_confirmation" class="{{ $label }}">Konfirmasi Kata Sandi Baru</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                        class="{{ $field }} mt-1.5">
                </div>

                <button type="submit"
                    class="mt-2 flex h-[54px] w-full items-center justify-center rounded-full bg-pivot-dark text-sm font-semibold text-white transition hover:brightness-110">
                    Simpan Kata Sandi
                </button>

                @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
                    class="text-center text-xs font-semibold text-pivot-link">Kata sandi berhasil diperbarui.</p>
                @endif
            </form>
        </section>

        {{-- Hapus akun --}}
        <section class="mt-4 rounded-[32px] bg-white p-5">
            <h2 class="text-base font-semibold text-pivot-ink">Hapus Akun</h2>
            <p class="mt-1 text-xs leading-[18px] text-pivot-muted">
                Setelah akun dihapus, seluruh data dan riwayat asesmenmu akan hilang secara permanen.
            </p>
            <button type="button" @click="confirmDelete = true"
                class="mt-4 flex w-full items-center justify-center rounded-full bg-[#FFDAD6] py-4 text-sm font-semibold text-[#93000A] transition hover:brightness-95">
                Hapus Akun Saya
            </button>
        </section>

        {{-- Dialog konfirmasi hapus akun --}}
        <div x-show="confirmDelete" x-cloak x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-pivot-ink/40 px-6"
            @click.self="confirmDelete = false" role="dialog" aria-modal="true" aria-labelledby="delete-title">
            <form method="POST" action="{{ route('profile.destroy') }}" class="w-full max-w-sm rounded-[28px] bg-pivot-bg p-6 shadow-xl">
                @csrf
                @method('delete')
                <h3 id="delete-title" class="text-lg font-semibold text-pivot-ink">Hapus akun secara permanen?</h3>
                <p class="mt-3 text-sm text-pivot-muted">Masukkan kata sandimu untuk mengonfirmasi penghapusan akun.</p>

                <input name="password" type="password" placeholder="Kata sandi" autocomplete="current-password"
                    class="{{ $field }} mt-4 @if ($errors->userDeletion->has('password')) ring-1 ring-pivot-error @endif">
                @if ($errors->userDeletion->has('password'))
                <p class="ml-1 mt-1 text-xs text-pivot-error">{{ $errors->userDeletion->first('password') }}</p>
                @endif

                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" @click="confirmDelete = false"
                        class="rounded-full px-4 py-2 text-sm font-semibold text-pivot-link transition hover:bg-pivot-line/60">Batal</button>
                    <button type="submit"
                        class="rounded-full px-4 py-2 text-sm font-semibold text-[#93000A] transition hover:bg-[#FFDAD6]">Hapus Akun</button>
                </div>
            </form>
        </div>
    </div>
</x-student-layout>