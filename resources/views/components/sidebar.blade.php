@props(['chats' => collect()])

@php
    $pinnedChats = $chats ? $chats->where('is_pinned', true) : collect();
    $regularChats = $chats ? $chats->where('is_pinned', false) : collect();

    $forbiddenRoute = request()->routeIs([
        'dashboard',
        'edupath.learning',
        'belajar.show',
        'belajar.materi',
        'belajar.read',
        'belajar.kuis',
        'riwayat.dokumen'
    ]);

@endphp

{{-- BACKDROP MOBILE --}}
<div id="sidebar-backdrop"
    class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[90] hidden md:hidden transition-opacity duration-300"
    onclick="closeSidebar()">
</div>

{{-- HAMBURGER FLOATING — mobile only --}}
<button id="mobile-hamburger" onclick="openSidebar()"
    class="fixed top-3 left-3 z-[80] w-10 h-10 flex items-center justify-center text-slate-600 hover:bg-cyan-50 hover:text-cyan-700 transition-all focus:outline-none md:hidden">
    <i class="fas fa-bars text-base"></i>
</button>

<aside id="sidebar"
    class="fixed md:static inset-y-0 left-0 h-full bg-white border-r border-slate-200 flex flex-col z-[100] shrink-0 group/sidebar transition-all duration-300 w-[280px] md:w-16 -translate-x-full md:translate-x-0">

    {{-- BAGIAN MENU ATAS — flex-1 min-h-0 supaya bisa shrink & dorong menu bawah --}}
    <div class="p-3 flex flex-col gap-2 mt-2 w-full overflow-hidden flex-1 min-h-0">

        <div class="flex md:hidden items-center justify-between px-2 pb-2 mb-2 border-b border-slate-100">
            {{-- LOGO BRAND --}}
            <div class="flex items-center gap-2">
                <span class="text-xl md:text-2xl text-emerald-600"><i class="fas fa-graduation-cap"></i></span>
                <span class="text-lg md:text-xl font-extrabold tracking-tight text-slate-900">EDUPATH</span>
            </div>

            {{-- TOMBOL CLOSE (Mobile Only) --}}
            <button onclick="closeSidebar()"
                class="md:hidden w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:text-red-500 hover:bg-red-50 transition-colors focus:outline-none">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>

        {{-- TOGGLE SIDEBAR (DESKTOP ONLY) --}}
        <div class="relative group/item w-max hidden md:block shrink-0">
            <button onclick="toggleSidebar()"
                class="group/btn w-10 h-10 flex items-center justify-center rounded-full hover:bg-cyan-50 hover:text-cyan-700 text-slate-600 transition-all focus:outline-none cursor-pointer">
                <i class="fas fa-bars text-base transition-colors group-hover/btn:text-cyan-600"></i>
            </button>
        </div>

        @if ($forbiddenRoute)

            {{-- BAGIAN MENU ATAS --}}
            <div class="flex-1 overflow-y-auto mt-4 min-h-0">

                <p
                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-2 mb-2 sidebar-text whitespace-nowrap">
                    Menu Utama</p>
                <nav class="space-y-1 mb-5">
                    {{-- Logika Aktif untuk Dashboard --}}
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-3 py-2.5 font-bold rounded-xl text-sm transition-all group/btn 
            {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <i
                            class="fa-solid fa-th-large w-5 text-center shrink-0 {{ request()->routeIs('dashboard') ? 'text-emerald-600' : 'text-slate-400 group-hover/btn:text-emerald-600' }}"></i>
                        <span class="sidebar-text whitespace-nowrap">Dashboard</span>
                    </a>

                    {{-- Logika Aktif untuk Akademi Literasi --}}
                    <a href="{{ route('edupath.learning') }}"
                        class="flex items-center gap-3 px-3 py-2.5 font-bold rounded-xl text-sm transition-all group/btn 
            {{ request()->routeIs(['edupath.learning', 'belajar.*']) ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <i
                            class="fa-solid fa-book-open w-5 text-center shrink-0 {{ request()->routeIs(['edupath.learning', 'belajar.*']) ? 'text-emerald-600' : 'text-slate-400 group-hover/btn:text-emerald-600' }}"></i>
                        <span class="sidebar-text whitespace-nowrap">Akademi Literasi AI</span>
                    </a>
                </nav>

                <p
                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-2 mb-2 sidebar-text whitespace-nowrap">
                    Portal Asisten AI</p>
                <nav class="space-y-1 mb-5">
                    {{-- Logika Aktif untuk Akses AI --}}
                    <a href="{{ route('app.assistant.chat') }}"
                        class="flex items-center gap-3 px-3 py-2.5 font-bold rounded-xl text-sm transition-all group/btn 
            {{ request()->routeIs('app.assistant.chat') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <i
                            class="fa-solid fa-atom w-5 text-center shrink-0 {{ request()->routeIs('app.assistant.chat') ? 'text-emerald-600' : 'text-slate-400 group-hover/btn:text-emerald-600' }}"></i>
                        <span class="sidebar-text whitespace-nowrap">Akses AI</span>
                    </a>
                </nav>

                <p
                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-2 mb-2 sidebar-text whitespace-nowrap">
                    Arsip & Riwayat</p>
                <nav class="space-y-1">
                    {{-- Logika Aktif untuk Riwayat Dokumen --}}
                    <a href="{{route('riwayat.dokumen')}}"
                        class="flex items-center gap-3 px-3 py-2.5 font-bold rounded-xl text-sm transition-all group/btn 
                        {{ request()->routeIs('riwayat.dokumen') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <i
                            class="fa-solid fa-file-invoice w-5 text-center shrink-0 {{ request()->routeIs('riwayat.dokumen') ? 'text-emerald-600' : 'text-slate-400 group-hover/btn:text-emerald-600' }}"></i>
                        <span class="sidebar-text whitespace-nowrap">Riwayat Dokumen</span>
                    </a>
                </nav>
            </div>
        @else
            {{-- MENU KHUSUS HALAMAN CHAT --}}

            <div class="relative group/item md:mt-4 w-full shrink-0">
                <button onclick="backToLanding(); if(window.innerWidth < 768) closeSidebar();"
                    class="group/btn flex items-center w-full p-2.5 rounded-full hover:bg-cyan-50 hover:text-cyan-700 text-slate-700 transition-colors focus:outline-none bg-white shadow-sm border border-slate-100 cursor-pointer">
                    <i
                        class="fas fa-plus text-base shrink-0 transition-colors group-hover/btn:text-cyan-600 w-5 text-center"></i>
                    <span class="sidebar-text ml-3 font-semibold text-sm whitespace-nowrap">Percakapan Baru</span>
                </button>
            </div>

            <div class="relative group/item mt-1 w-full shrink-0">
                <button onclick="window.toggleSearchModal(); if(window.innerWidth < 768) closeSidebar();"
                    class="group/btn flex items-center w-full p-2.5 rounded-full hover:bg-cyan-50 hover:text-cyan-700 text-slate-700 transition-colors focus:outline-none cursor-pointer">
                    <i
                        class="fas fa-search text-base ml-1 shrink-0 transition-colors group-hover/btn:text-cyan-600 w-5 text-center"></i>
                    <span class="sidebar-text ml-3 font-semibold text-sm whitespace-nowrap">Telusuri percakapan</span>
                </button>
            </div>

            {{-- 👇 FIX: Pakai relative & absolute inset-0 biar anti mendorong menu bawah 👇 --}}
            <div class="flex-1 relative w-full mt-2 transition-all duration-300 md:opacity-0 md:invisible group-[.expanded]/sidebar:opacity-100 group-[.expanded]/sidebar:visible">
                <div class="absolute inset-0 overflow-y-auto no-scrollbar pb-4 flex flex-col" id="chat-history-sidebar">
                    <p
                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-2 pt-2 pb-1 sidebar-text whitespace-nowrap shrink-0">
                        Aktivitas
                    </p>
                    <div class="space-y-0.5 w-full flex flex-col shrink-0" id="sidebar-pinned-list">
                        @foreach ($pinnedChats as $chat)
                            @php $isActive = isset($currentChatId) && $currentChatId == $chat->id; @endphp
                            @include('components.sidebar-row', [
                                'chat' => $chat,
                                'isActive' => $isActive,
                                'isPinned' => true,
                            ])
                        @endforeach
                    </div>
                    <div class="space-y-0.5 w-full flex flex-col shrink-0" id="sidebar-regular-list">
                        @forelse ($regularChats as $chat)
                            @php $isActive = isset($currentChatId) && $currentChatId == $chat->id; @endphp
                            @include('components.sidebar-row', [
                                'chat' => $chat,
                                'isActive' => $isActive,
                                'isPinned' => false,
                                'loopIndex' => $loop->index,
                            ])
                        @empty
                            @if ($pinnedChats->isEmpty())
                                <div id="sidebar-empty-state"
                                    class="text-xs text-slate-400 italic px-3 py-2 flex items-center justify-center gap-2 w-full text-center sidebar-text whitespace-nowrap shrink-0">
                                    <svg class="w-4 h-4 text-slate-300 shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Belum ada aktivitas obrolan.
                                </div>
                            @endif
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- ========================================== --}}
    {{-- MENU BAWAH — shrink-0 supaya selalu nempel di bawah --}}
    {{-- ========================================== --}}
    <div class="p-3 flex flex-col gap-1 mb-2 w-full relative border-t border-slate-100 md:border-none shrink-0">

        <div class="relative group/item w-full">
            <a href="{{ route('dashboard') }}"
                class="group/btn flex items-center w-full p-2.5 rounded-full hover:bg-slate-100 text-slate-700 transition-colors focus:outline-none cursor-pointer decoration-none">
                <i
                    class="fas fa-graduation-cap text-base shrink-0 transition-colors group-hover/btn:text-cyan-600 w-5 text-center"></i>
                <span class="sidebar-text ml-3 text-sm font-semibold whitespace-nowrap">Ruang Belajar</span>
            </a>
        </div>

        <div class="relative group/item w-full">
            <a href="/"
                class="group/btn flex items-center w-full p-2.5 rounded-full hover:bg-slate-100 text-slate-700 transition-colors focus:outline-none cursor-pointer decoration-none">
                <i
                    class="fas fa-home text-base shrink-0 transition-colors group-hover/btn:text-cyan-600 w-5 text-center"></i>
                <span class="sidebar-text ml-3 text-sm font-semibold whitespace-nowrap">Home</span>
            </a>
        </div>

        @if (auth()->check())
            <div id="account-popup-modal"
                class="hidden absolute bottom-16 left-4 md:left-16 w-64 bg-white border border-slate-200 rounded-2xl shadow-xl p-4 flex flex-col gap-3 z-[100] animate-fade-in-up">
                <div class="flex flex-col border-b border-slate-100 pb-2.5 text-left">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Akun Aktif</span>
                    <span class="text-sm font-bold text-slate-800 truncate mt-0.5">{{ auth()->user()->name }}</span>
                    <span
                        class="text-xs text-slate-500 truncate">{{ $userEmail ?? (auth()->user()->email ?? '') }}</span>
                </div>
                <div class="flex flex-col gap-1">
                    <button onclick="window.openGoogleLoginModal()"
                        class="flex items-center gap-2.5 w-full px-2.5 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50 rounded-xl transition-colors cursor-pointer text-left">
                        <i class="fas fa-user-plus text-slate-400 text-sm w-4"></i>
                        <span>Switch Email Lainnya</span>
                    </button>
                    <form action="{{ route('logout') ?? '#' }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2.5 w-full px-2.5 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 rounded-xl transition-colors cursor-pointer text-left">
                            <i class="fas fa-sign-out-alt text-red-500 text-sm w-4"></i>
                            <span>Keluar dari akun</span>
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <div class="relative group/item w-full">
            <button onclick="{{ $clickAction ?? 'window.toggleAccountModal()' }}" id="account-btn-trigger"
                class="flex items-center w-full p-2.5 rounded-full transition-colors text-slate-700 focus:outline-none cursor-pointer">
                <div
                    class="w-10 h-10 shrink-0 -ml-2 rounded-full flex items-center justify-center text-white text-[16px] font-bold shadow-sm uppercase overflow-hidden">
                    @if (!empty($avatarDisplay) || auth()->user()?->avatar)
                        <img src="{{ $avatarDisplay ?? auth()->user()->avatar }}" alt="Avatar"
                            class="w-full h-full object-cover">
                    @else
                        <div
                            class="w-full h-full bg-gradient-to-tr from-purple-500 to-cyan-500 flex items-center justify-center">
                            {{ $avatarInitials ?? 'SC' }}
                        </div>
                    @endif
                </div>
                <span class="sidebar-text ml-3 text-sm font-medium truncate">
                    {{ auth()->check() ? $fullName ?? auth()->user()->name : $displayName ?? 'Guest' }}
                </span>
            </button>
            <div
                class="custom-tooltip bg-slate-800 text-white text-xs px-2.5 py-1.5 rounded-md shadow-lg font-medium hidden md:block">
                {{ auth()->check() ? 'Menu Akun' : 'Klik untuk Login Google' }}
            </div>
        </div>
    </div>
</aside>

@unless ($forbiddenRoute)
    <div id="sidebar-action-dropdown"
        class="hidden fixed w-48 bg-white border border-slate-200 rounded-xl shadow-[0_12px_30px_-5px_rgba(0,0,0,0.12)] py-1.5 z-[9999] animate-fade-in text-left"
        data-chat-id="" data-pin-state="0">
        <button onclick="window.handleSidebarAction('pin')"
            class="dropdown-pin-btn w-full px-3 py-2 flex items-center gap-2.5 text-xs font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors cursor-pointer"
            data-pinned="0">
            <i class="fas fa-thumbtack dropdown-pin-icon text-slate-400 w-3.5 text-center"></i>
            <span class="dropdown-pin-text">Sematkan</span>
        </button>
        <button onclick="window.handleSidebarAction('rename')"
            class="w-full px-3 py-2 flex items-center gap-2.5 text-xs font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors cursor-pointer">
            <i class="fas fa-edit text-slate-400 w-3.5 text-center"></i>
            <span>Ganti Nama</span>
        </button>
        <div class="h-px bg-slate-100 my-1"></div>
        <button onclick="window.handleSidebarAction('delete')"
            class="w-full px-3 py-2 flex items-center gap-2.5 text-xs font-bold text-red-500 hover:bg-red-50 hover:text-red-600 transition-colors cursor-pointer">
            <i class="fas fa-trash-alt w-3.5 text-center"></i>
            <span>Hapus Obrolan</span>
        </button>
    </div>

    <div id="sidebar-rename-inline"
        class="hidden fixed z-[9999] bg-white border border-cyan-400 rounded-lg shadow-lg px-2 py-1.5 flex items-center gap-1.5"
        style="min-width:180px">
        <input id="sidebar-rename-input" type="text" maxlength="80"
            class="flex-1 text-xs font-semibold text-slate-800 outline-none border-none bg-transparent"
            placeholder="Judul baru...">
        <button onclick="window.confirmRename()"
            class="text-cyan-600 hover:text-cyan-800 transition-colors cursor-pointer" title="Simpan">
            <i class="fas fa-check text-xs"></i>
        </button>
        <button onclick="window.cancelRename()"
            class="text-slate-400 hover:text-slate-600 transition-colors cursor-pointer" title="Batal">
            <i class="fas fa-times text-xs"></i>
        </button>
    </div>
@endunless
