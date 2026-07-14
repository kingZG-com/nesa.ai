@extends('layouts.app')
@section('title', 'SISTAN - Asisten andalan EDUPATH')

@section('content')

    {{-- Main container utama --}}
    <main class="flex-1 flex flex-col h-full bg-slate-100 relative overflow-hidden">

        {{-- Konten Utama berjalan di atas master ornamen (z-10) --}}
        <div class="flex-1 overflow-y-auto flex flex-col relative no-scrollbar z-10" id="scrollable-content">

            {{-- ==================== LANDING VIEW ==================== --}}
            <div id="landing-view"
                class="flex-1 flex flex-col items-center justify-center w-full min-h-full px-4 sm:px-6 py-10 transition-opacity duration-500 relative">

                <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden select-none">
                    <div
                        class="absolute -top-[10%] -left-[10%] w-[70vw] h-[70vw] rounded-full bg-indigo-300/35 blur-[130px]">
                    </div>
                    <div
                        class="absolute -bottom-[10%] -right-[10%] w-[70vw] h-[70vw] rounded-full bg-emerald-300/35 blur-[130px]">
                    </div>
                    <div class="absolute top-[30%] left-[20%] w-[50vw] h-[50vw] rounded-full bg-teal-300/35 blur-[140px]">
                    </div>
                </div>

                <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden select-none">
                    <div
                        class="absolute inset-0 bg-[linear-gradient(to_right,#cbd5e1_1px,transparent_1px),linear-gradient(to_bottom,#cbd5e1_1px,transparent_1px)] bg-[size:1.5rem_1.5rem] [mask-image:radial-gradient(ellipse_80%_80%_at_50%_50%,#000_60%,transparent_100%)] opacity-20">
                    </div>
                </div>

                <div class="w-full max-w-3xl mx-auto flex flex-col items-center text-center relative z-10">
                    <div class="mb-8 md:mb-10 w-full">
                        <h1 class="text-4xl font-medium text-gradient tracking-tight leading-tight">
                            Halo{{ $displayName === 'Akun Guest' ? '' : ' ' . $displayName }}, apa yang bisa Sistan bantu hari
                            ini?
                        </h1>
                    </div>

                    <div class="w-full relative z-20">
                        {{-- Gradient border wrapper --}}
                        <div
                            class="relative p-[2px] rounded-[1.5rem] md:rounded-full transition-all duration-300 bg-slate-200/70 hover:bg-slate-300/70 focus-within:bg-gradient-to-r focus-within:from-indigo-600 focus-within:to-emerald-500 shadow-lg focus-within:shadow-[0_0_30px_rgba(16,185,129,0.3)] group">
                            <div
                                class="relative bg-white/80 backdrop-blur-xl rounded-[1.40rem] md:rounded-full flex flex-row items-center p-1.5 transition-all duration-300 focus-within:bg-white w-full">

                                {{-- 🔥 OPTIMASI MOBILE: min-h dinaikin biar lebih tinggi di HP 🔥 --}}
                                <textarea id="main-prompt" rows="1"
                                    class="flex-1 pl-4 bg-transparent text-slate-800 placeholder-slate-400 py-3 text-base md:text-[15px] focus:outline-none resize-none no-scrollbar first-letter:uppercase self-center leading-tight min-h-[44px]"
                                    placeholder="Ketik pertanyaan untuk Sistan..."></textarea>

                                {{-- Action Buttons --}}
                                <div class="flex items-center gap-1.5 shrink-0 pr-1">
                                    <button type="button" id="voice-btn-main"
                                        onclick="toggleVoiceInput('main-prompt', 'voice-btn-main')"
                                        class="w-11 h-11 rounded-full flex items-center justify-center text-slate-400 hover:bg-emerald-50 hover:text-emerald-600 transition-all focus:outline-none">
                                        <i class="fas fa-microphone-lines text-xl"></i>
                                    </button>
                                    <button type="button" onclick="submitPrompt(event)"
                                        class="w-11 h-11 rounded-full bg-indigo-600 hover:to-emerald-600 text-white flex items-center justify-center transition-all duration-300 shadow-md hover:shadow-emerald-500/40 focus:outline-none">
                                        <i class="fas fa-location-arrow text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==================== CHAT VIEW ==================== --}}
            <div id="chat-view" class="hidden w-full flex flex-col h-full transition-opacity duration-500 relative">

                <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden select-none">
                    <div
                        class="absolute -top-[15%] -left-[10%] w-[65vw] h-[65vw] rounded-full bg-indigo-400/10 blur-[140px]">
                    </div>
                    <div
                        class="absolute -bottom-[15%] -right-[10%] w-[65vw] h-[65vw] rounded-full bg-emerald-400/15 blur-[140px]">
                    </div>
                    <div class="absolute top-[35%] left-[25%] w-[45vw] h-[45vw] rounded-full bg-teal-400/10 blur-[140px]">
                    </div>
                </div>

                {{-- NAVBAR CHAT --}}
                <div
                    class="sticky top-0 left-0 right-0 w-full flex items-center justify-between px-4 py-1 border-b border-slate-200/40 bg-slate-100/10 backdrop-blur-3xl z-20 theDrop md:pl-4">
                    <button type="button" onclick="backToLanding()"
                        class="p-2 rounded-full hover:bg-slate-200/60 text-slate-600 transition-all focus:outline-none cursor-pointer"
                        title="Kembali">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <div class="relative flex items-center justify-center flex-1">
                        <button onclick="event.stopPropagation(); window.toggleDropdown(event, 'navbar-chat-dropdown')"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl hover:bg-slate-200/50 text-slate-700 hover:text-slate-900 transition-all duration-200 cursor-pointer focus:outline-none group/title">
                            <span id="chat-title"
                                class="text-sm font-bold truncate max-w-[150px] sm:max-w-xs tracking-wide drop-shadow-sm"></span>
                            <i
                                class="fas fa-chevron-down text-[10px] text-slate-400 group-hover/title:text-slate-600 transition-transform duration-200"></i>
                        </button>

                        <div id="navbar-chat-dropdown"
                            class="hidden absolute top-full mt-2 w-48 bg-white border border-slate-200 rounded-xl shadow-[0_10px_25px_-5px_rgba(0,0,0,0.08)] py-1.5 z-50 animate-fade-in text-left left-1/2 -translate-x-1/2">
                            <button
                                onclick="event.stopPropagation(); window.toggleDropdown(null, 'navbar-chat-dropdown'); window.renameChatFromNavbar()"
                                class="group w-full px-3 py-2 flex items-center gap-2.5 text-xs font-semibold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 transition-colors cursor-pointer">
                                <i
                                    class="fas fa-edit text-slate-400 w-3.5 text-center transition-colors group-hover:text-emerald-600"></i>
                                Ganti Nama
                            </button>
                            <button
                                onclick="event.stopPropagation(); window.toggleDropdown(null, 'navbar-chat-dropdown'); window.pinChatFromNavbar()"
                                class="group w-full px-3 py-2 flex items-center gap-2.5 text-xs font-semibold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 transition-colors cursor-pointer border-t border-slate-50">
                                <i
                                    class="fas fa-thumbtack text-slate-400 w-3.5 text-center transition-colors group-hover:text-emerald-600"></i>
                                Sematkan Chat
                            </button>
                        </div>
                    </div>

                    <div class="relative shrink-0">
                        <button type="button" onclick="toggleDropdown(event, 'chat-options-dropdown')"
                            class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-200/60 text-slate-500 hover:text-slate-800 transition-all focus:outline-none cursor-pointer"
                            title="Opsi">
                            <i class="fas fa-ellipsis-v text-base"></i>
                        </button>
                        <div id="chat-options-dropdown"
                            class="absolute right-0 top-full mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden hidden z-30">
                            <div class="py-1.5 flex flex-col">
                                <button type="button" onclick="startNewChat()"
                                    class="group text-left px-4 py-3 text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-3 transition-colors cursor-pointer">
                                    <i
                                        class="fas fa-plus text-slate-400 w-4 text-center transition-colors group-hover:text-emerald-600"></i>
                                    Mulai Chat Baru
                                </button>
                                <button type="button" onclick="pinChat()"
                                    class="group text-left px-4 py-3 text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-3 border-t border-slate-50 transition-colors cursor-pointer">
                                    <i
                                        class="fas fa-thumbtack text-slate-400 w-4 text-center transition-colors group-hover:text-emerald-600"></i>
                                    Sematkan Chat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="chat-messages"
                    class="flex-1 w-full max-w-3xl mx-auto overflow-y-auto no-scrollbar px-4 md:px-6 pb-32 pt-6 space-y-6 relative z-10">

                    @isset($messages)
                        @foreach ($messages as $msg)
                            @if ($msg->role === 'user')
                                <div class="flex justify-end w-full">
                                    <div class="bg-indigo-600 text-white px-5 py-3 rounded-2xl max-w-[85%] shadow-sm text-sm">
                                        {{ $msg->message }}
                                    </div>
                                </div>
                            @else
                                <div class="flex justify-start w-full">
                                    <div
                                        class="bg-slate-100 border border-slate-200 text-slate-800 p-4 rounded-2xl max-w-[85%] shadow-sm text-sm">
                                        {!! $msg->message !!}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endisset

                    @isset($chat)
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                currentChatId = {{ $chat->id }};
                                window.switchToChatView();

                                // Pastikan hamburger disembunyikan jika dibuka langsung dari URL
                                const burger = document.getElementById('mobile-hamburger');
                                if (burger) burger.classList.add('hidden');

                                const chatTitle = document.getElementById('chat-title');
                                if (chatTitle) chatTitle.textContent = '{{ addslashes($chat->title) }}';
                                setTimeout(() => {
                                    const chatBox = document.getElementById('chat-messages');
                                    if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
                                }, 100);
                            });
                        </script>
                    @endisset
                </div>

                {{-- INPUT FOLLOW UP --}}
                <div
                    class="absolute bottom-0 left-0 right-0 w-full p-4 bg-gradient-to-t from-slate-100 via-slate-100/90 to-transparent z-20">
                    <div
                        class="w-full max-w-3xl mx-auto relative p-[2px] rounded-[1.5rem] md:rounded-full transition-all duration-300 bg-white/70 hover:bg-white/90 focus-within:bg-gradient-to-r focus-within:from-indigo-600 focus-within:to-emerald-500 shadow-[0_-5px_20px_rgba(0,0,0,0.03)] focus-within:shadow-[0_0_20px_rgba(16,185,129,0.2)] group backdrop-blur-xl border border-slate-200 focus-within:border-transparent">
                        <div
                            class="relative bg-white/90 backdrop-blur-xl rounded-[1.40rem] md:rounded-full flex flex-row items-center p-1 md:p-1.5 transition-all duration-300 w-full">

                            {{-- 🔥 OPTIMASI MOBILE: min-h dinaikin biar sejajar ukurannya 🔥 --}}
                            <textarea id="chat-prompt" rows="1"
                                class="flex-1 bg-transparent text-slate-800 placeholder-slate-400 px-3 md:px-4 py-4 md:py-3 text-base md:text-[15px] focus:outline-none resize-none no-scrollbar self-center leading-tight min-h-[44px]"
                                style="max-height:160px;" placeholder="Tulis pertanyaan..."></textarea>

                            <div class="flex items-center gap-1.5 shrink-0 pr-1">
                                <button type="button" id="voice-btn-chat"
                                    onclick="toggleVoiceInput('chat-prompt', 'voice-btn-chat')"
                                    class="w-11 h-11 rounded-full flex items-center justify-center text-slate-400 hover:bg-emerald-50 hover:text-emerald-600 transition-all focus:outline-none">
                                    <i class="fas fa-microphone-lines text-xl"></i>
                                </button>
                                <button type="button" onclick="submitChatFollowUp()"
                                    class="w-11 h-11 rounded-full bg-indigo-600 hover:to-emerald-600 text-white flex items-center justify-center transition-all duration-300 shadow-md hover:shadow-emerald-500/40 focus:outline-none">
                                    <i class="fas fa-location-arrow text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- MODAL TELUSURI --}}
        <div id="search-modal"
            class="hidden fixed inset-0 z-[9999] flex items-center justify-center p-4 transition-all duration-300">
            <div onclick="window.toggleSearchModal()"
                class="absolute inset-0 bg-slate-950/40 backdrop-blur-md transition-opacity duration-300"></div>

            <div
                class="relative w-[95%] sm:w-full mx-auto max-w-2xl bg-white/90 border border-slate-200/60 rounded-[1.5rem] shadow-[0_25px_60px_-15px_rgba(0,0,0,0.2)] overflow-hidden flex flex-col animate-fade-in-up transform transition-all duration-300 max-h-[75vh] md:max-h-[65vh] backdrop-blur-xl">
                <div class="h-[3px] w-full bg-gradient-to-r from-indigo-600 to-emerald-500"></div>

                <div class="p-3 md:p-4 flex items-center gap-2 bg-white border-b border-slate-100">
                    <div class="w-6 h-6 flex items-center justify-center text-slate-400">
                        <i
                            class="fas fa-search text-sm md:text-base bg-gradient-to-tr from-indigo-600 to-emerald-500 bg-clip-text text-transparent"></i>
                    </div>
                    <input type="text" id="search-input" oninput="window.handleSearchInput(this.value)"
                        placeholder="Ketik kata kunci atau topik obrolan..."
                        class="flex-1 bg-transparent border-none text-[13px] md:text-sm font-semibold text-slate-800 placeholder-slate-400 focus:outline-none tracking-wide capitalize">
                    <button onclick="window.clearSearchInput()" id="btn-clear-search"
                        class="hidden p-1.5 md:p-2 rounded-full text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200 focus:outline-none cursor-pointer">
                        <i class="fas fa-times-circle text-[13px] md:text-sm"></i>
                    </button>
                    <span class="w-px h-5 bg-slate-200 mx-0.5"></span>
                    <button onclick="window.toggleSearchModal()"
                        class="p-1.5 md:p-2 rounded-xl hover:bg-slate-100 text-slate-400 hover:text-slate-700 transition-all duration-200 focus:outline-none cursor-pointer"
                        title="Tutup">
                        <i class="fas fa-times text-[13px] md:text-sm"></i>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-3 md:p-4 no-scrollbar bg-slate-50/50">
                    <div class="flex justify-between items-center mb-2 px-1">
                        <h3 id="search-container-title"
                            class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Percakapan Terbaru</h3>
                    </div>
                    <div class="space-y-1.5" id="search-results-container">
                        @forelse($chats as $chat)
                            <div onclick="window.loadSpecificChatFromSearch('{{ $chat->id }}')"
                                data-title="{{ strtolower($chat->title) }}"
                                class="search-item-card bg-white border border-slate-100 rounded-xl p-3 shadow-sm hover:shadow-[0_8px_20px_-6px_rgba(16,185,129,0.1)] hover:border-emerald-300 hover:bg-emerald-50/10 transition-all duration-200 cursor-pointer flex justify-between items-center group">
                                <div class="flex items-center gap-3 truncate">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-200">
                                        <i class="fas fa-comment-alt text-xs"></i>
                                    </div>
                                    <span
                                        class="search-item-title text-xs font-bold text-slate-700 group-hover:text-slate-900 truncate">
                                        {{ $chat->title }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div id="section-pencarian" class="text-center py-10 px-4 select-none">
                                <div class="mb-3"><i class="fas fa-folder-open text-2xl text-slate-300"></i></div>
                                <h3 class="text-xs font-bold text-slate-500">Belum Ada Obrolan</h3>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL RENAME --}}
        <div id="rename-modal"
            class="hidden fixed inset-0 z-[99999] flex items-center justify-center bg-black/40 backdrop-blur-sm animate-fade-in">
            <div
                class="bg-white rounded-2xl shadow-2xl border border-slate-100 p-6 max-w-sm w-full mx-4 flex flex-col gap-4 animate-fade-in-up">
                <div class="flex flex-col gap-1.5">
                    <h3 class="text-base font-bold text-slate-800">Ganti Nama Percakapan</h3>
                    <p class="text-xs text-slate-500">Masukkan nama baru untuk obrolan ini.</p>
                </div>
                <div>
                    <input type="text" id="rename-modal-input" maxlength="80"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all"
                        placeholder="Judul baru...">
                </div>
                <div class="flex gap-2 justify-end mt-2">
                    <button onclick="window.closeRenameModal()"
                        class="px-4 py-2 text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors cursor-pointer">
                        Batal
                    </button>
                    <button onclick="window.confirmRenameModal()"
                        class="px-4 py-2 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors cursor-pointer shadow-md hover:shadow-emerald-500/30">
                        Simpan
                    </button>
                </div>
            </div>
        </div>

    </main>
    <script src="{{ asset('js/chat.js') }}"></script>
@endsection