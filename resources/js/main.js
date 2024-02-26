$(document).ready(function () {
    // // Register Service worker for PWA
    // if ('serviceWorker' in navigator) {
    //     // Register a service worker hosted at the root of the
    //     // site using the default scope.
    //     navigator.serviceWorker.register(document.location.origin + '/service-worker.js').then(function (registration) {
    //         console.log('Service worker registration succeeded:', registration);
    //     }, /*catch*/ function (error) {
    //         console.log('Service worker registration failed:', error);
    //     });
    // } else {
    //     console.log('Service workers are not supported.');
    // }

    $('.selectize-singular').selectize({
        // options
    });

    $('.selectize-singular-linked').selectize({
        onChange(value) {
            window.location = value;
        }
    });

    $('.jq-select').styler();

    initializeApkModal();
});


// Ajax CSRF-Token initialization
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// scroll top button
document.querySelector('#scroll-top-button').addEventListener('click', () => {
    document.body.scrollIntoView({ block: 'start', behavior: 'smooth' });
})


// Header search
document.querySelector('#header-search-button').addEventListener('click', () => {
    let input = document.querySelector('#header-search-input');

    // submit form if value is givven
    if (!input.classList.contains('header-search__input--hidden') && input.value.length > 2) {
        document.querySelector('#header-search-form').submit();
        // else hide search input
    } else {
        input.classList.toggle('header-search__input--hidden');
        input.focus();
    }
});


// Mobile Menu Toggler
document.querySelectorAll('[data-action="toggle-mobile-menu"]').forEach(item => {
    item.addEventListener('click', (evt) => {
        document.querySelector('.mobile-menu').classList.toggle('mobile-menu--visible');
    });
});


// most readable carousel
if (document.querySelector('#most-readable-books-carousel')) {
    let mostReadableBooksCarousel = $('#most-readable-books-carousel').owlCarousel({
        margin: 16,
        loop: true,
        dots: false,
        autoplay: true,
        autoplayHoverPause: true,
        autoplaySpeed: 4000,
        autoplayTimeout: 7000,
        responsive: {
            0: {
                items: 1,
                autoWidth: false,
                nav: true
            },
            991: {
                autoWidth: true,
                items: 3,
            }
        }
    });

    document.querySelector('#most-readable-books-carousel-prev-button').addEventListener('click', () => {
        mostReadableBooksCarousel.trigger('prev.owl.carousel');
    })

    document.querySelector('#most-readable-books-carousel-next-button').addEventListener('click', () => {
        mostReadableBooksCarousel.trigger('next.owl.carousel');
    })
}


// --------------Accordion start----------------
document.querySelectorAll('.accordion__button').forEach((item) => {
    item.addEventListener('click', (evt) => {
        let button = evt.target;
        let accordion = button.closest('.accordion');
        let item = button.closest('.accordion__item');
        let collapse = item.querySelector('.accordion__collapse');

        // close active collapse if it isn`t current target
        let activeItem = accordion.querySelector('.accordion__item--active');
        if (activeItem && activeItem !== item) {
            activeItem.classList.remove('accordion__item--active');
            activeItem.querySelector('.accordion__collapse').style.height = null;
        }

        // close active collapse if it is current target
        if (collapse.clientHeight) {
            collapse.style.height = 0;
            item.classList.remove('accordion__item--active');
            // else show collapse body if its hidden
        } else {
            collapse.style.height = collapse.scrollHeight + "px";
            item.classList.add('accordion__item--active');
        }
    });
});
// -------------- Accordion end ----------------


// modals
document.querySelectorAll('[data-action="show-modal"]').forEach(item => {
    item.addEventListener('click', (evt) => {
        document.getElementById(item.dataset.targetId).classList.add('show');
        document.body.style.overflowY = "hidden";
    });
});

// hide modals
document.querySelectorAll('[data-action="hide-modal"]').forEach(item => {
    item.addEventListener('click', (evt) => {
        document.body.style.overflowY = "auto";
        document.getElementById(item.dataset.targetId).classList.remove('show');
    });
});


// collapse
document.querySelectorAll('.collapse__button').forEach(item => {
    item.addEventListener('click', (evt) => {
        let target = evt.target;
        let collapse = target.closest('.collapse');
        let body = collapse.querySelector('.collapse__body');

        if (body.clientHeight) {
            body.style.height = 0;
            collapse.classList.remove('collapse--active')
        } else {
            body.style.height = body.scrollHeight + "px";
            collapse.classList.add('collapse--active')
        }
    });
});


// Function to set a cookie with a specific name, value, and expiration time
function setCookie(name, value, days) {
    const date = new Date();
    // Set expiration date
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    // Set the cookie
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookieValue(cookieName) {
    // Split the document.cookie string into individual cookies
    const cookies = document.cookie.split(';');

    // Loop through each cookie to find the one with the specified name
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();

        // Check if this cookie has the specified name
        if (cookie.startsWith(cookieName + '=')) {
            // Extract and return the value of the cookie
            return cookie.substring(cookieName.length + 1);
        }
    }

    // If the cookie with the specified name is not found, return null
    return null;
}

function initializeApkModal() {
    let apkModal = document.querySelector('.apk-modal');
    let apkModalDismiss = document.querySelector('.apk-modal__dismiss');

    let apkCookie = getCookieValue('apk-modal');

    // Add cookie for the first time and show modal
    if (apkCookie === null) {
        console.log('Ti tupoy suka?')
        setCookie('apk-modal', 'visible', 60);
        apkModal.classList.remove('apk-modal--hidden');
    }

    // Show modal if needed. Modal is hidden by default
    if (apkCookie == 'visible') {
        apkModal.classList.remove('apk-modal--hidden');
    }

    // Add dismiss click listener
    apkModalDismiss.addEventListener('click', () => {
        setCookie('apk-modal', 'hidden', 60);
        apkModal.classList.add('apk-modal--hidden');
    });
}
