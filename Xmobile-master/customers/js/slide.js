
function changeProductSlide(direction, sliderId) {
  const slider = document.getElementById(sliderId);
  const totalSlides = slider.children.length;
  let index = parseInt(slider.dataset.index || 0);
  index = (index + direction + totalSlides) % totalSlides;
  slider.dataset.index = index;
  slider.style.transform = `translateX(-${index * 100}%)`;
}

let currentIndex = 0;
const slideInterval = 5000;

function changeImageSlide(direction) {
  const slides = document.querySelectorAll('.slide');
  const totalSlides = slides.length;
  currentIndex = (currentIndex + direction + totalSlides) % totalSlides;

  slides.forEach((slide, index) => {
    slide.classList.toggle('active', index === currentIndex);
  });

  updateDots();
}

function currentImageSlide(index) {
  currentIndex = index - 1;
  changeImageSlide(0);
}

function updateDots() {
  const dots = document.querySelectorAll('.dot');
  dots.forEach((dot, index) => {
    dot.classList.toggle('bg-green-500', index === currentIndex);
    dot.classList.toggle('bg-white', index !== currentIndex);
  });
}

function autoSlide() {
  changeImageSlide(1);
  setTimeout(autoSlide, slideInterval);
}

setTimeout(autoSlide, slideInterval);
updateDots();
