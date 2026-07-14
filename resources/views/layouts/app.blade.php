<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Glow n Go') - Asisten AI</title>

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Nesa.ai" />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        .text-gradient {
            background: linear-gradient(to right, #A855F7, #06B6D4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
@vite(['resources/css/app.css', 'resources/js/app.js'])

<body class="bg-white text-slate-800 flex h-screen overflow-hidden">

    {{-- 
        SIDEBAR SLOT:
        - Parent ini z-index dinaikin dikit biar gak ketiban elemen lain.
        - Lebar 0 di HP, normal di Desktop.
    --}}
    <div id="sidebar-slot" class="w-0 md:w-auto shrink-0 h-full overflow-visible z-[100]">
        <x-sidebar :chats="$chats" />
    </div>

    <main class="flex-1 flex flex-col h-full bg-white relative overflow-hidden">
        <x-navbar />
        @yield('content')
    </main>

    @yield('scripts')

    <div id="g_id_onload" data-client_id="{{ env('GOOGLE_CLIENT_ID') }}" data-context="signin" data-ux_mode="popup"
        data-callback="handleCredentialResponse" data-auto_prompt="false">
    </div>
</body>

</html>
