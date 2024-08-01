// logout.js

document.addEventListener('DOMContentLoaded', function() {
    var popupTrigger = document.querySelector('.cd-popup-trigger');
    var popup = document.querySelector('.cd-popup');
    var popupCloseButtons = document.querySelectorAll('.cd-popup-close');

    if (popupTrigger) {
        popupTrigger.addEventListener('click', function (event) {
            event.preventDefault();
            popup.classList.add('is-visible');
        });
    }

    if (popupCloseButtons) {
        popupCloseButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                popup.classList.remove('is-visible');
            });
        });
    }

    // Close popup when clicking outside of it
    popup.addEventListener('click', function (event) {
        if (event.target === popup) {
            popup.classList.remove('is-visible');
        }
    });

    // Function to handle logout
    window.confirmLogout = function () {
        window.location.href = "../logout.php";
    };
});
