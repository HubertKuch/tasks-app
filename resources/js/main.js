"use strict";

function waitForElement(selector, callback) {
    const interval = setInterval(() => {
        const element = document.querySelector(selector);

        if (element) {
            clearInterval(interval);
            callback(element);
        }
    }, 100);
}

waitForElement("button.toggle-sidebar", (toggler) => {
    const sidebar = document.querySelector("#main-sidebar");
    const expander = document.querySelector(".sidebar__expand");
    const collapser = document.querySelector(".sidebar__collapse");

    toggler.addEventListener("click", () => {
        if (sidebar.classList.contains("active")) {
            sidebar.classList.remove("active");

            collapser.classList.add("hidden");
            expander.classList.remove("hidden");
        } else {
            sidebar.classList.add("active");

            collapser.classList.remove("hidden");
            expander.classList.add("hidden");
        }

    });
});

