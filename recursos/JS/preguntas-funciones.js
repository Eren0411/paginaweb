document.addEventListener("DOMContentLoaded", function () {
    var functionQuestions = document.querySelectorAll('.sistemaDetalle-functions .question');
    var faqQuestions = document.querySelectorAll('.sistemaDetalle-faq .question');

    functionQuestions.forEach(function (question) {
        question.addEventListener('click', function () {
            var answer = this.nextElementSibling;
            var toggleIcon = this.querySelector('.toggle-icon i');

            if (answer.classList.contains('active')) {
                answer.classList.remove('active');
                toggleIcon.classList.remove('rotated');
            } else {

                answer.classList.add('active');
                toggleIcon.classList.toggle('rotated');
            }
        });
    });

    faqQuestions.forEach(function (question) {
        question.addEventListener('click', function () {
            var answer = this.nextElementSibling;
            var toggleIcon = this.querySelector('.toggle-icon i');

            if (answer.classList.contains('active')) {
                answer.classList.remove('active');
                toggleIcon.classList.remove('rotated');
            } else {

                answer.classList.add('active');
                toggleIcon.classList.toggle('rotated');
            }
        });
    });
});