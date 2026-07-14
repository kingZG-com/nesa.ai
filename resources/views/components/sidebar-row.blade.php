{{--
    Partial: components/sidebar-row.blade.php
    Props: $chat, $isActive (bool), $isPinned (bool), $loopIndex (int|null)
--}}

<div class="relative w-full group/row sidebar-item-wrapper"
     id="sidebar-row-{{ $chat->id }}"
     data-pinned="{{ $isPinned ? '1' : '0' }}"
     data-order="{{ $loopIndex ?? 0 }}">

    {{-- ── Tombol utama buka chat ── --}}
    <button onclick="document.getElementById('mobile-hamburger')?.classList.add('hidden'); window.loadSpecificChat('{{ $chat->id }}'); if(window.innerWidth < 768) closeSidebar();"
            id="sidebar-chat-{{ $chat->id }}"
            class="w-full text-left pl-3 pr-10 py-2 text-sm rounded-lg cursor-pointer truncate transition-colors flex items-center gap-2 sidebar-chat-btn
                {{ $isActive ? 'bg-cyan-100 text-cyan-800 font-semibold' : 'text-slate-700 hover:bg-slate-200/50' }}">

        <svg class="w-4 h-4 shrink-0 {{ $isActive ? 'text-cyan-600' : 'text-slate-400' }}"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
            </path>
        </svg>

        <span class="sidebar-chat-title truncate sidebar-text">{{ $chat->title }}</span>
    </button>

    {{-- ── Area aksi di pojok kanan ── --}}
    <div class="row-action-area absolute right-1 top-1/2 -translate-y-1/2 flex items-center z-30 sidebar-text">

        {{-- Pin badge — tampil saat sudah di-pin, sembunyi saat hover --}}
        <span class="btn-pin-badge {{ $isPinned ? '' : 'hidden' }} group-hover/row:hidden
                     w-6 h-6 flex items-center justify-center text-cyan-400 pointer-events-none">
            <i class="fas fa-thumbtack text-[10px]"></i>
        </span>

        {{-- Titik tiga — muncul saat hover --}}
        <button onclick="event.stopPropagation(); window.openChatDropdown(event, '{{ $chat->id }}')"
            class="btn-dots w-6 h-6 rounded-md flex items-center justify-center
                   text-slate-400 hover:text-slate-700 hover:bg-slate-300/40
                   transition-colors focus:outline-none cursor-pointer
                   opacity-0 group-hover/row:opacity-100 transition-opacity">
            <i class="fas fa-ellipsis-v text-xs"></i>
        </button>

    </div>
</div>