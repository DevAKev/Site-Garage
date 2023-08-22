document.addEventListener("DOMContentLoaded", function() {
    window.addEventListener("scroll", function() {
        const body = document.body;
        if (window.scrollY > 300) {
            body.classList.add("scrolling");
        } else {
            body.classList.remove("scrolling");
        }
    });
});