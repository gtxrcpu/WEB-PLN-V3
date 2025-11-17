import Alpine from "alpinejs";

window.Alpine = Alpine;

/**
 * UI state untuk layout.
 * Tidak ada auto-open di init. isSearchOpen = false by default.
 */
window.appUI = function () {
    return {
        // --- STATE ---
        isSearchOpen: false,
        q: "",
        results: [],
        total: 0,
        loading: false,
        err: "",
        timer: null,

        // --- ACTIONS ---
        openSearch(initQ = null) {
            // Buka sheet manual
            if (typeof initQ === "string") this.q = initQ;
            this.isSearchOpen = true;
            // fokus input setelah render
            this.$nextTick(() => {
                const el = document.getElementById("searchInput");
                if (el) el.focus({ preventScroll: true });
            });
        },

        closeSearch() {
            this.isSearchOpen = false;
            this.loading = false;
            this.err = "";
            this.results = [];
            // biarkan q tetap, supaya kalau buka lagi text masih ada
        },

        onInput(debounce = true) {
            if (this.q.trim().length < 3) {
                this.results = [];
                this.total = 0;
                this.loading = false;
                this.err = "";
                if (this.timer) clearTimeout(this.timer);
                return;
            }
            const run = () => this.fetchItems();
            if (debounce) {
                if (this.timer) clearTimeout(this.timer);
                this.timer = setTimeout(run, 250);
            } else {
                run();
            }
        },

        async fetchItems() {
            try {
                this.loading = true;
                this.err = "";
                this.results = [];

                const q = encodeURIComponent(this.q.trim());
                const url = `/search/items?q=${q}&limit=8`;
                const res = await fetch(url, {
                    headers: { "X-Requested-With": "XMLHttpRequest" },
                });

                if (!res.ok) throw new Error(`HTTP ${res.status}`);
                const data = await res.json();

                this.results = Array.isArray(data.data) ? data.data : [];
                this.total = Number.isFinite(data.total)
                    ? data.total
                    : this.results.length;
            } catch (e) {
                this.err = "Gagal memuat data.";
                console.error(e);
            } finally {
                this.loading = false;
            }
        },
    };
};

Alpine.start();
