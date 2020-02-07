<?php

return [
    // BANCO DE DADOS
    'dbname' => 'papel_arroz',
    'dbhost' => 'localhost',
    'dbpass' => '',
    'dbuser' => 'root',
    
    
    // SITE
    'site_url' => 'http://localhost/papel-arroz/',
    'site_name' => 'Papel Arroz',
    
    // Pastas
    'dirBase' => str_replace(['\\','/'], DIRECTORY_SEPARATOR, substr(__DIR__,0, strrpos(__DIR__, '\\'))).DIRECTORY_SEPARATOR
];
