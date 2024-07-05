function getNumImagesPerSlide() {
    if (window.innerWidth <= 480) {
        return 2; // por tu CSS, 2 imágenes se muestran en dispositivos <= 480px
    } else if (window.innerWidth <= 768) {
        return 3; // por tu CSS, 3 imágenes se muestran en dispositivos <= 768px
    } else {
        return 4; // por tu CSS, 4 imágenes se muestran en dispositivos mayores a 768px
    }
}

function updateCarousel(carousel) {
    const currentIndex = +carousel.getAttribute('data-index');
    const images = carousel.querySelectorAll(".image");
    const maxIndex = images.length - 1;
    const numImages = getNumImagesPerSlide();
    const translateX = -currentIndex * (100 / numImages);
    carousel.style.transform = `translateX(${translateX}%)`;
    return { images, currentIndex, maxIndex };
}

function navigateCarousel(direction, serviceName) {
    const carousel = document.getElementById(`carousel-${serviceName}`);
    let { currentIndex, maxIndex } = updateCarousel(carousel);
    const numImages = getNumImagesPerSlide();

    if (direction === 'left') {
        if (currentIndex - numImages < 0) {
            currentIndex = maxIndex - (maxIndex % numImages);
        } else {
            currentIndex -= numImages;
        }
    } else if (direction === 'right') {
        if (currentIndex + numImages > maxIndex) {
            currentIndex = 0;
        } else {
            currentIndex += numImages;
        }
    }

    carousel.setAttribute('data-index', currentIndex);
    updateCarousel(carousel);
}

// Detener y reanudar el carrusel cuando el cursor entra/sale
document.querySelectorAll(".carousel-container").forEach(carouselContainer => {
    let interval = setInterval(() => {
        navigateCarousel('right', carouselContainer.querySelector('.image-carousel').id.split('-')[1]);
    }, 3500);

    carouselContainer.addEventListener("mouseenter", () => {
        clearInterval(interval);
    });

    carouselContainer.addEventListener("mouseleave", () => {
        interval = setInterval(() => {
            navigateCarousel('right', carouselContainer.querySelector('.image-carousel').id.split('-')[1]);
        }, 3500);
    });
});

// Navegación con teclado (flechas izquierda/derecha)
document.querySelector(".gallery").addEventListener("keydown", (e) => {
    const focusedCarousel = document.activeElement.querySelector('.image-carousel');
    if (!focusedCarousel) return;

    if (e.key === "ArrowLeft") {
        navigateCarousel('left', focusedCarousel.id.split('-')[1]);
    } else if (e.key === "ArrowRight") {
        navigateCarousel('right', focusedCarousel.id.split('-')[1]);
    }
});
