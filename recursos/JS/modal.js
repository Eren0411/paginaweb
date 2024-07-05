var termsModal = document.getElementById('terms-modal');
var privacyModal = document.getElementById('privacy-modal');
var termsContent = document.getElementById('terms-content');
var privacyContent = document.getElementById('privacy-content');
var termsLink = document.getElementById('terms-link');
var privacyLink = document.getElementById('privacy-link');

// Función para abrir el modal de términos y condiciones
function openTermsModal() {
    termsModal.style.display = 'block';
}

// Función para abrir el modal de aviso de privacidad
function openPrivacyModal() {
    privacyModal.style.display = 'block';
}

// Agregamos eventos de click a los enlaces
termsLink.addEventListener('click', function (event) {
    event.preventDefault();
    openTermsModal();
});

privacyLink.addEventListener('click', function (event) {
    event.preventDefault();
    openPrivacyModal();
});

// Agregamos evento de click al botón de cerrar
var closeBtns = document.querySelectorAll('.close');
closeBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
        termsModal.style.display = 'none';
        privacyModal.style.display = 'none';
    });
});

// Cerramos los modales si se hace click fuera de ellos
window.addEventListener('click', function (event) {
    if (event.target == termsModal || event.target == privacyModal) {
        termsModal.style.display = 'none';
        privacyModal.style.display = 'none';
    }
});