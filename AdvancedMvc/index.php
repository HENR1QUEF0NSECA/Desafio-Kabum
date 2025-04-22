<?php
$autoload = function ($class) {
    $class = str_replace("\\", "/", $class);

    if (file_exists($class . ".php")) {
        include($class . ".php");
    } else {
        die("Não foi possível carregar a classe: " . $class);
    }
};

spl_autoload_register($autoload);

$application = new Application();
$application->run();
