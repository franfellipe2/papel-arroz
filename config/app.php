<?php
return [
    // BANCO DE DADOS
    'dbname' => 'papel_arroz',
    'dbhost' => 'localhost',
    'dbpass' => '',
    'dbuser' => 'root',
    
    
    // SITE
    'baseUrl' => 'http://localhost/papel-arroz',
    'siteName' => 'Papel Arroz',
    
    // Pastas
    'baseDir' => str_replace(['\\','/'], DIRECTORY_SEPARATOR, substr(__DIR__,0, strrpos(__DIR__, '\\'))).DIRECTORY_SEPARATOR
];
