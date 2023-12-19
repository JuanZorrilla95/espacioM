document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;
 
    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.style.opacity = i === index ? '1' : '0';
      });
    }
 
    function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);
    }
 
    // Iniciar el slider
    showSlide(currentSlide);
    setInterval(nextSlide, 5000); // Cambiar de slide (foto) cada 3 segundos
  });