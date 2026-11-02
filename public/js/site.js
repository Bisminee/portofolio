(() => {
    const header = document.querySelector("[data-header]");
    const toggle = document.querySelector("[data-nav-toggle]");
    const nav = document.querySelector("[data-nav]");

    if (!header || !toggle || !nav) return;

    const label = toggle.querySelector(".sr-only");
    const mobileQuery = window.matchMedia("(max-width: 960px)");

    const setOpen = (open) => {
        header.classList.toggle("is-open", open);
        document.body.classList.toggle("nav-open", open && mobileQuery.matches);
        toggle.setAttribute("aria-expanded", String(open));
        if (label) label.textContent = open ? "Close navigation" : "Open navigation";
    };

    toggle.addEventListener("click", () => {
        setOpen(toggle.getAttribute("aria-expanded") !== "true");
    });

    nav.addEventListener("click", (event) => {
        const link = event.target.closest('a[href^="#"]');
        if (!link) return;

        const id = link.getAttribute("href");
        const isMobileMenu = mobileQuery.matches && header.classList.contains("is-open");

        setOpen(false);

        if (isMobileMenu) {
            // Unlocking body scroll before the browser resolves the anchor keeps
            // the target from landing a screen too low on small devices.
            event.preventDefault();
            window.setTimeout(() => {
                const target = document.querySelector(id);
                if (!target) return;
                history.pushState(null, "", id);
                const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
                target.scrollIntoView({ behavior: reduceMotion ? "auto" : "smooth", block: "start" });
            }, 30);
        }
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && header.classList.contains("is-open")) {
            setOpen(false);
            toggle.focus();
        }
    });

    mobileQuery.addEventListener("change", (event) => {
        if (!event.matches) setOpen(false);
    });

    // Mark the section currently in view without hijacking scroll behaviour.
    const links = new Map(
        [...nav.querySelectorAll('a[href^="#"]')].map((link) => [link.getAttribute("href").slice(1), link]),
    );

    if ("IntersectionObserver" in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    links.forEach((link) => link.removeAttribute("aria-current"));
                    const link = links.get(entry.target.id);
                    if (link) link.setAttribute("aria-current", "true");
                });
            },
            { rootMargin: "-35% 0px -55% 0px", threshold: 0 },
        );

        links.forEach((_, id) => {
            const section = document.getElementById(id);
            if (section) observer.observe(section);
        });
    }
})();
