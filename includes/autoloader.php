<?php 
function autoloader($className) {
    // replace namespace+class into file path -> replaces backlashes with forward slashes 
    $fileName = str_replace('\\', '/', $className) . '.php';
    $file = __DIR__ . '/../classes/' . $fileName;
    include $file; 
} 
    spl_autoload_register('autoloader');