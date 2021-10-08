<?php
// Déclaration des constantes + Regex:
define('REGEX_EMAIL','^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}$');
define('REGEX_PSEUDO','^[a-zA-Z0-6]*$');
define('REGEX_ADDRESS', "^[0-9]{0,6}[A-Za-z0-9-éèêëàâäôöûüç' \.,&#;]+$");
define('REGEX_NOJOB','^[0-9]{7}[A-Z]{1}$');
define('ARRAY_COUNTRIES', ['France', 'belge', 'Allemagne', 'Anglaise']);
define('ARRAY_NATIONALITIES', ['Française', 'belge', 'Allemande', 'Anglaise']);
define('REGEX_HOUR', "^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$");
define('REGEX_DATETIME',"([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]) ([01][0-9]|2[0-3]):[0-5]\d)");
define('REGEX_NO_NUMBER','/^[A-Za-z-éèêëàâäôöûüç\' ]+$/');
define('REGEX_DATE',"/^\d{4}-\d{2}-\d{1,2}$/");
define('REGEX_PHONE', '/^(\+33|0|0033)[1-9]((\-|\/|\.)?\d{2}){4}$/');
define('REGEX_DATE_HOUR',"/^\d{4}-\d{2}-\d{1,2}T\d{2}:\d{2}$/");