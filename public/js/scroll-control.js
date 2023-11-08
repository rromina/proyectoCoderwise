window.addEventListener('scroll', function() {
    let navbar = document.getElementById('fixed-color');
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > 0) {
    navbar.classList.add('fixed');
    } else {
    navbar.classList.remove('fixed');
    }
    });