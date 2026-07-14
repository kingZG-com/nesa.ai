/**
 * Nesa - Gabungan seluruh JavaScript
 * Simpan sebagai file terpisah, lalu sertakan di layout utama.
 */

// ==========================================
// AUTO-GROW TEXTAREA + INIT
// ==========================================
document.addEventListener("DOMContentLoaded", () => {
    // Auto-grow textarea
    ["main-prompt", "chat-prompt"].forEach((id) => {
        const ta = document.getElementById(id);
        if (!ta) return;
        ta.addEventListener("input", function () {
            this.style.height = "auto";
            this.style.height = Math.min(this.scrollHeight, 160) + "px";
        });
    });
});

// ==========================================
// SIDEBAR MOBILE FUNCTIONS
// ==========================================
window.openSidebar = function () {
    const sidebar = document.getElementById("sidebar");
    const backdrop = document.getElementById("sidebar-backdrop");
    const burger = document.getElementById("mobile-hamburger");

    sidebar.classList.add("expanded");
    sidebar.classList.remove("-translate-x-full");
    sidebar.classList.add("translate-x-0");

    if (window.innerWidth < 768) {
        sidebar.style.width = "280px";
    }

    backdrop.classList.remove("hidden");
    burger.classList.add("hidden");
};

window.closeSidebar = function () {
    const sidebar = document.getElementById("sidebar");
    const backdrop = document.getElementById("sidebar-backdrop");
    const burger = document.getElementById("mobile-hamburger");

    sidebar.classList.remove("translate-x-0", "expanded");
    sidebar.classList.add("-translate-x-full");
    sidebar.style.width = "";
    backdrop.classList.add("hidden");

    // Hamburger hanya muncul kalau tidak sedang di chat
    const sedangDiChat =
        typeof currentChatId !== "undefined" && currentChatId !== null;
    if (window.innerWidth < 768 && !sedangDiChat) {
        burger.classList.remove("hidden");
    } else {
        burger.classList.add("hidden");
    }
};

document.addEventListener("DOMContentLoaded", () => {
    const _orig = window.toggleSidebar;
    window.toggleSidebar = function () {
        if (window.innerWidth < 768) {
            closeSidebar();
        } else if (_orig) {
            _orig();
        }
    };
});

window.addEventListener("resize", () => {
    const sidebar = document.getElementById("sidebar");
    const backdrop = document.getElementById("sidebar-backdrop");
    const burger = document.getElementById("mobile-hamburger");
    const chatView = document.getElementById("chat-view");
    const isChatActive = chatView && !chatView.classList.contains("hidden");

    if (window.innerWidth >= 768) {
        sidebar.classList.remove(
            "-translate-x-full",
            "translate-x-0",
            "expanded",
        );
        sidebar.style.width = "";
        backdrop.classList.add("hidden");
        burger.classList.add("hidden");
    } else {
        if (backdrop.classList.contains("hidden") && !isChatActive) {
            burger.classList.remove("hidden");
        } else {
            burger.classList.add("hidden");
        }
    }
});

if (typeof currentChatId === "undefined") {
    var currentChatId = null;
}

// ─────────────────────────────────────────────────────────────
// HELPER: Sinkronkan currentChatId + update data-chat-id
// Dipanggil setiap kali currentChatId berubah.
// ─────────────────────────────────────────────────────────────
function setCurrentChatId(id) {
    currentChatId = id;
    const chatView = document.getElementById("chat-view");
    if (chatView) {
        chatView.dataset.chatId = id ?? "";
    }
}

// 🔥 Variabel global koneksi Reverb
let currentEchoChannel = null;

let activeMode = "smart";
const placeholders = {
    smart: "Mencari jasa MUA wisuda yang terjangkau di Sekaran, beserta layanan laundry jas...",
    laundry:
        "Layanan laundry jas terdekat di Banaran dengan estimasi selesai 3 jam...",
    mua: "Jasa MUA untuk wisuda besok pagi di Patemon dengan anggaran Rp200.000...",
};

// ==========================================
// ⚡ LISTENER LARAVEL REVERB
// ==========================================
window.subscribeToChatChannel = (chatId) => {
    if (!chatId || !window.Echo) return;

    if (currentEchoChannel) {
        window.Echo.leave(currentEchoChannel);
    }

    currentEchoChannel = `chat.${chatId}`;
    console.log(`📡 Menghubungkan ke pipa Reverb: ${currentEchoChannel}`);

    window.Echo.channel(currentEchoChannel).listen(".AIReplied", (data) => {
        console.log("🔥 Semburan Reverb Masuk:", data);

        const chatBox = document.getElementById("chat-messages");
        if (!chatBox) return;

        const loadingElements = chatBox.querySelectorAll('[id^="load-"]');
        loadingElements.forEach((el) => el.remove());

        chatBox.insertAdjacentHTML(
            "beforeend",
            `
                <div class="flex justify-start w-full animate-fade-in-up">
                    <div class="bg-indigo-50 border border-indigo-200 text-indigo-900 p-4 rounded-2xl max-w-[85%] shadow-sm text-sm relative">
                        <span class="absolute -top-2.5 -right-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-[9px] font-extrabold px-2.5 py-0.5 rounded-full animate-pulse shadow-md border border-white">⚡ Live Reverb</span>
                        ${parseMarkdown(data.message)}
                    </div>
                </div>
                `,
        );

        setTimeout(() => {
            chatBox.scrollTop = chatBox.scrollHeight;
        }, 50);
    });
};

// ==========================================
// 🛠️ FUNGSI GLOBAL SIDEBAR & NAVIGATION
// ==========================================
window.toggleSidebar = () => {
    const sidebar = document.getElementById("sidebar");
    if (!sidebar) return;

    sidebar.classList.toggle("expanded");
    const tooltip = sidebar.querySelector(
        ".group\\/item:first-child .custom-tooltip",
    );
};

window.backToLanding = () => {
    const landing = document.getElementById("landing-view");
    const chatView = document.getElementById("chat-view");
    const navbar = document.getElementById("main-navbar");
    const theDrop = document.querySelector(".theDrop");

    if (window.innerWidth < 768) {
        const burger = document.getElementById("mobile-hamburger");
        if (burger) burger.classList.remove("hidden");
    }

    setCurrentChatId(null);

    if (currentEchoChannel && window.Echo) {
        window.Echo.leave(currentEchoChannel);
        currentEchoChannel = null;
    }

    window.history.pushState({}, "", "/app");

    if (theDrop) theDrop.classList.add("hidden");

    if (chatView) {
        chatView.classList.add(
            "opacity-0",
            "scale-98",
            "transition-all",
            "duration-200",
        );

        setTimeout(() => {
            chatView.classList.add("hidden");
            chatView.classList.remove(
                "opacity-0",
                "scale-98",
                "transition-all",
                "duration-200",
            );

            if (navbar) navbar.classList.remove("hidden");

            if (landing) {
                landing.classList.remove("hidden");
                landing.classList.add(
                    "flex-1",
                    "flex",
                    "flex-col",
                    "items-center",
                    "justify-center",
                    "w-full",
                    "min-h-full",
                );

                const headingContainer =
                    landing.querySelector(".text-center") ||
                    landing.querySelector(".mb-10");
                if (headingContainer)
                    headingContainer.classList.remove("hidden");

                landing.classList.add("animate-fade-in-up");
                setTimeout(
                    () => landing.classList.remove("animate-fade-in-up"),
                    400,
                );
            }
        }, 200);
    } else {
        if (navbar) navbar.classList.remove("hidden");
        if (landing) {
            landing.classList.remove("hidden");
            landing.classList.add(
                "flex-1",
                "flex",
                "flex-col",
                "items-center",
                "justify-center",
                "w-full",
                "min-h-full",
            );

            const headingContainer =
                landing.querySelector(".text-center") ||
                landing.querySelector(".mb-10");
            if (headingContainer) headingContainer.classList.remove("hidden");
        }
    }

    const mainPrompt = document.getElementById("main-prompt");
    if (mainPrompt) {
        mainPrompt.value = "";
        mainPrompt.style.height = "auto";
    }

    const chatPromptInternal = document.getElementById("chat-prompt");
    if (chatPromptInternal) chatPromptInternal.value = "";

    const chatMessages = document.getElementById("chat-messages");
    if (chatMessages) chatMessages.innerHTML = "";

    const chatTitle = document.getElementById("chat-title");
    if (chatTitle) chatTitle.textContent = "";

    const scrollableContent = document.getElementById("scrollable-content");
    if (scrollableContent) scrollableContent.scrollTop = 0;

    document.querySelectorAll(".sidebar-chat-btn").forEach((btn) => {
        btn.classList.remove("bg-cyan-100", "text-cyan-800", "font-semibold");
        btn.classList.add("text-slate-700", "hover:bg-slate-200/50");
        const svg = btn.querySelector("svg");
        if (svg) svg.classList.replace("text-cyan-600", "text-slate-400");
    });
};

