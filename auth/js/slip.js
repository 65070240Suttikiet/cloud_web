document.addEventListener("DOMContentLoaded", function() {
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    const carousel = document.querySelector('.carousel');
    const slides = document.querySelectorAll('.carousel-slide');

    let counter = 0;
    const slideWidth = slides[0].clientWidth;

    // Initial position
    carousel.style.transform = 'translateX(' + (-slideWidth * counter) + 'px)';

    // Button listeners
    nextButton.addEventListener('click', () => {
        if (counter >= slides.length - 1) return;
        carousel.style.transition = "transform 0.5s ease-in-out";
        counter++;
        carousel.style.transform = 'translateX(' + (-slideWidth * counter) + 'px)';
    });

    prevButton.addEventListener('click', () => {
        if (counter <= 0) return;
        carousel.style.transition = "transform 0.5s ease-in-out";
        counter--;
        carousel.style.transform = 'translateX(' + (-slideWidth * counter) + 'px)';
    });

    // Transition end
    carousel.addEventListener('transitionend', () => {
        if (slides[counter].classList.contains('clone-last')) {
            counter = slides.length - 2;
            carousel.style.transition = 'none';
            carousel.style.transform = 'translateX(' + (-slideWidth * counter) + 'px)';
        }

        if (slides[counter].classList.contains('clone-first')) {
            counter = slides.length - counter;
            carousel.style.transition = 'none';
            carousel.style.transform = 'translateX(' + (-slideWidth * counter) + 'px)';
        }
    });
});
