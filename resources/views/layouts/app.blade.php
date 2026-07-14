<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EDUPATH') - Platform Pendidikan & Rasionalisasi Jurusan</title>

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Nesa.ai" />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>

<body class="bg-white text-slate-800 flex h-screen overflow-hidden">

    <div id="sidebar-slot" class="w-0 md:w-auto shrink-0 overflow-visible z-[100] self-stretch">
        <x-sidebar />
    </div>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto"> 
        @yield('content')
    </main>

    @yield('scripts')

    <div id="g_id_onload" data-client_id="{{ env('GOOGLE_CLIENT_ID') }}" data-context="signin" data-ux_mode="popup"
        data-callback="handleCredentialResponse" data-auto_prompt="false">
    </div>
</body>

</html>