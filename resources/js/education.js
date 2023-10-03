document.addEventListener("DOMContentLoaded", function () {
    // Hide the initial state of the sub-menu
    var subMenu = document.getElementById("subMenu");
    var categoryToggle = document.getElementById("categoryToggle");

    subMenu.style.display = "none";

    // Toggle the sub-menu with a slide animation when clicking the Category link
    categoryToggle.addEventListener("click", function () {
        toggleVisibility(subMenu);
    });

    // Custom toggleVisibility function
    function toggleVisibility(element) {
        if (element.style.display === "none" || element.style.display === "") {
            element.style.display = "block";
            slideDown(element, 500); // 500 milliseconds for the animation
        } else {
            slideUp(element, 500); // 500 milliseconds for the animation
        }
    }

    // Custom slideDown function
    function slideDown(element, duration) {
        var height = 0;
        element.style.height = "0";
        var interval = setInterval(function () {
            if (height >= element.scrollHeight) {
                clearInterval(interval);
            } else {
                height += element.scrollHeight / (duration / 10);
                element.style.height = height + "px";
            }
        }, 10);
    }

    // Custom slideUp function
    function slideUp(element, duration) {
        var height = element.scrollHeight;
        var interval = setInterval(function () {
            if (height <= 0) {
                clearInterval(interval);
                element.style.display = "none";
            } else {
                height -= element.scrollHeight / (duration / 10);
                element.style.height = height + "px";
            }
        }, 10);
    }
});