window.switchToChatView = () => {
    const landing = document.getElementById("landing-view");
    const chatView = document.getElementById("chat-view");
    const navbar = document.getElementById("main-navbar");
    const burger = document.getElementById("mobile-hamburger"); // ← tambah
    if (burger) burger.classList.add("hidden"); // ← tambah
    if (navbar) navbar.classList.add("hidden");

    if (landing) {
        landing.classList.add("hidden");
        landing.classList.remove(
            "flex-1",
            "justify-center",
            "min-h-full",
            "pb-20",
        );
        const headingContainer =
            landing.querySelector(".text-center") ||
            landing.querySelector(".mb-10.text-center") ||
            landing.querySelector(".mb-10");
        if (headingContainer) headingContainer.classList.add("hidden");
    }

    if (chatView) {
        chatView.classList.remove("hidden");
        const theDrop = document.querySelector(".theDrop");
        if (theDrop) theDrop.classList.remove("hidden");
    } else {
        console.error("Elemen dengan ID 'chat-view' tidak ditemukan!");
    }
};

// ==========================================
// 🔮 DROP DOWN & MODE SELECTOR MANAGEMENT
// ==========================================
window.toggleDropdown = (e, dropdownId) => {
    if (e) e.stopPropagation();
    const dropdown = document.getElementById(dropdownId);
    if (dropdown) dropdown.classList.toggle("hidden");
};

window.selectMode = (mode) => {
    activeMode = mode;
    const configs = {
        smart: { icon: "🔮", text: "Mode Pintar" },
        laundry: { icon: "🧺", text: "Mode Laundry" },
        mua: { icon: "✨", text: "Mode MUA" },
    };

    const iconEl = document.getElementById("mode-icon");
    const textEl = document.getElementById("mode-text");
    const promptEl = document.getElementById("main-prompt");

    if (iconEl) iconEl.textContent = configs[mode].icon;
    if (textEl) textEl.textContent = configs[mode].text;
    if (promptEl) promptEl.placeholder = placeholders[mode];
};

// ==========================================
// ╔══════════════════════════════════════╗
// ║  SIDEBAR DROPDOWN — CORE LOGIC       ║
// ╚══════════════════════════════════════╝
// ==========================================

window.openChatDropdown = (event, chatId) => {
    const dropdown = document.getElementById("sidebar-action-dropdown");
    if (!dropdown) return;

    dropdown.classList.add("hidden");
    dropdown.dataset.chatId = chatId;

    // ── Sinkronkan state pin dari row ke dropdown ──
    const row = document.getElementById(`sidebar-row-${chatId}`);
    const isPinned = row?.dataset.pinned === "1";

    const pinBtn = dropdown.querySelector(".dropdown-pin-btn");
    const pinIcon = dropdown.querySelector(".dropdown-pin-icon");
    const pinText = dropdown.querySelector(".dropdown-pin-text");

    if (pinBtn) pinBtn.dataset.pinned = isPinned ? "1" : "0";
    if (pinText) pinText.textContent = isPinned ? "Lepaskan" : "Sematkan";
    if (pinIcon) {
        pinIcon.className = isPinned
            ? "fas fa-thumbtack dropdown-pin-icon text-cyan-500 w-3.5 text-center"
            : "fas fa-thumbtack dropdown-pin-icon text-slate-400 w-3.5 text-center rotate-45 opacity-60";
    }

    const btn = event.currentTarget;
    const rect = btn.getBoundingClientRect();
    const dropW = 192;
    let left = rect.right - dropW;
    let top = rect.bottom + 6;

    if (left < 8) left = 8;
    if (top + 160 > window.innerHeight) top = rect.top - 160 - 6;

    dropdown.style.left = left + "px";
    dropdown.style.top = top + "px";
    dropdown.classList.remove("hidden");
};

function closeChatDropdown() {
    const dropdown = document.getElementById("sidebar-action-dropdown");
    if (dropdown) dropdown.classList.add("hidden");
}

window.handleSidebarAction = (action) => {
    const dropdown = document.getElementById("sidebar-action-dropdown");
    if (!dropdown) return;

    const chatId = dropdown.dataset.chatId;
    closeChatDropdown();

    if (!chatId) return;

    switch (action) {
        case "pin":
            window.pinChat(chatId);
            break;
        case "rename":
            window.renameChat(chatId);
            break;
        case "delete":
            window.deleteChat(chatId);
            break;
    }
};

// Tutup dropdown kalau klik di luar
document.addEventListener("click", (e) => {
    const dropdown = document.getElementById("sidebar-action-dropdown");
    const renameBox = document.getElementById("sidebar-rename-inline");

    if (dropdown && !dropdown.classList.contains("hidden")) {
        if (!dropdown.contains(e.target)) {
            closeChatDropdown();
        }
    }

    if (renameBox && !renameBox.classList.contains("hidden")) {
        if (!renameBox.contains(e.target)) {
            window.cancelRename();
        }
    }

    const accountModal = document.getElementById("account-popup-modal");
    const triggerBtn = document.getElementById("account-btn-trigger");
    const modeDropdown = document.getElementById("mode-dropdown");
    const navbarDropdown = document.getElementById("navbar-chat-dropdown");
    const optionsDropdown = document.getElementById("chat-options-dropdown");

    if (
        modeDropdown &&
        !modeDropdown.classList.contains("hidden") &&
        e.target.id !== "mode-btn-trigger"
    ) {
        modeDropdown.classList.add("hidden");
    }
    if (navbarDropdown && !navbarDropdown.classList.contains("hidden")) {
        navbarDropdown.classList.add("hidden");
    }
    if (optionsDropdown && !optionsDropdown.classList.contains("hidden")) {
        optionsDropdown.classList.add("hidden");
    }
    if (accountModal && !accountModal.classList.contains("hidden")) {
        if (
            !accountModal.contains(e.target) &&
            (!triggerBtn || !triggerBtn.contains(e.target))
        ) {
            accountModal.classList.add("hidden");
        }
    }
});

