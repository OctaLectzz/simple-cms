const toggleSwitch = document.querySelector('#dark-mode-toggle');
const isDarkMode = localStorage.getItem('dark-mode') === 'true';

  toggleSwitch.checked = isDarkMode;

  toggleSwitch.addEventListener('change', function() {
    if (this.checked) {
      document.documentElement.classList.add('dark-mode');
      localStorage.setItem('dark-mode', true);
      document.cookie = "dark-mode=1; path=/";
      axios.post('/dark-mode', { darkMode: 1 });
    } else {
      document.documentElement.classList.remove('dark-mode');
      localStorage.setItem('dark-mode', false);
      document.cookie = "dark-mode=0; path=/";
      axios.post('/dark-mode', { darkMode: 0 });
    }
  });




// Save Local Storage
function setTheme(theme) {
  document.documentElement.className = theme;
  localStorage.setItem('theme', theme);
}

document.getElementById('dark-mode-toggle').addEventListener('change', function() {
  if (this.checked) {
      setTheme('dark-mode');
  } else {
      setTheme('');
  }
});

var theme = localStorage.getItem('theme');
    if (theme) {
        setTheme(theme);
        document.getElementById('dark-mode-toggle').checked = true;
    }
