import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const rootElement = document.documentElement;
    const darkModeButton = document.querySelector(
      '[data-hs-theme-click-value="dark"]'
    );
    const lightModeButton = document.querySelector(
      '[data-hs-theme-click-value="light"]'
    );
  
    // Atur tema awal
    const userTheme = localStorage.getItem('theme');
    const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const initialTheme = userTheme || (systemTheme ? 'dark' : 'light');
  
    if (initialTheme === 'dark') {
      rootElement.classList.add('dark');
      darkModeButton.classList.add('hidden');
      lightModeButton.classList.remove('hidden');
    } else {
      rootElement.classList.remove('dark');
      lightModeButton.classList.add('hidden');
      darkModeButton.classList.remove('hidden');
    }
  
    // Event listener untuk tombol tema
    darkModeButton.addEventListener('click', () => {
      rootElement.classList.add('dark');
      localStorage.setItem('theme', 'dark');
      darkModeButton.classList.add('hidden');
      lightModeButton.classList.remove('hidden');
    });
  
    lightModeButton.addEventListener('click', () => {
      rootElement.classList.remove('dark');
      localStorage.setItem('theme', 'light');
      lightModeButton.classList.add('hidden');
      darkModeButton.classList.remove('hidden');
    });
  });