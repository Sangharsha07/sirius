<script>
    const toggle = document.getElementById('darkModeToggle');
    const body = document.body;

    const updateToggleText = () => {
        if (!toggle) return;
        toggle.textContent = body.classList.contains('dark-mode') ? '☀️' : '🌙';
    };

    if (localStorage.getItem('darkMode') === 'enabled') {
        body.classList.add('dark-mode');
    }

    updateToggleText();

    // Toggle interaction listener
    if (toggle) {
        toggle.addEventListener('click', function() {
            body.classList.toggle('dark-mode');

            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', 'disabled');
            }

            updateToggleText();
        });
    }
</script>