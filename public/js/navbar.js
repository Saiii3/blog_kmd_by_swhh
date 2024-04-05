const navLinks = document.querySelector('.nav-links');

function onToggleMenu(e) {
    e.name = e.name === 'menu' ? 'close' : 'menu';
    navLinks.classList.toggle('top-[6%]');
}

document.addEventListener('DOMContentLoaded', () => {
    const newsDropdownButton = document.getElementById('newsDropdownButton');
    const newsDropdownMenu = document.getElementById('newsDropdown');

    newsDropdownButton.addEventListener('click', function() {
        const expanded = this.getAttribute('aria-expanded') === 'true' || false;
        this.setAttribute('aria-expanded', !expanded);
        newsDropdownMenu.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    window.addEventListener('click', function(e) {
        if (!newsDropdownButton.contains(e.target) && !newsDropdownMenu.contains(e.target)) {
            newsDropdownMenu.classList.add('hidden');
            newsDropdownButton.setAttribute('aria-expanded', 'false');
        }
    });
});
