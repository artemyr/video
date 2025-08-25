import './bootstrap';
import Alpine from 'alpinejs'
import '../css/app.css';

if (!location.pathname.includes('/admin/')) {
    window.Alpine = Alpine
    Alpine.start()
}

import './main'

import.meta.glob([
    '../images/**',
    '../fonts/**',
])
