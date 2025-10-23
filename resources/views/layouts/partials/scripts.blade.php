<!-- JavaScript -->
<script>
    // User Dropdown
    const button = document.getElementById('user-button');
    const dropdown = document.getElementById('user-dropdown');
    const container = document.getElementById('user-menu-container');
    let timeoutId = null;

    if (button && dropdown && container) {
        const showDropdown = () => {
            clearTimeout(timeoutId);
            dropdown.classList.remove('hidden');
        };

        const hideDropdown = () => {
            timeoutId = setTimeout(() => {
                dropdown.classList.add('hidden');
            }, 500);
        };

        const cancelHide = () => {
            clearTimeout(timeoutId);
        };

        button.addEventListener('mouseenter', showDropdown);
        button.addEventListener('mouseleave', hideDropdown);
        dropdown.addEventListener('mouseenter', cancelHide);
        dropdown.addEventListener('mouseleave', hideDropdown);
        container.addEventListener('mouseenter', cancelHide);
        container.addEventListener('mouseleave', hideDropdown);

        button.addEventListener('click', (e) => {
            e.stopPropagation();
            if (dropdown.classList.contains('hidden')) {
                showDropdown();
            } else {
                dropdown.classList.add('hidden');
            }
        });

        document.addEventListener('click', (e) => {
            if (!container.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }

    // Theme Toggle
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    function updateThemeIcon() {
        if (document.documentElement.classList.contains('dark')) {
            themeToggleLightIcon.classList.add('hidden');
            themeToggleDarkIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.add('hidden');
            themeToggleLightIcon.classList.remove('hidden');
        }
    }

    updateThemeIcon();

    themeToggleBtn.addEventListener('click', function() {
        document.documentElement.classList.toggle('dark');
        
        if (document.documentElement.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
        
        updateThemeIcon();
    });
</script>