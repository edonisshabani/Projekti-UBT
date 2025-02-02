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
function openProductPage(url) {
    window.location.href = url;
}
function changeImage(src) {
    document.getElementById('mainImage').src = src;
}


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

function validateForm() {
    const name = document.getElementById("name").value;

    const email = document.getElementById("email").value;

    const password = document.getElementById("password").value;

    const emailRegex = /^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com|ubt-uni\.net)$/;

    const nameRegex = /^[A-Z][a-zA-Z]{1,19}$/;

    if (!nameRegex.test(name)) {
        alert("Name must start with a capital letter and be no longer than 20 characters.");
        return false;
    }
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address (Gmail, Hotmail or UBT Email).");
        return false;
    }
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*.]{8,16}$/;
    if (!passwordRegex.test(password)) {
        alert("Password must be 8-16 characters, contain at least one uppercase letter, one number, and one symbol.");
        return false;
    }
    return true;
}

function validateContactForm() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;

    const nameRegex = /^[A-Z][a-zA-Z]{1,19}$/;
    if (!name.match(nameRegex)) {
        alert("Name must start with a capital letter and be no longer than 20 characters.");
        return false;
    }

    const emailRegex = /^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com|ubt-uni\.net)$/;
    if (!email.match(emailRegex)) {
        alert("Please enter a valid email address (Gmail, Hotmail or UBT Email).");
        return false;
    }

    return true;
}

window.onload = function () {
    const messageBox = document.getElementById('message');
    if (messageBox && messageBox.textContent.trim() !== "") {
        setTimeout(() => {
            messageBox.style.display = "none";
        }, 3000);
    }
};

