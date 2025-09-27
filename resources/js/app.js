import './bootstrap';

// Reset browser history when clicking primary menu items
document.addEventListener('DOMContentLoaded', function() {
    const primaryMenuItems = document.querySelectorAll('nav a[href="/"], nav a[href="/events"], nav a[href="/dreams"], nav a[href="/stats"]');

    primaryMenuItems.forEach(function(menuItem) {
        menuItem.addEventListener('click', function(e) {
            e.preventDefault();

            // Clear browser history by replacing current state
            const targetUrl = this.getAttribute('href');
            window.history.replaceState(null, '', targetUrl);

            // Navigate to the page
            window.location.href = targetUrl;
        });
    });
});
