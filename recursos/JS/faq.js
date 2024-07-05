document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
        const answer = button.nextElementSibling;
        button.classList.toggle('active');
        answer.classList.toggle('active');
    });
});

function filterFAQs(x){
    const form = document.getElementById(x);
    if(form != null) {
        form.submit();
    }
}