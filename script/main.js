//Edonisi
document.querySelector('.mob-menu').onclick = () => {
    document.querySelector('.navlist').classList.toggle('show');
};

window.onscroll = function() {
    let header = document.querySelector('header');
    if (window.scrollY > 50) {
        header.style.backgroundColor = 'rgba(255, 255, 255, 0.98)';
    } else {
        header.style.backgroundColor = 'transparent';
    }
};



// Anisi
const sliderImages = document.querySelector('.slider-images');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');
const totalImages = document.querySelectorAll('.slider-images img').length;
const visibleImages = 2;
let currentIndex = 0;

function updateSlider() {
    const offset = -(currentIndex * (100 / visibleImages));
    sliderImages.style.transform = `translateX(${offset}%)`;
}

prevBtn.addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex--;
    } else {
        currentIndex = totalImages - visibleImages;
    }
    updateSlider();
});

nextBtn.addEventListener('click', () => {
    if (currentIndex < totalImages - visibleImages) {
        currentIndex++;
    } else {
        currentIndex = 0;
    }
    updateSlider();
});
