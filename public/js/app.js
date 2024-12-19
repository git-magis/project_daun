import './bootstrap';

import AOS from 'aos';
import 'aos/dist/aos.css'; // This is important to include the CSS for AOS animations

document.addEventListener('DOMContentLoaded', function () {
    AOS.init(); // Initialize AOS once the DOM is fully loaded
});
