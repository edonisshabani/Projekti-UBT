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
