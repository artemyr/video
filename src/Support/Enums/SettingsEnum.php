<?php

namespace Support\Enums;

enum SettingsEnum: string
{
    case MAIN_PHONE = 'main.phone';
    case MAIN_TG = 'main.tg';
    case MAIN_LOGO = 'main.logo';
    case MAIN_AUTHOR = 'main.author';
    case MAIN_FAVICON = 'main.favicon';
    case CONTACTS_LOGO = 'contacts.logo';
    case CONTACT_TEXT_1 = 'contacts.text.1';
}
