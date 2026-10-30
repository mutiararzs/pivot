@props(['title' => 'Beranda'])

@php
// Menu utama. 'route' => nama rute; 'ready' => false jika halamannya belum dibuat.
$menu = [
['label' => 'Beranda', 'route' => 'dashboard', 'match' => 'dashboard', 'ready' => true, 'icon' => 'home'],
['label' => 'Riwayat', 'route' => 'riwayat', 'match' => 'riwayat*', 'ready' => Route::has('riwayat'), 'icon' => 'history'],
['label' => 'Profil', 'route' => 'profile.edit', 'match' => 'profile*', 'ready' => Route::has('profile.edit'), 'icon' => 'user'],
];

$icons = [
'home' => '
<path d="M3 11l9-8 9 8" />
<path d="M5 10v10h5v-6h4v6h5V10" />',
'history' => '
<circle cx="12" cy="12" r="9" />
<path d="M12 7v5l3 2" />',
'user' => '
<circle cx="12" cy="8" r="4" />
<path d="M4 20c0-4 3.6-6 8-6s8 2 8 6" />',
];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - {{ config('app.name', 'PIVOT') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen antialiased">

    {{-- Sidebar (layar lebar) --}}
    <aside class="fixed inset-y-0 left-0 z-30 hidden w-64 flex-col border-r border-pivot-line bg-pivot-card/60 px-4 py-6 lg:flex">
        <div class="flex items-center gap-3 px-2">
            @if (file_exists(public_path('images/logo.png')))
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-9 w-9 object-contain">
            @else
            <svg class="h-9 w-9 text-pivot-link" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="9" />
                <path d="M15.5 8.5l-2 5-5 2 2-5 5-2z" />
            </svg>
            @endif
            <span class="text-lg font-bold tracking-tight text-pivot-ink">PIVOT</span>
        </div>

        <nav class="mt-8 flex-1 space-y-1">
            @foreach ($menu as $item)
            @php $active = request()->routeIs($item['match']); @endphp
            <a href="{{ $item['ready'] ? route($item['route']) : '#' }}"
                class="flex items-center gap-3 rounded-full px-4 py-3 text-sm transition
                              {{ $active ? 'bg-pivot-accent/20 font-semibold text-pivot-link' : 'font-medium text-pivot-muted hover:bg-white' }}">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" stroke-linejoin="round">{!! $icons[$item['icon']] !!}</svg>
                {{ $item['label'] }}
            </a>
            @endforeach
        </nav>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex w-full items-center gap-3 rounded-full px-4 py-3 text-sm font-medium text-pivot-muted transition hover:bg-white">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 4H5a2 2 0 00-2 2v12a2 2 0 002 2h4" />
                    <path d="M16 17l5-5-5-5M21 12H9" />
                </svg>
                Keluar
            </button>
        </form>
    </aside>

    {{-- Bar atas (layar kecil) --}}
    <header class="sticky top-0 z-20 flex h-16 items-center gap-4 border-b border-pivot-line/60 bg-pivot-bg px-5 lg:hidden">
        @if (file_exists(public_path('images/logo.png')))
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8 object-contain">
        @else
        <svg class="h-8 w-8 text-pivot-link" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="9" />
            <path d="M15.5 8.5l-2 5-5 2 2-5 5-2z" />
        </svg>
        @endif
        <span class="text-lg font-semibold text-pivot-ink">{{ $title }}</span>
    </header>

    {{-- Konten --}}
    <main class="px-5 pb-28 pt-6 lg:ml-64 lg:px-10 lg:pb-10 lg:pt-10">
        <div class="mx-auto max-w-5xl">
            {{ $slot }}
        </div>
    </main>

    {{-- Menu bawah (layar kecil) --}}
    <nav class="fixed inset-x-0 bottom-0 z-30 flex border-t border-pivot-line/60 bg-pivot-bg lg:hidden">
        @foreach ($menu as $item)
        @php $active = request()->routeIs($item['match']); @endphp
        <a href="{{ $item['ready'] ? route($item['route']) : '#' }}"
            class="flex flex-1 flex-col items-center gap-1 py-3 text-[11px]
                          {{ $active ? 'font-semibold text-pivot-link' : 'font-medium text-pivot-muted' }}">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                stroke-linecap="round" stroke-linejoin="round">{!! $icons[$item['icon']] !!}</svg>
            {{ $item['label'] }}
        </a>
        @endforeach
    </nav>
</body>

</html>