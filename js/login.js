// SWITCH BUTTON
document.addEventListener('DOMContentLoaded', function() {
    const loginBtn = document.getElementById('loginBtn');
    const signupBtn = document.getElementById('signupBtn');
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');

    loginBtn.addEventListener('click', function() {
        loginForm.classList.remove('hidden');
        loginForm.classList.add('visible');
        signupForm.classList.remove('visible');
        signupForm.classList.add('hidden');
        loginBtn.classList.add('active');
        signupBtn.classList.remove('active');
    });

    signupBtn.addEventListener('click', function() {
        signupForm.classList.remove('hidden');
        signupForm.classList.add('visible');
        loginForm.classList.remove('visible');
        loginForm.classList.add('hidden');
        signupBtn.classList.add('active');
        loginBtn.classList.remove('active');
    });
});

function showLogin() {
    document.getElementById('loginForm').classList.remove('hidden');
    document.getElementById('loginForm').classList.add('visible');
    document.getElementById('signupForm').classList.remove('visible');
    document.getElementById('signupForm').classList.add('hidden');
    document.getElementById('loginBtn').classList.add('active');
    document.getElementById('signupBtn').classList.remove('active');
}

function showSignup() {
    document.getElementById('signupForm').classList.remove('hidden');
    document.getElementById('signupForm').classList.add('visible');
    document.getElementById('loginForm').classList.remove('visible');
    document.getElementById('loginForm').classList.add('hidden');
    document.getElementById('signupBtn').classList.add('active');
    document.getElementById('loginBtn').classList.remove('active');
}

// EYE PASSWORD
function togglePasswordVisibility(element) {
    const input = element.previousElementSibling;
    const icon = element.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}

// Ambil semua elemen toggle-password
const togglePasswordElements = document.querySelectorAll('.toggle-password');

// Tambahkan event listener untuk setiap elemen toggle-password
togglePasswordElements.forEach(function(togglePasswordElement) {
    togglePasswordElement.addEventListener('click', function() {
        // Ambil input password yang terkait
        const passwordInput = this.parentElement.querySelector('.input-pw');

        // Ubah tipe input antara 'password' dan 'text'
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.innerHTML = '<i class="fa fa-eye"></i>'; // Ganti ikon ke mata terbuka
        } else {
            passwordInput.type = 'password';
            this.innerHTML = '<i class="fa fa-eye-slash"></i>'; // Ganti ikon ke mata tertutup
        }
    });
});