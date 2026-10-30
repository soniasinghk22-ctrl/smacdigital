/**
 * Stone Hub India - Interactive Homepage Script
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Sticky Header
    const header = document.querySelector('.stonehub-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // 2. Cinematic Hero Slider
    let currentSlide = 0;
    const slides = document.querySelectorAll('.stonehub-hero-slide');
    const dots = document.querySelectorAll('.stonehub-hero-dot');
    const totalSlides = slides.length;
    let slideInterval;

    function showSlide(index) {
        if (totalSlides === 0) return;
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        currentSlide = (index + totalSlides) % totalSlides;
        
        slides[currentSlide].classList.add('active');
        if (dots[currentSlide]) {
            dots[currentSlide].classList.add('active');
        }

        // Apply transform to slider track
        const track = document.querySelector('.stonehub-hero-slider');
        if (track) {
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
        }
    }

    window.setHeroSlide = function(index) {
        showSlide(index);
        resetSlideTimer();
    };

    function nextHeroSlide() {
        showSlide(currentSlide + 1);
    }

    function startSlideTimer() {
        if (totalSlides > 1) {
            slideInterval = setInterval(nextHeroSlide, 8000);
        }
    }

    function resetSlideTimer() {
        clearInterval(slideInterval);
        startSlideTimer();
    }

    // Initialize slider
    showSlide(0);
    startSlideTimer();

    // 3. Scroll Reveal Animations
    const revealElements = document.querySelectorAll('.reveal-on-scroll');
    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    revealElements.forEach(el => revealObserver.observe(el));

    // 4. JS Scroll Counters
    const statItems = document.querySelectorAll('.stonehub-stat-item h4');
    const counterObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const valueStr = target.innerText;
                const valueNum = parseInt(valueStr);
                const suffix = valueStr.replace(/[0-9]/g, ''); // Extract '+' or 'k+'
                
                let start = 0;
                const duration = 1500;
                const startTime = performance.now();
                
                function updateCounter(currentTime) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    // easeOutQuad
                    const ease = progress * (2 - progress);
                    
                    target.innerText = Math.floor(ease * valueNum) + suffix;
                    
                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    } else {
                        target.innerText = valueStr; // Guarantee exact end value
                    }
                }
                
                requestAnimationFrame(updateCounter);
                observer.unobserve(target);
            }
        });
    }, { threshold: 0.5 });

    statItems.forEach(item => counterObserver.observe(item));

    // 5. Before-After Slab Slider
    const beforeSlider = document.querySelector('.stonehub-slider-wrapper');
    if (beforeSlider) {
        const beforeImg = beforeSlider.querySelector('.stonehub-slider-before');
        const handle = beforeSlider.querySelector('.stonehub-slider-handle');
        const button = beforeSlider.querySelector('.stonehub-slider-button');
        const imageWidth = beforeSlider.offsetWidth;
        
        function moveSlider(xPos) {
            let box = beforeSlider.getBoundingClientRect();
            let relativeX = xPos - box.left;
            let percent = (relativeX / box.width) * 100;
            
            if (percent < 0) percent = 0;
            if (percent > 100) percent = 100;
            
            beforeImg.style.width = percent + '%';
            handle.style.left = percent + '%';
            button.style.left = percent + '%';
        }
        
        beforeSlider.addEventListener('mousemove', (e) => {
            moveSlider(e.clientX);
        });
        
        beforeSlider.addEventListener('touchmove', (e) => {
            if (e.touches[0]) {
                moveSlider(e.touches[0].clientX);
            }
        });
    }

    // 6. Interactive Process Timeline Progress bar
    const processSection = document.querySelector('.stonehub-process');
    if (processSection) {
        const steps = processSection.querySelectorAll('.stonehub-process-step');
        const progressBar = processSection.querySelector('.stonehub-process-timeline-progress');
        
        const processObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Animate timeline progress bar
                    if (progressBar) progressBar.style.width = '75%';
                    
                    // Activate steps in sequence
                    steps.forEach((step, idx) => {
                        setTimeout(() => {
                            step.classList.add('active');
                        }, idx * 400);
                    });
                }
            });
        }, { threshold: 0.3 });
        
        processObserver.observe(processSection);
    }

    // 7. Accordion FAQ
    const faqHeaders = document.querySelectorAll('.stonehub-faq-header');
    faqHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const item = header.parentElement;
            const body = item.querySelector('.stonehub-faq-body');
            const isActive = item.classList.contains('active');
            
            // Close all items
            document.querySelectorAll('.stonehub-faq-item').forEach(el => {
                el.classList.remove('active');
                el.querySelector('.stonehub-faq-body').style.maxHeight = null;
            });
            
            if (!isActive) {
                item.classList.add('active');
                body.style.maxHeight = body.scrollHeight + 'px';
            }
        });
    });

    // Shared homepage carousel helper (categories + slabs)
    function initStonehubCarousel(root, options = {}) {
        if (!root) return;

        const trackSelector = options.trackSelector || '.stonehub-categories-track';
        const cardSelector = options.cardSelector || '.stonehub-category-card';
        const track = root.querySelector(trackSelector);
        const cards = Array.from(root.querySelectorAll(cardSelector));
        const prevBtn = root.querySelector('.stonehub-cat-prev');
        const nextBtn = root.querySelector('.stonehub-cat-next');
        if (!track || !cards.length) return;

        let index = 0;
        let autoplayTimer = null;
        const autoplayMs = Number(root.dataset.autoplay || options.autoplay || 0);

        function getVisibleCount() {
            const raw = getComputedStyle(root).getPropertyValue('--cat-visible').trim();
            const n = parseInt(raw, 10);
            return Number.isFinite(n) && n > 0 ? n : 4;
        }

        function getStepSize() {
            const styles = getComputedStyle(track);
            const gap = parseFloat(styles.gap) || 0;
            return cards[0].getBoundingClientRect().width + gap;
        }

        function maxIndex() {
            return Math.max(0, cards.length - getVisibleCount());
        }

        function update() {
            const max = maxIndex();
            if (index > max) index = max;
            if (index < 0) index = 0;

            track.style.transform = `translateX(-${index * getStepSize()}px)`;
            root.classList.toggle('is-single', max === 0);

            if (prevBtn) prevBtn.disabled = index <= 0 && !autoplayMs;
            if (nextBtn) nextBtn.disabled = index >= max && !autoplayMs;

            // With looping autoplay, keep arrows enabled when there is more than one page
            if (autoplayMs && max > 0) {
                if (prevBtn) prevBtn.disabled = false;
                if (nextBtn) nextBtn.disabled = false;
            }
        }

        function goTo(nextIndex) {
            const max = maxIndex();
            if (max <= 0) {
                index = 0;
            } else if (autoplayMs) {
                index = ((nextIndex % (max + 1)) + (max + 1)) % (max + 1);
            } else {
                index = Math.min(Math.max(nextIndex, 0), max);
            }
            update();
        }

        function stopAutoplay() {
            if (autoplayTimer) {
                clearInterval(autoplayTimer);
                autoplayTimer = null;
            }
        }

        function startAutoplay() {
            stopAutoplay();
            if (!autoplayMs || maxIndex() <= 0) return;
            autoplayTimer = setInterval(() => {
                goTo(index + 1);
            }, autoplayMs);
        }

        prevBtn?.addEventListener('click', () => {
            goTo(index - 1);
            startAutoplay();
        });

        nextBtn?.addEventListener('click', () => {
            goTo(index + 1);
            startAutoplay();
        });

        let touchStartX = 0;
        track.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0]?.clientX || 0;
            stopAutoplay();
        }, { passive: true });

        track.addEventListener('touchend', (e) => {
            const dx = (e.changedTouches[0]?.clientX || 0) - touchStartX;
            if (Math.abs(dx) >= 40) {
                goTo(index + (dx < 0 ? 1 : -1));
            }
            startAutoplay();
        }, { passive: true });

        root.addEventListener('mouseenter', stopAutoplay);
        root.addEventListener('mouseleave', startAutoplay);

        window.addEventListener('resize', update);

        update();
        startAutoplay();
    }

    initStonehubCarousel(document.querySelector('[data-categories-carousel]'), {
        trackSelector: '.stonehub-categories-track',
        cardSelector: '.stonehub-category-card',
        autoplay: 4000
    });

    initStonehubCarousel(document.querySelector('[data-reels-carousel]'), {
        trackSelector: '.stonehub-reels-track',
        cardSelector: '.stonehub-reel-card',
        autoplay: 4500
    });

    initStonehubCarousel(document.querySelector('[data-slabs-carousel]'), {
        trackSelector: '.stonehub-slabs-track',
        cardSelector: '.stonehub-slab-card',
        autoplay: 4000
    });

    if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
    }
});
