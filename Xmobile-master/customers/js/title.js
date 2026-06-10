// Quản lý slider chính (ảnh banner)
let currentImageIndex = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
const totalImageSlides = slides.length;

function showImageSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
        dots[i].style.backgroundColor = i === index ? '#007bff' : 'white';
    });
}

function changeImageSlide(direction) {
    currentImageIndex = (currentImageIndex + direction + totalImageSlides) % totalImageSlides;
    showImageSlide(currentImageIndex);
}

function currentImageSlide(index) {
    currentImageIndex = index - 1;
    showImageSlide(currentImageIndex);
}

// Tự động chuyển slide ảnh (tùy chọn, có thể bỏ nếu không cần)
setInterval(() => changeImageSlide(1), 5000);

// Quản lý slider sản phẩm
function changeProductSlide(direction, sliderId) {
    const slider = document.getElementById(sliderId);
    const slides = slider.querySelectorAll('.min-w-full');
    const totalSlides = slides.length;
    let currentIndex = parseInt(slider.dataset.currentIndex || '0');

    currentIndex = (currentIndex + direction + totalSlides) % totalSlides;
    slider.dataset.currentIndex = currentIndex;

    const offset = -currentIndex * 100;
    slider.style.transform = `translateX(${offset}%)`;
}

// Khởi tạo slider đầu tiên cho mỗi section
document.querySelectorAll('.flex.transition-transform').forEach(slider => {
    slider.dataset.currentIndex = '0';
});

// Xử lý các nút tab (Tất cả, iPhone 16, iPhone 15, v.v.)
document.querySelectorAll('.container button').forEach(button => {
    button.addEventListener('click', () => {
        // Xóa class active khỏi tất cả các nút
        document.querySelectorAll('.container button').forEach(btn => {
            btn.classList.remove('active');
        });

        // Thêm class active cho nút được click
        button.classList.add('active');

        // Ẩn tất cả nội dung
        document.querySelectorAll('.content-section').forEach(content => {
            content.classList.add('hidden');
        });

        // Hiển thị nội dung tương ứng với nút được click
        const contentId = `content-${button.id}`;
        const content = document.getElementById(contentId);
        if (content) {
            content.classList.remove('hidden');
        }
    });
});