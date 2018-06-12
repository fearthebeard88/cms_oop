<?php

function classAutoLoad($class) {
    $class = strtolower($class);

    $path = "includes/{$class}.php";

    if(is_file($path) && !class_exists($class)) {
        include($path);
    } else {
        die("The file, {$class}, could not be found.");
    }

    // if(file_exists($path)) {
    //     include($path);
    // } else {
    //     die("The file {$class}.php was not found.");
    // }
}

spl_autoload_register('classAutoLoad');
?>