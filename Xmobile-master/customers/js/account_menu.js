document.addEventListener('DOMContentLoaded', function () {
    const profileBtn = document.getElementById('profileBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');

    // Toggle dropdown menu on button click
    profileBtn.addEventListener('click', function (e) {
      e.stopPropagation(); // Prevent click from bubbling
      dropdownMenu.classList.toggle('hidden');
    });

    // Hide dropdown menu if clicked outside
    document.addEventListener('click', function (e) {
      if (!dropdownMenu.contains(e.target) && !profileBtn.contains(e.target)) {
        dropdownMenu.classList.add('hidden');
      }
    });
  });