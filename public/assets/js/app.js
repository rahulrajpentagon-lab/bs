document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.querySelector('.navbar');
    let ticking = false;

    window.addEventListener('scroll', function () {
        if (!navbar || ticking) {
            return;
        }

        ticking = true;
        window.requestAnimationFrame(function () {
            navbar.style.boxShadow = window.scrollY > 30
                ? '0 8px 30px rgba(15,23,42,.08)'
                : 'none';
            ticking = false;
        });
    }, { passive: true });

    document.querySelectorAll('.navbar-nav .nav-link').forEach(function (link) {
        link.addEventListener('click', function () {
            const collapseEl = document.querySelector('.navbar-collapse');

            if (collapseEl && collapseEl.classList.contains('show')) {
                const bsCollapse = bootstrap.Collapse.getInstance(collapseEl)
                    || new bootstrap.Collapse(collapseEl);

                bsCollapse.hide();
            }
        });
    });

    document.querySelectorAll('#enquiry-form').forEach(function (form) {
        const button = form.querySelector('button[type="submit"]');
        const originalHtml = button ? button.innerHTML : '';

        form.addEventListener('submit', function () {
            if (!form.checkValidity() || !button) {
                return;
            }

            button.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Submitting...';
            button.disabled = true;

            window.setTimeout(function () {
                if (document.body.contains(button) && button.disabled) {
                    button.disabled = false;
                    button.innerHTML = originalHtml;
                }
            }, 15000);
        });

        form.addEventListener('invalid', function () {
            if (button) {
                button.disabled = false;
                button.innerHTML = originalHtml;
            }
        }, true);
    });

    const worksCarouselEl = document.getElementById('worksCarousel');
    if (worksCarouselEl && window.bootstrap) {
        const worksCarousel = bootstrap.Carousel.getOrCreateInstance(worksCarouselEl, {
            interval: 4500,
            ride: 'carousel',
            pause: 'hover',
            touch: true,
            wrap: true,
        });

        worksCarousel.cycle();

        document.addEventListener('visibilitychange', function () {
            if (document.hidden) {
                worksCarousel.pause();
            } else {
                worksCarousel.cycle();
            }
        });
    }
});
