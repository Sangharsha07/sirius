<script>
    const toggle = document.getElementById('darkModeToggle');
    const body = document.body;


    if (localStorage.getItem('darkMode') === 'enabled') {
        body.classList.add('dark-mode');
        if (toggle) toggle.textContent = '☀️';
    }

    // Toggle interaction listener
    if (toggle) {
        toggle.addEventListener('click', function() {
            body.classList.toggle('dark-mode');
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                toggle.textContent = '☀️';
            } else {
                localStorage.setItem('darkMode', 'disabled');
                toggle.textContent = '🌙';
            }
        });
    }
</script>