import './bootstrap';
import Alpine from 'alpinejs'

if (!location.pathname.includes('/admin/')) {
    window.Alpine = Alpine
    Alpine.start()
}

import './main'

import.meta.glob([
    '../images/**',
    '../fonts/**',
])
