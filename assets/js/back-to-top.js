(function(){
  'use strict';

  function smoothScrollToTop(duration){
    const start = window.scrollY || window.pageYOffset;
    const startTime = performance.now();

    function easeInOutQuad(t){ return t<0.5?2*t*t: -1 + (4-2*t)*t; }

    function tick(now){
      const time = Math.min(1, (now - startTime) / duration);
      const eased = easeInOutQuad(time);
      window.scrollTo(0, Math.round(start * (1 - eased)));
      if(time < 1) requestAnimationFrame(tick);
    }

    requestAnimationFrame(tick);
  }

  function init(){
    const btn = document.querySelector('.nexawp-back-to-top');
    if(!btn) return;

    btn.addEventListener('click', function(e){
      e.preventDefault();
      smoothScrollToTop(500);
    }, { passive: true });

    // Show/hide button on scroll
    function toggle(){
      if(window.scrollY > 300){
        btn.classList.add('visible');
      } else {
        btn.classList.remove('visible');
      }
    }

    window.addEventListener('scroll', toggle, { passive: true });
    toggle();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
