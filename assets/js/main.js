/**
 * Mono Archive Theme - Main JavaScript
 *
 * @package Mono_Archive
 * @since 1.0.0
 */

(function () {
    'use strict';

    /**
     * Search Overlay Toggle
     */
    const searchOverlay = document.getElementById('search-overlay');
    const searchToggle = document.querySelector('.mono-nav__search-toggle');
    const searchClose = document.querySelector('.mono-search-overlay__close');
    const searchInput = searchOverlay ? searchOverlay.querySelector('input[type="search"]') : null;

    if (searchToggle && searchOverlay) {
        searchToggle.addEventListener('click', function () {
            searchOverlay.classList.add('is-active');
            searchOverlay.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            if (searchInput) {
                setTimeout(function () {
                    searchInput.focus();
                }, 100);
            }
        });
    }

    if (searchClose && searchOverlay) {
        searchClose.addEventListener('click', function () {
            searchOverlay.classList.remove('is-active');
            searchOverlay.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        });
    }

    // Close search on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && searchOverlay && searchOverlay.classList.contains('is-active')) {
            searchOverlay.classList.remove('is-active');
            searchOverlay.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            if (searchToggle) {
                searchToggle.focus();
            }
        }
    });

    /**
     * Sticky Navigation - Add shadow on scroll
     */
    const nav = document.querySelector('.mono-nav');
    if (nav) {
        let lastScroll = 0;
        window.addEventListener('scroll', function () {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 50) {
                nav.classList.add('is-scrolled');
            } else {
                nav.classList.remove('is-scrolled');
            }
            lastScroll = currentScroll;
        }, { passive: true });
    }

    /**
     * Newsletter Form - Simple validation feedback
     */
    const newsletterForm = document.querySelector('.mono-newsletter__form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const input = this.querySelector('input[type="email"]');
            const button = this.querySelector('button[type="submit"]');
            if (input && input.value && input.validity.valid) {
                button.textContent = 'SUBSCRIBED';
                button.disabled = true;
                input.disabled = true;
                input.value = '';
                setTimeout(function () {
                    button.textContent = 'SUBSCRIBE';
                    button.disabled = false;
                    input.disabled = false;
                }, 3000);
            }
        });
    }

    /**
     * Lazy load images with IntersectionObserver
     */
    if ('IntersectionObserver' in window) {
        const imgObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    img.classList.add('is-loaded');
                    imgObserver.unobserve(img);
                }
            });
        }, {
            rootMargin: '200px 0px'
        });

        document.querySelectorAll('img[data-src]').forEach(function (img) {
            imgObserver.observe(img);
        });
    }

    /**
     * Animate elements on scroll
     */
    if ('IntersectionObserver' in window) {
        const animObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    animObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        document.querySelectorAll('.mono-animate').forEach(function (el) {
            animObserver.observe(el);
        });
    }

})();
