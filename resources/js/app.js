import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// Смена темы
const userPrefersDark =
    localStorage.theme === "dark" ||
    (!("theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches);

if (userPrefersDark) {
    document.documentElement.classList.add("dark");
}

window.addEventListener("DOMContentLoaded", () => {
    const icon = document.getElementById("theme-icon");
    const isDark = document.documentElement.classList.contains("dark");
    icon.setAttribute("data-theme", isDark ? "dark" : "light");

    icon.querySelectorAll("g").forEach((group) => {
        group.style.display =
            group.getAttribute("data-theme") === (isDark ? "dark" : "light")
                ? "inline"
                : "none";
    });
});

document.addEventListener("click", (e) => {
    const icon = document.getElementById("theme-icon");
    if (!icon) return;

    const isDark = document.documentElement.classList.contains("dark");
    icon.querySelectorAll("g").forEach((group) => {
        group.style.display =
            group.getAttribute("data-theme") === (isDark ? "dark" : "light")
                ? "inline"
                : "none";
    });
});
