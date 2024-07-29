document.addEventListener('DOMContentLoaded', function () {
    const line = document.querySelector('.loading .line');
    const percentage = document.querySelector('.loading .line .percentage');

    let width = 0;
    const interval = setInterval(() => {
        width++;
        if (width <= 100) {
            line.style.width = width + '%';
            percentage.textContent = width + '%';
        } else {
            clearInterval(interval);
            setTimeout(() => {
                console.log('Redirecting to homepage.php'); // Debugging line
                window.location.href = 'homepage.php';
            }, 500); // Redirects after 0.5 second
        }
    }, 20); // 20ms interval for 2 seconds animation
});