// ──────────────────────────────────────────
// 🗑️ HAPUS CHAT (AJAX DELETE)
// ──────────────────────────────────────────
window.deleteChat = async (chatId) => {
    if (!chatId || chatId === "null" || chatId === "undefined") {
        showToast("⚠️ Tidak ada percakapan yang dipilih.", "error");
        return;
    }

    const confirmed = await showConfirm(
        "Hapus Percakapan",
        "Percakapan ini akan dihapus permanen dan tidak dapat dikembalikan.",
        "Hapus",
        "Batal",
    );
    if (!confirmed) return;

    try {
        const response = await fetch(`/app/chat/${chatId}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
            },
        });

        const data = await response.json();

        if (response.ok && (data.success || data.status === "success")) {
            const row = document.getElementById(`sidebar-row-${chatId}`);
            if (row) {
                row.style.transition = "opacity 0.2s, transform 0.2s";
                row.style.opacity = "0";
                row.style.transform = "translateX(-10px)";
                setTimeout(() => row.remove(), 220);
            }

            // Hapus juga dari search modal
            const searchCard = document.querySelector(
                `[onclick*="loadSpecificChatFromSearch('${chatId}')"]`,
            );
            if (searchCard) {
                searchCard.style.transition = "opacity 0.2s";
                searchCard.style.opacity = "0";
                setTimeout(() => searchCard.remove(), 220);
            }

            if (String(currentChatId) === String(chatId)) {
                window.backToLanding();
            }

            setTimeout(() => {
                const pinnedList = document.getElementById(
                    "sidebar-pinned-list",
                );
                const regularList = document.getElementById(
                    "sidebar-regular-list",
                );

                const totalRows =
                    (pinnedList
                        ? pinnedList.querySelectorAll(".sidebar-item-wrapper")
                              .length
                        : 0) +
                    (regularList
                        ? regularList.querySelectorAll(".sidebar-item-wrapper")
                              .length
                        : 0);

                if (totalRows === 0) {
                    const empty = `
            <div id="sidebar-empty-state"
                class="text-xs text-slate-400 italic px-3 py-2 flex items-center justify-center gap-2 w-full text-center">
                <svg class="w-4 h-4 text-slate-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Belum ada aktivitas obrolan.
            </div>`;
                    regularList?.insertAdjacentHTML("afterbegin", empty);
                }
            }, 300);

            showToast("✅ Percakapan berhasil dihapus.");
        } else {
            showToast(
                "❌ Gagal menghapus: " + (data.message || "Terjadi kesalahan."),
                "error",
            );
        }
    } catch (err) {
        console.error("Delete error:", err);
        showToast("❌ Gagal menghapus percakapan.", "error");
    }
};

// ──────────────────────────────────────────
// ✏️ RENAME CHAT
// ──────────────────────────────────────────
let _renameChatId = null;

// ─── Buka modal rename dengan ID yang eksplisit ───
window.renameChat = (chatId) => {
    if (!chatId || chatId === "null" || chatId === "undefined") {
        showToast("⚠️ Tidak ada percakapan yang dipilih.", "error");
        return;
    }

    _renameChatId = String(chatId);

    // Ambil judul saat ini: coba dari sidebar dulu, fallback ke navbar title
    const btn = document.getElementById(`sidebar-chat-${_renameChatId}`);
    const titleSpan = btn ? btn.querySelector(".sidebar-chat-title") : null;
    const navbarTitle = document.getElementById("chat-title");
    const currentTitle =
        (titleSpan ? titleSpan.textContent.trim() : "") ||
        (navbarTitle ? navbarTitle.textContent.trim() : "");

    const modal = document.getElementById("rename-modal");
    const input = document.getElementById("rename-modal-input");

    if (!modal || !input) return;

    input.value = currentTitle;
    modal.classList.remove("hidden");

    setTimeout(() => {
        input.focus();
        input.select();
    }, 100);
};

// ─── Tutup modal ───
window.closeRenameModal = () => {
    const modal = document.getElementById("rename-modal");
    if (modal) modal.classList.add("hidden");
    _renameChatId = null;
};

// ─── Simpan perubahan nama ───
window.confirmRenameModal = async () => {
    const input = document.getElementById("rename-modal-input");
    if (!input || !_renameChatId) return;

    const newTitle = input.value.trim();
    if (!newTitle) {
        showToast("⚠️ Judul tidak boleh kosong.", "error");
        return;
    }

    const idToRename = _renameChatId;
    window.closeRenameModal();

    try {
        const response = await fetch(`/app/chat/${idToRename}`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
            },
            body: JSON.stringify({ title: newTitle }),
        });

        const data = await response.json();

        if (response.ok && (data.success || data.status === "success")) {
            // Update judul di sidebar
            const sidebarBtn = document.getElementById(
                `sidebar-chat-${idToRename}`,
            );
            const sidebarTitleSpan = sidebarBtn
                ? sidebarBtn.querySelector(".sidebar-chat-title")
                : null;
            if (sidebarTitleSpan) sidebarTitleSpan.textContent = newTitle;

            // Update judul di navbar header (jika ini chat yang aktif)
            if (String(currentChatId) === String(idToRename)) {
                const chatTitle = document.getElementById("chat-title");
                if (chatTitle) chatTitle.textContent = newTitle;
            }

            // Update di modal search
            const searchCard = document.querySelector(
                `[onclick*="loadSpecificChatFromSearch('${idToRename}')"] .search-item-title`,
            );
            if (searchCard) {
                searchCard.textContent = newTitle;
                searchCard
                    .closest("[data-title]")
                    ?.setAttribute("data-title", newTitle.toLowerCase());
            }

            showToast("✅ Nama percakapan berhasil diubah.");
        } else {
            showToast(
                "❌ Gagal mengubah nama: " +
                    (data.message || "Terjadi kesalahan."),
                "error",
            );
        }
    } catch (err) {
        console.error("Rename error:", err);
        showToast("❌ Gagal mengubah nama percakapan.", "error");
    }
};

// ─── Keyboard handler modal rename ───
document.addEventListener("DOMContentLoaded", () => {
    const renameInput = document.getElementById("rename-modal-input");
    if (renameInput) {
        renameInput.addEventListener("keydown", (e) => {
            if (e.key === "Enter") {
                e.preventDefault();
                window.confirmRenameModal();
            }
            if (e.key === "Escape") {
                e.preventDefault();
                window.closeRenameModal();
            }
        });
    }
});

// ─── Inline rename (sidebar) — tetap dipertahankan untuk kompatibilitas ───
window.confirmRename = async () => {
    const renameInput = document.getElementById("sidebar-rename-input");
    const renameBox = document.getElementById("sidebar-rename-inline");
    if (!renameInput || !_renameChatId) return;

    const newTitle = renameInput.value.trim();
    if (!newTitle) {
        showToast("⚠️ Judul tidak boleh kosong.", "error");
        return;
    }

    renameBox.classList.add("hidden");

    const idToRename = _renameChatId;
    _renameChatId = null;

    try {
        const response = await fetch(`/app/chat/${idToRename}`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
            },
            body: JSON.stringify({ title: newTitle }),
        });

        const data = await response.json();

        if (response.ok && (data.success || data.status === "success")) {
            const btn = document.getElementById(`sidebar-chat-${idToRename}`);
            const titleSpan = btn
                ? btn.querySelector(".sidebar-chat-title")
                : null;
            if (titleSpan) titleSpan.textContent = newTitle;

            if (String(currentChatId) === String(idToRename)) {
                const chatTitle = document.getElementById("chat-title");
                if (chatTitle) chatTitle.textContent = newTitle;
            }

            const searchCard = document.querySelector(
                `[onclick*="loadSpecificChatFromSearch('${idToRename}')"] .search-item-title`,
            );
            if (searchCard) {
                searchCard.textContent = newTitle;
                searchCard
                    .closest("[data-title]")
                    ?.setAttribute("data-title", newTitle.toLowerCase());
            }

            showToast("✅ Nama percakapan berhasil diubah.");
        } else {
            showToast(
                "❌ Gagal mengubah nama: " +
                    (data.message || "Terjadi kesalahan."),
                "error",
            );
        }
    } catch (err) {
        console.error("Rename error:", err);
        showToast("❌ Gagal mengubah nama percakapan.", "error");
    }
};

window.cancelRename = () => {
    const renameBox = document.getElementById("sidebar-rename-inline");
    if (renameBox) renameBox.classList.add("hidden");
    _renameChatId = null;
};

document.addEventListener("DOMContentLoaded", () => {
    const renameInput = document.getElementById("sidebar-rename-input");
    if (renameInput) {
        renameInput.addEventListener("keydown", (e) => {
            if (e.key === "Enter") {
                e.preventDefault();
                window.confirmRename();
            }
            if (e.key === "Escape") {
                e.preventDefault();
                window.cancelRename();
            }
        });
    }
});

// ──────────────────────────────────────────
// 📌 PIN CHAT (AJAX PATCH)
// ──────────────────────────────────────────
window.pinChat = async (chatId) => {
    if (!chatId || chatId === "null" || chatId === "undefined") {
        showToast("⚠️ Tidak ada percakapan yang dipilih.", "error");
        return;
    }

    try {
        const response = await fetch(`/app/chat/${chatId}/pin`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
            },
        });

        const data = await response.json();

        if (response.ok && (data.success || data.status === "success")) {
            const isPinned = data.pinned ?? true;
            showToast(
                isPinned
                    ? "📌 Percakapan berhasil disematkan."
                    : "📌 Sematan percakapan dilepas.",
            );

            _applySidebarPinState(chatId, isPinned);
        } else {
            showToast(
                "❌ Gagal menyematkan: " +
                    (data.message || "Terjadi kesalahan."),
                "error",
            );
        }
    } catch (err) {
        console.error("Pin error:", err);
        showToast("❌ Gagal menyematkan percakapan.", "error");
    }
};

// ==========================================
// 📌 HELPER: TERAPKAN STATE PIN KE SIDEBAR DOM
// ==========================================
function _applySidebarPinState(chatId, isPinned) {
    const row = document.getElementById(`sidebar-row-${chatId}`);
    if (!row) return;

    // ── 1. Tandai row dengan data-pinned ──
    row.dataset.pinned = isPinned ? "1" : "0";

    // ── 2. Update ikon aksi di pojok kanan row ──
    const actionArea = row.querySelector(".row-action-area");
    if (actionArea) {
        const dotsBtn = actionArea.querySelector(".btn-dots");
        const pinBadge = actionArea.querySelector(".btn-pin-badge");
        if (isPinned) {
            if (dotsBtn) dotsBtn.dataset.pinnedHide = "1";
            if (pinBadge) pinBadge.classList.remove("hidden");
        } else {
            if (dotsBtn) delete dotsBtn.dataset.pinnedHide;
            if (pinBadge) pinBadge.classList.add("hidden");
        }
    }

    // ── 3. Update label + ikon di dropdown floating ──
    const dropdown = document.getElementById("sidebar-action-dropdown");
    if (dropdown && dropdown.dataset.chatId === String(chatId)) {
        const pinBtn = dropdown.querySelector(".dropdown-pin-btn");
        const pinIcon = dropdown.querySelector(".dropdown-pin-icon");
        const pinText = dropdown.querySelector(".dropdown-pin-text");
        if (pinBtn) pinBtn.dataset.pinned = isPinned ? "1" : "0";
        if (pinIcon) {
            pinIcon.className = isPinned
                ? "fas fa-thumbtack dropdown-pin-icon text-cyan-500 w-3.5 text-center"
                : "fas fa-thumbtack dropdown-pin-icon text-slate-400 w-3.5 text-center rotate-45 opacity-60";
        }
        if (pinText) pinText.textContent = isPinned ? "Lepaskan" : "Sematkan";
    }

    // ── 4. Pindahkan row ke list yang tepat ──
    const pinnedList = document.getElementById("sidebar-pinned-list");
    const regularList = document.getElementById("sidebar-regular-list");

    if (isPinned && pinnedList) {
        pinnedList.prepend(row);
        row.classList.add("animate-fade-in-up");
        setTimeout(() => row.classList.remove("animate-fade-in-up"), 400);
    } else if (!isPinned && regularList) {
        // Kembalikan ke posisi asalnya berdasarkan data-order
        const targetOrder = parseInt(row.dataset.order ?? "0", 10);
        const siblings = Array.from(
            regularList.querySelectorAll(".sidebar-item-wrapper"),
        );
        const insertBefore = siblings.find(
            (el) => parseInt(el.dataset.order ?? "0", 10) > targetOrder,
        );

        if (insertBefore) {
            regularList.insertBefore(row, insertBefore);
        } else {
            regularList.appendChild(row);
        }

        row.classList.add("animate-fade-in-up");
        setTimeout(() => row.classList.remove("animate-fade-in-up"), 400);
    }
}

// ==========================================
// 🔔 TOAST NOTIFICATION
// ==========================================
function showToast(message, type = "success") {
    const existing = document.getElementById("nesa-toast");
    if (existing) existing.remove();

    const bg = type === "error" ? "bg-red-600" : "bg-slate-800";
    const toast = document.createElement("div");
    toast.id = "nesa-toast";
    toast.className = `fixed bottom-6 left-1/2 -translate-x-1/2 z-[99999] px-4 py-2.5 rounded-xl ${bg} text-white text-xs font-semibold shadow-xl transition-all duration-300 opacity-0 translate-y-2`;
    toast.textContent = message;
    document.body.appendChild(toast);

    requestAnimationFrame(() => {
        toast.style.opacity = "1";
        toast.style.transform = "translateX(-50%) translateY(0)";
    });

    setTimeout(() => {
        toast.style.opacity = "0";
        toast.style.transform = "translateX(-50%) translateY(8px)";
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// ==========================================
// 💬 KONFIRMASI DIALOG
// ==========================================
function showConfirm(title, message, confirmText = "Ya", cancelText = "Batal") {
    return new Promise((resolve) => {
        const overlay = document.createElement("div");
        overlay.className =
            "fixed inset-0 z-[99998] flex items-center justify-center bg-black/40 backdrop-blur-[2px] animate-fade-in";

        overlay.innerHTML = `
            <div class="bg-white rounded-2xl shadow-2xl border border-slate-100 p-6 max-w-sm w-full mx-4 flex flex-col gap-4 animate-fade-in-up">
                <div class="flex flex-col gap-1.5">
                    <h3 class="text-sm font-bold text-slate-800">${escapeHtml(title)}</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">${escapeHtml(message)}</p>
                </div>
                <div class="flex gap-2 justify-end">
                    <button id="confirm-cancel-btn"
                        class="px-4 py-2 text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors cursor-pointer">
                        ${escapeHtml(cancelText)}
                    </button>
                    <button id="confirm-ok-btn"
                        class="px-4 py-2 text-xs font-bold text-white bg-red-500 hover:bg-red-600 rounded-xl transition-colors cursor-pointer">
                        ${escapeHtml(confirmText)}
                    </button>
                </div>
            </div>
        `;

        document.body.appendChild(overlay);

        overlay
            .querySelector("#confirm-ok-btn")
            .addEventListener("click", () => {
                overlay.remove();
                resolve(true);
            });

        overlay
            .querySelector("#confirm-cancel-btn")
            .addEventListener("click", () => {
                overlay.remove();
                resolve(false);
            });

        overlay.addEventListener("click", (e) => {
            if (e.target === overlay) {
                overlay.remove();
                resolve(false);
            }
        });
    });
}

// ==========================================
// 🧺 DUMMY CARDS RENDERER (GUEST LANDING)
// ==========================================
window.renderCards = (filterType = "all") => {
    const container = document.getElementById("picks-container");
    if (!container) return;
    container.innerHTML = "";
    const filtered =
        filterType === "all" || filterType === "smart"
            ? dummyData
            : dummyData.filter((i) => i.type === filterType);
    filtered
        .slice(0, 3)
        .forEach((item) =>
            container.insertAdjacentHTML("beforeend", createCardHTML(item)),
        );
};

function createCardHTML(item) {
    const isMUA = item.type === "mua";
    const badgeColor = isMUA
        ? "bg-purple-100 text-purple-700"
        : "bg-cyan-100 text-cyan-700";
    return `
        <div class="group bg-white rounded-2xl border border-slate-100 p-4 shadow-sm hover:shadow-md transition-all cursor-pointer flex flex-col h-full text-left">
            <div class="flex justify-between items-start mb-3">
                <div class="text-xl">${isMUA ? "✨" : "🧺"}</div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase ${badgeColor}">${item.badge}</span>
            </div>
            <h3 class="text-base font-bold text-slate-800 mb-1">${item.name}</h3>
            <p class="text-xs font-medium text-slate-500 mb-2">${item.specialty}</p>
            <div class="flex justify-between items-center mt-auto pt-3 border-t border-slate-50">
                <span class="text-xs text-slate-400"><i class="fas fa-map-marker-alt"></i> ${item.location}</span>
                <span class="font-bold text-slate-800 text-sm">${item.price}</span>
            </div>
        </div>`;
}

function parseMarkdown(text) {
    if (text.includes('<div class="nesa-cards">')) {
        // Jangan escape HTML-nya, biarkan utuh.
        // Opsional: replace \n jadi <br> untuk teks pengantarnya,
        // tapi hati-hati jangan sampai merusak struktur <div class="nesa-cards">
        return text;
    }

    // Flow normal untuk teks biasa
    const escaped = text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;");

    return escaped
        .replace(/\*\*(.+?)\*\*/g, "<strong>$1</strong>")
        .replace(/\*(.+?)\*/g, "<em>$1</em>")
        .replace(/~~(.+?)~~/g, "<del>$1</del>")
        .replace(/`(.+?)`/g, "<code>$1</code>")
        .replace(/\n/g, "<br>");
}

function escapeHtml(text) {
    const div = document.createElement("div");
    div.textContent = text;
    return div.innerHTML;
}

// ==========================================
// ⌨️ SMART TYPING EFFECT (TEXT + CARD FADE-IN)
// ==========================================
async function typeNode(node, container, speed = 15) {
    if (node.nodeType === Node.TEXT_NODE) {
        // Kalau ini teks, kita ketik huruf per huruf
        let text = node.nodeValue;
        for (let i = 0; i < text.length; i++) {
            container.appendChild(document.createTextNode(text[i]));
            await new Promise((r) => setTimeout(r, speed));

            // Auto scroll ke bawah tiap ngetik
            const chatBox = document.getElementById("chat-messages");
            if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
        }
    } else if (node.nodeType === Node.ELEMENT_NODE) {
        // Bikin elemen HTML yang sesuai
        let el = document.createElement(node.tagName);
        Array.from(node.attributes).forEach((attr) =>
            el.setAttribute(attr.name, attr.value),
        );
        container.appendChild(el);

        // LOGIKA CERDAS: Kalau ini Card MUA/Laundry, JANGAN diketik.
        // Langsung masukin utuh dan kasih efek animasi muncul (Fade-in).
        if (
            el.classList &&
            (el.classList.contains("nesa-card") ||
                el.classList.contains("nesa-cards"))
        ) {
            el.innerHTML = node.innerHTML; // Langsung isi card-nya

            // Set style awal untuk animasi
            el.style.opacity = "0";
            el.style.transform = "translateY(15px)";
            el.style.transition =
                "opacity 0.5s ease-out, transform 0.5s ease-out";

            // Trigger animasi muncul
            setTimeout(() => {
                el.style.opacity = "1";
                el.style.transform = "translateY(0)";
                const chatBox = document.getElementById("chat-messages");
                if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
            }, 100);

            // Beri jeda dikit antar card biar munculnya gantian (Staggered)
            await new Promise((r) => setTimeout(r, 200));
        } else {
            // Kalau ini elemen biasa (seperti <p>, <strong>, dll), masuk ke dalamnya dan ketik isinya
            for (let child of node.childNodes) {
                await typeNode(child, el, speed);
            }
        }
    }
}

// Fungsi utama yang dipanggil untuk mengeksekusi efek
async function applyTypingEffect(targetContainer, htmlContent) {
    targetContainer.innerHTML = ""; // Bersihkan kontainer

    // Bikin elemen sementara buat nge-parse string HTML dari Gemini
    const tempDiv = document.createElement("div");
    tempDiv.innerHTML = htmlContent;

    // Mulai ngetik simulasinya
    for (let child of tempDiv.childNodes) {
        await typeNode(child, targetContainer, 5); // Kecepatan ngetik 10ms per huruf
    }
}

// ==========================================
// 🚀 SUBMIT PROMPT PERTAMA (LANDING)
// ==========================================
window.submitPrompt = async (e) => {
    if (e) e.preventDefault();
    const inputEl = document.getElementById("main-prompt");
    if (!inputEl) return;

    const text = inputEl.value.trim();
    if (!text) return;

    window.switchToChatView();

    const chatBox = document.getElementById("chat-messages");
    if (!chatBox) return;

    chatBox.insertAdjacentHTML(
        "beforeend",
        `
        <div class="flex justify-end w-full animate-fade-in-up">
            <div class="bg-purple-600 text-white px-5 py-3 rounded-2xl max-w-[85%] shadow-sm text-sm">
                ${escapeHtml(text)}
            </div>
        </div>
        `,
    );
    inputEl.value = "";

    const scrollToBottom = () => {
        setTimeout(() => {
            chatBox.scrollTop = chatBox.scrollHeight;
        }, 50);
    };

    scrollToBottom();

    const loadingId = "load-" + Date.now();
    chatBox.insertAdjacentHTML(
        "beforeend",
        `
        <div id="${loadingId}" class="flex justify-start w-full">
            <div class="bg-slate-100 text-slate-800 px-5 py-3 rounded-2xl">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 bg-purple-600 rounded-full animate-bounce"></div>
                    <div class="w-2 h-2 bg-purple-600 rounded-full animate-bounce delay-100"></div>
                    <div class="w-2 h-2 bg-purple-600 rounded-full animate-bounce delay-200"></div>
                    <span class="text-sm ml-2">Nesa sedang memproses permintaan...</span>
                </div>
            </div>
        </div>
        `,
    );

    scrollToBottom();

    try {
        const response = await fetch("/api/chat/prompt", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
            },
            body: JSON.stringify({
                prompt: text,
                chat_id: currentChatId,
                mode: typeof activeMode !== "undefined" ? activeMode : "smart",
            }),
        });

        const data = await response.json();

        if (response.status === 403 || data.status === "limit_reached") {
            document.getElementById(loadingId)?.remove();
            chatBox.insertAdjacentHTML(
                "beforeend",
                `
                <div class="flex justify-start w-full animate-fade-in-up">
                    <div class="bg-amber-50 border border-amber-200 text-amber-800 p-5 rounded-2xl max-w-[85%] shadow-sm flex flex-col gap-3.5 text-left select-none">
                        <div class="flex items-center gap-2.5">
                            <i class="fas fa-lock text-amber-600 text-base shrink-0"></i>
                            <strong class="text-sm font-bold tracking-wide text-amber-900">Batas Penggunaan Gratis Terlampaui</strong>
                        </div>
                        <div class="text-xs font-medium text-amber-800/90 leading-relaxed tracking-wide">
                            ${data.message}
                        </div>
                        <div class="pt-1">
                            <button onclick="window.openGoogleLoginModal()" 
                                class="group/btn inline-flex items-center justify-center gap-2 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-300 shadow-md hover:shadow-purple-500/20 cursor-pointer focus:outline-none">
                                <i class="fab fa-google text-sm transition-transform group-hover/btn:scale-110 shrink-0"></i>
                                <span>Autentikasi via Google</span>
                            </button>
                        </div>
                    </div>
                </div>
                `,
            );
            scrollToBottom();
            return;
        }

        if (data.status === "success" || data.success === true) {
            if (data.is_new_chat) {
                // 1. Setup Chat Baru
                setCurrentChatId(data.chat_id);
                window.subscribeToChatChannel(currentChatId);
                window.history.pushState(
                    { chatId: data.chat_id },
                    "",
                    `/app/${data.chat_id}`,
                );

                const chatTitle = document.getElementById("chat-title");
                if (chatTitle) chatTitle.textContent = data.chat_title;
                injectTitleToSidebar(data.chat_id, data.chat_title);
                injectTitleToSearchModal(data.chat_id, data.chat_title);

                // 2. Tampilkan Balasan AI dengan Typing Effect
                const aiReply = data.response || data.message;
                document.getElementById(loadingId)?.remove(); // Hapus loading!

                const bubbleId = "reply-" + Date.now();
                chatBox.insertAdjacentHTML(
                    "beforeend",
                    `
                    <div class="flex justify-start w-full animate-fade-in-up">
                        <div id="${bubbleId}" class="bg-slate-100 border border-slate-200 text-slate-800 p-4 rounded-2xl max-w-[85%] shadow-sm text-sm relative">
                        </div>
                    </div>
                    `,
                );

                const targetContainer = document.getElementById(bubbleId);
                const finalHTML = parseMarkdown(aiReply);
                applyTypingEffect(targetContainer, finalHTML);
                scrollToBottom();
            } else {
                // 1. Setup Lanjutan Chat (GAK PAKE SETTIMEOUT 3 DETIK!)
                document.getElementById(loadingId)?.remove(); // Langsung hapus loading!

                const aiReply = data.response || data.message;
                const bubbleId = "reply-" + Date.now();

                // 2. Siapkan wadah kosong
                chatBox.insertAdjacentHTML(
                    "beforeend",
                    `
                    <div class="flex justify-start w-full animate-fade-in-up">
                        <div id="${bubbleId}" class="bg-slate-100 border border-slate-200 text-slate-800 p-4 rounded-2xl max-w-[85%] shadow-sm text-sm relative">
                        </div>
                    </div>
                    `,
                );

                // 3. Langsung hajar efek ngetiknya!
                const targetContainer = document.getElementById(bubbleId);
                const finalHTML = parseMarkdown(aiReply);
                applyTypingEffect(targetContainer, finalHTML);
                scrollToBottom();
            }
        } else {
            throw new Error(
                data.message || "Gagal memproses respons dari server.",
            );
        }
    } catch (error) {
        // Handling kalau ada error API / Jaringan
        document.getElementById(loadingId)?.remove();
        console.error("Detail Kesalahan:", error);
        chatBox.insertAdjacentHTML(
            "beforeend",
            `
            <div class="flex justify-start w-full">
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl max-w-[85%] text-sm">
                    ⚠️ Mohon maaf, terjadi kesalahan: ${error.message}
                </div>
            </div>
            `,
        );
    }

    scrollToBottom();
};

// ─── UTILITY: SUNTIK SIDEBAR ───
function injectTitleToSidebar(chatId, chatTitle) {
    const sidebarContainer = document.getElementById("chat-history-sidebar");
    if (!sidebarContainer) return;

    const emptyState = document.getElementById("sidebar-empty-state");
    if (emptyState) emptyState.remove();

    document.querySelectorAll(".sidebar-chat-btn").forEach((btn) => {
        btn.classList.remove("bg-cyan-100", "text-cyan-800", "font-semibold");
        btn.classList.add("text-slate-700", "hover:bg-slate-200/50");
        const svg = btn.querySelector("svg");
        if (svg) svg.classList.replace("text-cyan-600", "text-slate-400");
    });

    const innerContainer = sidebarContainer.querySelector(
        ".space-y-0\\.5:last-of-type",
    );
    const target = innerContainer || sidebarContainer;

    target.insertAdjacentHTML(
        "afterbegin",
        `
        <div class="relative w-full group/row sidebar-item-wrapper animate-fade-in-up"
             id="sidebar-row-${chatId}"
             data-pinned="0">

            <button onclick="window.loadSpecificChat('${chatId}')"
                id="sidebar-chat-${chatId}"
                class="w-full text-left pl-3 pr-10 py-2 text-sm bg-cyan-100 text-cyan-800 font-semibold rounded-lg cursor-pointer truncate transition-colors flex items-center gap-2 sidebar-chat-btn">
                <svg class="w-4 h-4 text-cyan-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                    </path>
                </svg>
                <span class="sidebar-chat-title truncate sidebar-text">${escapeHtml(chatTitle)}</span>
            </button>

            <div class="row-action-area absolute right-1 top-1/2 -translate-y-1/2 flex items-center z-30 sidebar-text">
                <span class="btn-pin-badge hidden group-hover/row:hidden
                             w-6 h-6 flex items-center justify-center text-cyan-400 pointer-events-none">
                    <i class="fas fa-thumbtack text-[10px]"></i>
                </span>
                <button
                    onclick="event.stopPropagation(); window.openChatDropdown(event, '${chatId}')"
                    class="btn-dots w-6 h-6 rounded-md flex items-center justify-center
                           text-slate-400 hover:text-slate-700 hover:bg-slate-300/40
                           transition-colors focus:outline-none cursor-pointer
                           opacity-0 group-hover/row:opacity-100 transition-opacity">
                    <i class="fas fa-ellipsis-v text-xs"></i>
                </button>
            </div>
        </div>
        `,
    );
}

// ─── UTILITY: SUNTIK MODAL SEARCH ───
function injectTitleToSearchModal(chatId, chatTitle) {
    const searchContainer = document.getElementById("search-results-container");
    if (!searchContainer) return;

    const modalEmptyState = searchContainer.querySelector(".text-center");
    if (modalEmptyState) modalEmptyState.remove();

    searchContainer.insertAdjacentHTML(
        "afterbegin",
        `
        <div onclick="window.loadSpecificChatFromSearch('${chatId}')" data-title="${chatTitle.toLowerCase()}"
            class="search-item-card bg-white border border-slate-100 rounded-xl p-3.5 shadow-sm hover:shadow-[0_8px_20px_-6px_rgba(6,182,212,0.1)] hover:border-cyan-300/80 hover:bg-gradient-to-r hover:from-white hover:to-cyan-50/10 transition-all duration-200 cursor-pointer flex justify-between items-center group animate-fade-in-up">
            <div class="flex items-center gap-3.5 truncate">
                <div class="w-8 h-8 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center shrink-0 group-hover:bg-cyan-600 group-hover:text-white group-hover:shadow-[0_4px_12px_rgba(6,182,212,0.4)] transition-all duration-200">
                    <i class="fas fa-comment-alt text-xs"></i>
                </div>
                <span class="search-item-title text-xs font-bold text-slate-700 group-hover:text-slate-900 transition-colors duration-200 truncate">${escapeHtml(chatTitle)}</span>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <span class="text-[10px] text-slate-400 font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-200">Baru saja</span>
                <i class="fas fa-chevron-right text-slate-300 group-hover:text-cyan-600 group-hover:translate-x-0.5 transition-all duration-200 text-[10px] pr-1"></i>
            </div>
        </div>
        `,
    );
}

// ==========================================
// 💬 CHAT FOLLOW UP
// ==========================================
window.submitChatFollowUp = async () => {
    const inputEl = document.getElementById("chat-prompt");
    if (!inputEl) return;

    const text = inputEl.value.trim();
    if (!text) return;

    const chatBox = document.getElementById("chat-messages");
    if (!chatBox) return;

    chatBox.insertAdjacentHTML(
        "beforeend",
        `
        <div class="flex justify-end w-full animate-fade-in-up">
            <div class="bg-purple-600 text-white px-5 py-3 rounded-2xl max-w-[85%] shadow-sm text-sm">
                ${escapeHtml(text)}
            </div>
        </div>
        `,
    );

    inputEl.value = "";
    inputEl.focus();

    const scrollToBottom = () => {
        setTimeout(() => {
            chatBox.scrollTop = chatBox.scrollHeight;
        }, 50);
    };

    scrollToBottom();

    const loadingId = "load-" + Date.now();
    chatBox.insertAdjacentHTML(
        "beforeend",
        `
        <div id="${loadingId}" class="flex justify-start w-full">
            <div class="bg-slate-100 text-slate-800 px-5 py-3 rounded-2xl">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 bg-purple-600 rounded-full animate-bounce"></div>
                    <div class="w-2 h-2 bg-purple-600 rounded-full animate-bounce delay-100"></div>
                    <div class="w-2 h-2 bg-purple-600 rounded-full animate-bounce delay-200"></div>
                    <span class="text-sm ml-2">Nesa sedang memproses permintaan...</span>
                </div>
            </div>
        </div>
        `,
    );

    scrollToBottom();

    try {
        const response = await fetch("/api/chat/prompt", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
            },
            body: JSON.stringify({
                prompt: text,
                chat_id: currentChatId,
                mode: typeof activeMode !== "undefined" ? activeMode : "smart",
            }),
        });

        const data = await response.json();

        if (response.status === 403 || data.status === "limit_reached") {
            document.getElementById(loadingId)?.remove();
            chatBox.insertAdjacentHTML(
                "beforeend",
                `
                <div class="flex justify-start w-full animate-fade-in-up">
                    <div class="bg-amber-50 border border-amber-200 text-amber-800 p-5 rounded-2xl max-w-[85%] shadow-sm flex flex-col gap-3.5 text-left select-none">
                        <div class="flex items-center gap-2.5">
                            <i class="fas fa-lock text-amber-600 text-base shrink-0"></i>
                            <strong class="text-sm font-bold tracking-wide text-amber-900">Batas Penggunaan Gratis Terlampaui</strong>
                        </div>
                        <div class="text-xs font-medium text-amber-800/90 leading-relaxed tracking-wide">
                            ${data.message}
                        </div>
                        <div class="pt-1">
                            <button onclick="window.openGoogleLoginModal()" 
                                class="group/btn inline-flex items-center justify-center gap-2 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-300 shadow-md hover:shadow-purple-500/20 cursor-pointer focus:outline-none">
                                <i class="fab fa-google text-sm transition-transform group-hover/btn:scale-110 shrink-0"></i>
                                <span>Autentikasi via Google</span>
                            </button>
                        </div>
                    </div>
                </div>
                `,
            );
            scrollToBottom();
            return;
        }

        if (data.status === "success" || data.success === true) {
            // 1. Langsung hapus loader tanpa ditunda-tunda!
            if (document.getElementById(loadingId)) {
                document.getElementById(loadingId).remove();
            }

            const aiReply = data.response || data.message;
            const bubbleId = "reply-" + Date.now();

            // 2. Siapkan bungkus pesan (bubble chat kosong)
            chatBox.insertAdjacentHTML(
                "beforeend",
                `
        <div class="flex justify-start w-full animate-fade-in-up">
            <div id="${bubbleId}" class="bg-slate-100 border border-slate-200 text-slate-800 p-4 rounded-2xl max-w-[85%] shadow-sm text-sm relative">
            </div>
        </div>
        `,
            );

            // 3. Terapkan efek ngetik ke dalam kontainer tersebut
            const targetContainer = document.getElementById(bubbleId);
            const finalHTML = parseMarkdown(aiReply);

            applyTypingEffect(targetContainer, finalHTML);
            scrollToBottom();
        }
    } catch (error) {
        document.getElementById(loadingId)?.remove();
        console.error("Detail Kesalahan:", error);
        chatBox.insertAdjacentHTML(
            "beforeend",
            `
            <div class="flex justify-start w-full">
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl max-w-[85%] text-sm">
                    ⚠️ Mohon maaf, terjadi kesalahan: ${error.message}
                </div>
            </div>
            `,
        );
    }

    scrollToBottom();
};

// ==========================================
// 🔑 GOOGLE IDENTITY SERVICES
// ==========================================
window.openGoogleLoginModal = () => {
    if (typeof google !== "undefined" && google.accounts.id) {
        google.accounts.id.prompt((notification) => {
            if (
                notification.isNotDisplayed() ||
                notification.isSkippedMoment()
            ) {
                google.accounts.id.initialize({
                    client_id: document
                        .getElementById("g_id_onload")
                        .getAttribute("data-client_id"),
                    callback: handleCredentialResponse,
                });
                google.accounts.id.prompt();
            }
        });
    } else {
        console.warn(
            "Sistem GIS Google belum siap, mengalihkan ke halaman autentikasi.",
        );
        window.location.href = "/auth/google";
    }
};

window.handleCredentialResponse = function (response) {
    const chatBox = document.getElementById("chat-messages");
    if (!chatBox) return;

    const verifyId = "verify-" + Date.now();
    chatBox.insertAdjacentHTML(
        "beforeend",
        `
        <div id="${verifyId}" class="flex justify-start w-full animate-fade-in-up">
            <div class="bg-purple-50 text-purple-800 px-5 py-3 rounded-2xl border border-purple-100">
                <i class="fas fa-spinner animate-spin mr-2"></i> Memverifikasi akun Google Anda...
            </div>
        </div>
        `,
    );

    fetch("/auth/google/gis", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({ token: response.credential }),
    })
        .then((res) => res.json())
        .then((data) => {
            document.getElementById(verifyId)?.remove();

            if (data.success) {
                chatBox.insertAdjacentHTML(
                    "beforeend",
                    `
                    <div class="flex justify-start w-full animate-fade-in-up">
                        <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-2xl max-w-[85%] shadow-sm">
                            🎉 <strong>Autentikasi Berhasil!</strong><br>
                            Selamat datang ${escapeHtml(data.user.name)}. Batas penggunaan Anda sekarang <strong>TANPA BATAS</strong>. Silakan lanjutkan interaksi Anda.
                        </div>
                    </div>
                    `,
                );
                document
                    .querySelectorAll(".bg-amber-50")
                    .forEach((el) => el.remove());
            } else {
                alert("Mohon maaf, verifikasi gagal: " + data.message);
            }
        })
        .catch((err) => {
            document.getElementById(verifyId)?.remove();
            console.error("Kesalahan GIS:", err);
            alert(
                "Terjadi gangguan jaringan saat memverifikasi akun Google Anda.",
            );
        });
};

// ==========================================
// 🔊 SPEECH SYNTHESIS (TTS)
// ==========================================
window.getIndonesianVoice = function () {
    const voices = window.speechSynthesis.getVoices();
    return voices.find((v) => v.lang.includes("id-ID")) || voices[0];
};

window.speakText = function (text) {
    window.speechSynthesis.cancel();
    const utterance = new SpeechSynthesisUtterance(text);
    utterance.voice = window.getIndonesianVoice();
    utterance.lang = "id-ID";
    utterance.rate = 1.05;
    utterance.pitch = 1.0;
    window.speechSynthesis.speak(utterance);
};

window.speechSynthesis.onvoiceschanged = window.getIndonesianVoice;

window.speakLastReply = function () {
    const allReplies = document.querySelectorAll(
        "#chat-messages .flex.justify-start",
    );
    if (allReplies.length === 0) {
        alert("Belum ada respons yang dapat dibacakan.");
        return;
    }
    const lastReply = allReplies[allReplies.length - 1];
    const text = lastReply.innerText.trim();
    if (text) window.speakText(text);
};

// ==========================================
// 🎙️ SPEECH TO TEXT
// ==========================================
let recognitionInstance = null;
let isRecording = false;

window.toggleVoiceInput = function (targetInputId, btnId) {
    const SpeechRecognition =
        window.SpeechRecognition || window.webkitSpeechRecognition;
    if (!SpeechRecognition) {
        alert(
            "Peramban Anda belum mendukung fitur pengenalan suara. Disarankan menggunakan Google Chrome.",
        );
        return;
    }

    const btn = document.getElementById(btnId);
    const inputEl = document.getElementById(targetInputId);

    if (window.isRecording && window.recognitionInstance) {
        window.recognitionInstance.stop();
        if (inputEl) inputEl.focus();
        return;
    }

    window.recognitionInstance = new SpeechRecognition();
    window.recognitionInstance.lang = "id-ID";
    window.recognitionInstance.continuous = true;
    window.recognitionInstance.interimResults = true;

    window.recognitionInstance.onstart = () => {
        window.isRecording = true;
        if (btn) {
            btn.innerHTML = '<i class="fas fa-stop-circle text-xl"></i>';
            btn.classList.remove("text-slate-400", "hover:text-cyan-600");
            btn.classList.add("text-red-500", "animate-pulse");
            btn.title = "Berhenti merekam";
        }
    };

    window.recognitionInstance.onresult = (event) => {
        let transcript = "";
        for (let i = 0; i < event.results.length; i++) {
            transcript += event.results[i][0].transcript;
        }
        if (inputEl) {
            inputEl.value =
                transcript.charAt(0).toUpperCase() + transcript.slice(1);
            inputEl.style.height = "auto";
            inputEl.style.height = inputEl.scrollHeight + "px";
        }
    };

    window.recognitionInstance.onend = () => {
        window.isRecording = false;
        window.recognitionInstance = null;
        if (btn) {
            btn.innerHTML = '<i class="fas fa-microphone-lines text-xl"></i>';
            btn.classList.remove("text-red-500", "animate-pulse");
            btn.classList.add("text-slate-400", "hover:text-cyan-600");
            btn.title = "Gunakan pengenalan suara";
        }
    };

    window.recognitionInstance.onerror = (event) => {
        console.error("Kesalahan pengenalan suara:", event.error);
        window.isRecording = false;
        window.recognitionInstance = null;

        if (btn) {
            btn.innerHTML = '<i class="fas fa-microphone-lines"></i>';
            btn.classList.remove("text-red-500", "animate-pulse");
            btn.classList.add("text-slate-400", "hover:text-purple-600");
            btn.title = "Gunakan pengenalan suara";
        }

        if (inputEl) inputEl.focus();

        if (event.error === "not-allowed") {
            if (typeof Swal !== "undefined") {
                Swal.fire({
                    icon: "error",
                    title: "Akses Mikrofon Ditolak 🔒",
                    html: `
                        <div class="text-sm text-left mt-2 space-y-3 leading-relaxed">
                            <p>Peramban Anda menolak akses ke mikrofon. Untuk menggunakan fitur interaksi suara, silakan aktifkan izin akses secara manual.</p>
                            <ol class="list-decimal ml-5 font-medium text-slate-700 space-y-1">
                                <li>Klik ikon <strong>Gembok / Pengaturan</strong> di sebelah kiri bilah alamat.</li>
                                <li>Temukan menu <strong>Mikrofon (Microphone)</strong>.</li>
                                <li>Ubah menjadi <strong class="text-cyan-600">"Izinkan" (Allow)</strong>.</li>
                                <li>Lakukan <strong>Muat Ulang (Refresh/F5)</strong>.</li>
                            </ol>
                        </div>
                    `,
                    confirmButtonText: "Saya Mengerti",
                    confirmButtonColor: "#0891b2",
                });
            } else {
                alert(
                    "Akses mikrofon ditolak. Izinkan akses mikrofon di pengaturan browser Anda.",
                );
            }
        }
    };

    window.recognitionInstance.start();
};

// ==========================================
// ⚙️ INITIALIZATION
// ==========================================
document.addEventListener("DOMContentLoaded", () => {
    window.renderCards("all");

    const tx = document.getElementById("main-prompt");
    if (tx) {
        tx.addEventListener("input", function () {
            this.style.height = "auto";
            this.style.height = this.scrollHeight + "px";
            const start = this.selectionStart;
            const end = this.selectionEnd;
            if (this.value.length > 0) {
                this.value =
                    this.value.charAt(0).toUpperCase() + this.value.slice(1);
                this.setSelectionRange(start, end);
            }
        });

        tx.addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                if (e.shiftKey) return;
                e.preventDefault();
                window.submitPrompt(e);
            }
        });
    }

    const chatPrompt = document.getElementById("chat-prompt");
    if (chatPrompt) {
        chatPrompt.addEventListener("input", function () {
            const start = this.selectionStart;
            const end = this.selectionEnd;
            if (this.value.length > 0) {
                this.value =
                    this.value.charAt(0).toUpperCase() + this.value.slice(1);
                this.setSelectionRange(start, end);
            }
        });

        chatPrompt.addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                if (e.shiftKey) return;
                e.preventDefault();
                window.submitChatFollowUp();
            }
        });
    }

    // Handle tombol back browser
    window.addEventListener("popstate", (e) => {
        if (!e.state || !e.state.chatId) {
            backToLanding();
        }
    });
});

// ==========================================
// 🔧 CHAT ACTIONS (NAVBAR)
// ==========================================
window.startNewChat = () => {
    const dropdown = document.getElementById("chat-options-dropdown");
    if (dropdown) dropdown.classList.add("hidden");
    const chatMessages = document.getElementById("chat-messages");
    if (chatMessages) chatMessages.innerHTML = "";
    backToLanding();
};

// ─── Rename dari navbar: ambil ID dari currentChatId ───
window.renameChatFromNavbar = () => {
    // Tutup semua dropdown dulu
    const navbarDropdown = document.getElementById("navbar-chat-dropdown");
    if (navbarDropdown) navbarDropdown.classList.add("hidden");

    const chatId = currentChatId;

    if (
        !chatId ||
        chatId === "null" ||
        chatId === "undefined" ||
        chatId === null
    ) {
        showToast(
            "⚠️ Tidak ada percakapan aktif yang dapat diganti namanya.",
            "error",
        );
        return;
    }

    window.renameChat(String(chatId));
};

window.pinChatFromNavbar = () => {
    // Tutup semua dropdown dulu
    const navbarDropdown = document.getElementById("navbar-chat-dropdown");
    if (navbarDropdown) navbarDropdown.classList.add("hidden");
    const optionsDropdown = document.getElementById("chat-options-dropdown");
    if (optionsDropdown) optionsDropdown.classList.add("hidden");

    if (!currentChatId) {
        showToast(
            "⚠️ Tidak ada percakapan aktif yang dapat disematkan.",
            "error",
        );
        return;
    }
    window.pinChat(String(currentChatId));
};

// ==========================================
// 🔍 MODAL SEARCH HANDLERS
// ==========================================
window.toggleSearchModal = () => {
    const modal = document.getElementById("search-modal");
    if (!modal) return;

    modal.classList.toggle("hidden");

    if (!modal.classList.contains("hidden")) {
        setTimeout(() => document.getElementById("search-input")?.focus(), 100);
    } else {
        window.clearSearchInput();
    }
};

window.handleSearchInput = (keyword) => {
    const clearBtn = document.getElementById("btn-clear-search");
    const containerTitle = document.getElementById("search-container-title");
    const cards = document.querySelectorAll(".search-item-card");
    const cleanKeyword = keyword.trim();
    const emptySection = document.getElementById("section-pencarian");

    if (cleanKeyword.length > 0) {
        emptySection?.classList.add("hidden");
        clearBtn?.classList.remove("hidden");
        if (containerTitle)
            containerTitle.textContent = "Hasil Pencarian Lokal";
    } else {
        clearBtn?.classList.add("hidden");
        if (containerTitle) containerTitle.textContent = "Percakapan Terbaru";
    }

    let foundCount = 0;

    cards.forEach((card) => {
        const titleEl = card.querySelector(".search-item-title");
        if (!titleEl) return;

        if (!card.hasAttribute("data-original-title")) {
            card.setAttribute("data-original-title", titleEl.textContent);
        }
        const originalTitle = card.getAttribute("data-original-title");
        const lowerTitle = originalTitle.toLowerCase();
        const lowerKeyword = cleanKeyword.toLowerCase();

        if (lowerTitle.includes(lowerKeyword)) {
            card.classList.remove("hidden");
            foundCount++;

            if (cleanKeyword.length > 0) {
                const regex = new RegExp(
                    `(${escapeRegExp(cleanKeyword)})`,
                    "gi",
                );
                titleEl.innerHTML = originalTitle.replace(
                    regex,
                    `<span class="text-purple-600 font-extrabold">$1</span>`,
                );
            } else {
                titleEl.textContent = originalTitle;
            }
        } else {
            card.classList.add("hidden");
        }
    });

    const existingNoResult = document.getElementById("search-no-result-msg");

    if (cleanKeyword.length > 0) {
        emptySection?.classList.add("hidden");

        if (foundCount === 0) {
            if (!existingNoResult) {
                document
                    .getElementById("search-results-container")
                    ?.insertAdjacentHTML(
                        "beforeend",
                        `
                    <div id="search-no-result-msg" class="text-center py-8 px-4 animate-fade-in-up select-none flex flex-row items-center justify-center gap-2.5">
                        <div class="text-slate-400 flex items-center justify-center">
                            <i class="fas fa-magnifying-glass text-base"></i>
                        </div>
                        <h4 class="text-xs font-bold text-slate-500 tracking-wide">
                            Hasil Pencarian Tidak Ditemukan
                        </h4>
                    </div>
                    `,
                    );
            }
        } else {
            existingNoResult?.remove();
        }
    } else {
        existingNoResult?.remove();

        if (cards.length === 0) {
            emptySection?.classList.remove("hidden");
        } else {
            emptySection?.classList.add("hidden");
        }
    }
};

function escapeRegExp(string) {
    return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
}

window.clearSearchInput = () => {
    const inputEl = document.getElementById("search-input");
    if (inputEl) inputEl.value = "";
    window.handleSearchInput("");
};

window.loadSpecificChatFromSearch = (chatId) => {
    window.toggleSearchModal();
    window.switchToChatView();
    window.loadSpecificChat(chatId);
};

// ==========================================
// 💬 LOAD CHAT LAMA
// ==========================================
window.loadSpecificChat = async (chatId) => {
    if (window.innerWidth < 768) {
        const burger = document.getElementById("mobile-hamburger");
        const sidebar = document.querySelector("sidebar");
        if (sidebar) sidebar.classList.add("hidden");
        if (burger) burger.classList.add("hidden");
    }
    setCurrentChatId(chatId);

    window.subscribeToChatChannel(currentChatId);
    window.history.pushState({ chatId: chatId }, "", `/app/${chatId}`);

    const landingView = document.getElementById("landing-view");
    const chatBox = document.getElementById("chat-messages");
    const chatView = document.getElementById("chat-view");
    const navbar = document.getElementById("main-navbar");
    const sidebarOffset = sidebar ? sidebar.offsetWidth : 0;
    const theDrop = document.querySelector(".theDrop");

    if (!chatBox || !chatView) return;

    if (landingView) landingView.classList.add("hidden");
    if (navbar) navbar.classList.add("hidden");
    chatView.classList.add("hidden");

    if (theDrop) theDrop.classList.remove("hidden");

    let globalLoading = document.getElementById("global-screen-loader");
    if (!globalLoading) {
        document.body.insertAdjacentHTML(
            "beforeend",
            `<div id="global-screen-loader" class="fixed inset-0 z-[150] flex items-center justify-center bg-[#fafafa]/95 animate-fade-in md:left-16 md:z-40">
            <div class="flex flex-col items-center gap-3">
                <i class="fas fa-spinner animate-spin text-2xl text-purple-600"></i>
                <span class="text-xs font-bold text-slate-400 tracking-wide">Memuat riwayat percakapan...</span>
            </div>
        </div>`,
        );
        globalLoading = document.getElementById("global-screen-loader");
    } else {
        globalLoading.classList.remove("hidden");
    }

    try {
        const response = await fetch(`/app/${chatId}`, {
            method: "GET",
            headers: {
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
            },
        });

        if (response.status === 401 || response.status === 403) {
            throw new Error("AUTH_REQUIRED");
        }

        if (!response.ok)
            throw new Error("Gagal mengambil riwayat percakapan.");

        const data = await response.json();
        chatBox.innerHTML = "";

        const chatTitleHeader = document.getElementById("chat-title");
        if (chatTitleHeader && data.chat_title) {
            chatTitleHeader.textContent = data.chat_title;
        }

        if (data.messages && data.messages.length > 0) {
            data.messages.forEach((msg) => {
                if (msg.role === "user") {
                    chatBox.insertAdjacentHTML(
                        "beforeend",
                        `
                        <div class="flex justify-end w-full animate-fade-in-up">
                            <div class="bg-purple-600 text-white px-5 py-3 rounded-2xl max-w-[85%] shadow-sm text-sm">
                                ${escapeHtml(msg.message)}
                            </div>
                        </div>
                        `,
                    );
                } else {
                    chatBox.insertAdjacentHTML(
                        "beforeend",
                        `
                        <div class="flex justify-start w-full animate-fade-in-up">
                            <div class="bg-slate-100 border border-slate-200 text-slate-800 p-4 rounded-2xl max-w-[85%] shadow-sm text-sm">
                                ${msg.message}
                            </div>
                        </div>
                        `,
                    );
                }
            });

            setTimeout(() => {
                chatBox.scrollTop = chatBox.scrollHeight;
            }, 50);
        } else {
            chatBox.innerHTML = `<p class="text-xs text-slate-400 italic text-center py-6">Belum ada riwayat pesan pada percakapan ini.</p>`;
        }

        globalLoading?.classList.add("hidden");
        if (navbar) navbar.classList.remove("hidden");
        chatView.classList.remove("hidden");

        document.querySelectorAll(".sidebar-chat-btn").forEach((btn) => {
            btn.classList.remove(
                "bg-cyan-100",
                "text-cyan-800",
                "font-semibold",
            );
            btn.classList.add("text-slate-700", "hover:bg-slate-200/50");
            const svg = btn.querySelector("svg");
            if (svg) svg.classList.replace("text-cyan-600", "text-slate-400");
        });

        const activeBtn = document.getElementById(`sidebar-chat-${chatId}`);
        if (activeBtn) {
            activeBtn.classList.remove(
                "text-slate-700",
                "hover:bg-slate-200/50",
            );
            activeBtn.classList.add(
                "bg-cyan-100",
                "text-cyan-800",
                "font-semibold",
            );
            const activeSvg = activeBtn.querySelector("svg");
            if (activeSvg)
                activeSvg.classList.replace("text-slate-400", "text-cyan-600");
        }
    } catch (error) {
        console.error("Fetch Kesalahan:", error);
        globalLoading?.classList.add("hidden");
        if (navbar) navbar.classList.remove("hidden");
        chatView.classList.remove("hidden");

        chatBox.innerHTML = "";

        if (error.message === "AUTH_REQUIRED") {
            chatBox.insertAdjacentHTML(
                "beforeend",
                `
                <div class="flex justify-start w-full p-4 animate-fade-in-up">
                    <div class="bg-amber-50 border border-amber-200 text-amber-800 p-5 rounded-2xl max-w-[85%] shadow-sm flex flex-col gap-3.5 text-left select-none">
                        <div class="flex items-center gap-2.5">
                            <i class="fas fa-lock text-amber-600 text-base shrink-0"></i>
                            <strong class="text-sm font-bold tracking-wide text-amber-900">Hak Akses Terbatasi</strong>
                        </div>
                        <div class="text-xs font-medium text-amber-800/90 leading-relaxed tracking-wide">
                            Sesi riwayat hanya dapat diakses oleh pengguna yang telah terautentikasi. Silakan masuk terlebih dahulu.
                        </div>
                        <div class="pt-1">
                            <button onclick="window.openGoogleLoginModal()" 
                                class="group/btn inline-flex items-center justify-center gap-2 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-300 shadow-md hover:shadow-purple-500/20 cursor-pointer focus:outline-none">
                                <i class="fab fa-google text-sm transition-transform group-hover/btn:scale-110 shrink-0"></i>
                                <span>Autentikasi via Google</span>
                            </button>
                        </div>
                    </div>
                </div>
                `,
            );
        } else {
            chatBox.innerHTML = `
                <div class="flex justify-start w-full p-4">
                    <div class="bg-red-50 border border-red-200 text-red-700 text-xs p-4 rounded-2xl flex items-center gap-2">
                        <i class="fas fa-triangle-exclamation shrink-0"></i>
                        <span>Mohon maaf, terjadi kesalahan: ${error.message}</span>
                    </div>
                </div>
            `;
        }
    }
};

// ==========================================
// ⌨️ SHORTCUT KEYBOARD
// ==========================================
document.addEventListener("keydown", (e) => {
    const modal = document.getElementById("search-modal");
    if (!modal) return;

    if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === "k") {
        e.preventDefault();
        window.toggleSearchModal();
    }

    if (e.key === "Escape" && !modal.classList.contains("hidden")) {
        e.preventDefault();
        window.toggleSearchModal();
    }
});

window.toggleAccountModal = (e) => {
    if (e) {
        e.stopPropagation();
        e.preventDefault();
    }
    const modal = document.getElementById("account-popup-modal");
    if (modal) modal.classList.toggle("hidden");
};
