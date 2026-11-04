(() => {
    const root = document.documentElement;
    const translationNode = document.getElementById("portfolio-translations");
    const translations = (() => {
        try {
            return JSON.parse(translationNode?.textContent || "{}");
        } catch (error) {
            return {};
        }
    })();

    const ui = translations.ui || {};
    const projectTranslations = translations.projects || {};
    const journeyTranslations = translations.journey || [];
    const activityTranslations = translations.activities || {};
    const meta = translations.meta || {};
    const storageKey = "portfolio-language";

    const header = document.querySelector("[data-header]");
    const toggle = document.querySelector("[data-nav-toggle]");
    const nav = document.querySelector("[data-nav]");
    const toggleLabel = toggle?.querySelector(".sr-only");
    const descriptionMeta = document.querySelector('meta[name="description"]');
    const page = document.body.dataset.page || "home";
    const originalTitle = document.title;
    const originalDescription = descriptionMeta?.getAttribute("content") || "";
    const originalText = new WeakMap();
    const originalAttributes = new WeakMap();

    const currentLanguage = () => (root.lang === "id" ? "id" : "en");

    const rememberText = (element) => {
        if (!originalText.has(element)) originalText.set(element, element.textContent);
        return originalText.get(element);
    };

    const rememberAttributes = (element) => {
        if (!originalAttributes.has(element)) originalAttributes.set(element, {});
        return originalAttributes.get(element);
    };

    const setNavToggleLabel = () => {
        if (!toggleLabel) return;
        const open = toggle?.getAttribute("aria-expanded") === "true";
        const fallback = open ? "Close navigation" : "Open navigation";
        const translatedLabel = open ? ui["nav.close"] : ui["nav.open"];
        toggleLabel.textContent =
            currentLanguage() === "id" ? (translatedLabel ?? fallback) : fallback;
    };

    const applyLanguage = (language, persist = true) => {
        const isIndonesian = language === "id";
        root.lang = isIndonesian ? "id" : "en";

        document.querySelectorAll("[data-i18n]").forEach((element) => {
            const original = rememberText(element);
            element.textContent = isIndonesian ? (ui[element.dataset.i18n] ?? original) : original;
        });

        document.querySelectorAll("[data-i18n-alt]").forEach((element) => {
            const attributes = rememberAttributes(element);
            if (!("alt" in attributes)) attributes.alt = element.getAttribute("alt") || "";
            const translated = ui[element.dataset.i18nAlt];
            element.setAttribute("alt", isIndonesian && translated ? translated : attributes.alt);
        });

        document.querySelectorAll("[data-i18n-aria-label]").forEach((element) => {
            const attributes = rememberAttributes(element);
            if (!("ariaLabel" in attributes)) {
                attributes.ariaLabel = element.getAttribute("aria-label") || "";
            }
            const translated = ui[element.dataset.i18nAriaLabel];
            element.setAttribute(
                "aria-label",
                isIndonesian && translated ? translated : attributes.ariaLabel,
            );
        });

        document.querySelectorAll("[data-project-text]").forEach((element) => {
            const original = rememberText(element);
            const slug = element.dataset.project;
            const field = element.dataset.projectText;
            const translated = projectTranslations[slug]?.[field];
            element.textContent = isIndonesian && typeof translated === "string" ? translated : original;
        });

        document.querySelectorAll("[data-project-field]").forEach((element) => {
            const original = rememberText(element);
            const slug = element.dataset.project;
            const field = element.dataset.projectField;
            const index = Number(element.dataset.projectIndex);
            const translated = projectTranslations[slug]?.[field];
            element.textContent =
                isIndonesian && Array.isArray(translated) && typeof translated[index] === "string"
                    ? translated[index]
                    : original;
        });

        document.querySelectorAll("[data-project-alt]").forEach((element) => {
            const attributes = rememberAttributes(element);
            if (!("projectAlt" in attributes)) {
                attributes.projectAlt = element.getAttribute("alt") || "";
            }
            const translated = projectTranslations[element.dataset.project]?.art_alt;
            element.setAttribute(
                "alt",
                isIndonesian && typeof translated === "string" ? translated : attributes.projectAlt,
            );
        });

        document.querySelectorAll("[data-journey-field]").forEach((element) => {
            const original = rememberText(element);
            const index = Number(element.dataset.journeyIndex);
            const field = element.dataset.journeyField;
            const translated = journeyTranslations[index]?.[field];
            element.textContent = isIndonesian && typeof translated === "string" ? translated : original;
        });

        document.querySelectorAll("[data-activity-text]").forEach((element) => {
            const original = rememberText(element);
            const translated = activityTranslations[element.dataset.activity]?.[element.dataset.activityText];
            element.textContent = isIndonesian && typeof translated === "string" ? translated : original;
        });

        document.querySelectorAll("[data-activity-field]").forEach((element) => {
            const original = rememberText(element);
            const field = element.dataset.activityField;
            const index = Number(element.dataset.activityIndex);
            const translated = activityTranslations[element.dataset.activity]?.[field];
            element.textContent =
                isIndonesian && Array.isArray(translated) && typeof translated[index] === "string"
                    ? translated[index]
                    : original;
        });

        document.querySelectorAll("[data-activity-alt]").forEach((element) => {
            const attributes = rememberAttributes(element);
            if (!("activityAlt" in attributes)) {
                attributes.activityAlt = element.getAttribute("alt") || "";
            }
            const translated = activityTranslations[element.dataset.activity]?.image_alt;
            element.setAttribute(
                "alt",
                isIndonesian && typeof translated === "string" ? translated : attributes.activityAlt,
            );
        });

        const titleKey = page === "error" ? "errorTitle" : "homeTitle";
        const descriptionKey = page === "error" ? "errorDescription" : "homeDescription";
        document.title = isIndonesian ? (meta[titleKey] ?? originalTitle) : originalTitle;
        if (descriptionMeta) {
            descriptionMeta.setAttribute(
                "content",
                isIndonesian ? (meta[descriptionKey] ?? originalDescription) : originalDescription,
            );
        }

        document.querySelectorAll("[data-lang-switch] [data-lang]").forEach((button) => {
            const active = button.dataset.lang === language;
            button.classList.toggle("is-active", active);
            button.setAttribute("aria-pressed", String(active));
        });

        setNavToggleLabel();

        if (persist) {
            try {
                localStorage.setItem(storageKey, language);
            } catch (error) {
                // Storage can be blocked in private modes; the switch still works.
            }
        }
    };

    let initialLanguage = "en";
    try {
        if (localStorage.getItem(storageKey) === "id") initialLanguage = "id";
    } catch (error) {
        // Ignore storage access errors.
    }

    applyLanguage(initialLanguage, false);

    document.querySelectorAll("[data-lang-switch] [data-lang]").forEach((button) => {
        button.addEventListener("click", () => applyLanguage(button.dataset.lang));
    });

    window.addEventListener("storage", (event) => {
        if (event.key === storageKey && (event.newValue === "en" || event.newValue === "id")) {
            applyLanguage(event.newValue, false);
        }
    });

    if (!header || !toggle || !nav) return;

    const mobileQuery = window.matchMedia("(max-width: 960px)");

    const setOpen = (open) => {
        header.classList.toggle("is-open", open);
        document.body.classList.toggle("nav-open", open && mobileQuery.matches);
        toggle.setAttribute("aria-expanded", String(open));
        setNavToggleLabel();
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
        [...nav.querySelectorAll('a[href^="#"]')].map((link) => [
            link.getAttribute("href").slice(1),
            link,
        ]),
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
