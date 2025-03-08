<?php

require __DIR__ . '/config/Settings.php';

spl_autoload_register(function ($class) {
   if (class_exists($class, false) || in_array($class, get_declared_classes())) {
      return;
   }

   $baseDir = __DIR__ . '/';
   $file = $baseDir . str_replace('\\', '/', $class) . '.php';

   if (file_exists($file)) {
      require_once $file;
   } else {
      die("Autoload Error: $file was not found.");
   }
});
