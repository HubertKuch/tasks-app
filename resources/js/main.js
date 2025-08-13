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

function inView(elm, threshold = 0) {
    const rect = elm.getBoundingClientRect();
    const vpWidth = window.innerWidth;
    const vpHeight = window.innerHeight;

    const above = rect.bottom - threshold <= 0;
    const below = rect.top - vpHeight + threshold >= 0;
    const left = rect.right - threshold <= 0;
    const right = rect.left - vpWidth + threshold >= 0;
    const inside = !above && !below && !left && !right;

    return {above, below, left, right, inside};
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

waitForElement(".tasks-container", (container) => {
    const tabs = [...document.querySelectorAll(".tabs-nav-container [data-set-view]")];

    tabs.forEach((item) => {

        item.addEventListener("click", (e) => {
            tabs.forEach(tab => tab.classList.remove("active-tab"));

            const setTo = item.getAttribute("data-set-view");

            container.setAttribute("data-view", setTo);

            e.currentTarget.classList.add("active-tab");
        })

    })
});

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('details').forEach(details => {
        const isntInView = inView(details, 100);

        const stayInRight = ['relative', 'right-2'];

        details.addEventListener('mouseenter', () => {
            details.setAttribute('open', '');

            if (isntInView.right) {
                details.querySelector('.dropdown-content').classList.add(...stayInRight);
            }
        });

        details.addEventListener('mouseleave', () => {
            details.removeAttribute('open')

            if (isntInView.right) {
                details.querySelector('.dropdown-content').classList.remove(...stayInRight);
            }
        });
    });
});

window.TasksApp = window.TasksApp || {};

/**
 * @param {string} type A type like: info, success, warning
 * */
window.TasksApp.toast = (msg, type = 'info') => {
    Toastify({
        text: msg, className: `toast-${type}`, duration: 1500
    }).showToast();
}

window.TasksApp.copyToClipboard = (value) => {
    navigator.clipboard.writeText(value)
        .then(() => {
            TasksApp.toast("Link copied to clipboard");
        });
}
