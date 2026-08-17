document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.testimonials-body').forEach(function (wrapper) {
        var scroller = wrapper.querySelector('.testimonial-scroller');
        var track = wrapper.querySelector('.testimonial-track');
        var prevBtn = wrapper.querySelector('.testimonial-nav-prev');
        var nextBtn = wrapper.querySelector('.testimonial-nav-next');
        if (!scroller || !track || !prevBtn || !nextBtn) return;

        function step() {
            var card = track.querySelector('.testimonial-card');
            if (!card) return scroller.clientWidth;
            var gap = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap || 0);
            return card.getBoundingClientRect().width + gap;
        }

        function updateButtons() {
            var max = track.scrollWidth - scroller.clientWidth - 1;
            prevBtn.disabled = scroller.scrollLeft <= 0;
            nextBtn.disabled = scroller.scrollLeft >= max;
        }

        prevBtn.addEventListener('click', function () {
            scroller.scrollBy({ left: -step(), behavior: 'smooth' });
        });
        nextBtn.addEventListener('click', function () {
            scroller.scrollBy({ left: step(), behavior: 'smooth' });
        });

        scroller.addEventListener('scroll', updateButtons);
        window.addEventListener('resize', updateButtons);
        updateButtons();
    });
});
