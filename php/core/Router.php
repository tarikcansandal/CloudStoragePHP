<?php

namespace Core;

class Router
{
   private $routes = [];

   public function add($method, $route, $callback)
   {
      $this->routes[] = [
         'method' => strtoupper($method),
         'route' => trim($route, '/'),
         'callback' => $callback
      ];
   }

   public function dispatch()
   {
      $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
      $requestMethod = $_SERVER['REQUEST_METHOD'];
      $clientIp = $_SERVER['REMOTE_ADDR'];

      global $db;
      global $seo;
      global $header;

      foreach ($this->routes as $route) {
         if ($route['route'] === $requestUri && $route['method'] === $requestMethod) {

            Logger::log("[$clientIp] $requestMethod $requestUri - 200 OK");

            $filePath = dirname(__DIR__) . "/views/" . $route['callback'];

            if (file_exists($filePath)) {
               require $filePath;
               return;
            } else {
               http_response_code(500);
               echo "Can't Find Page File!";
               return;
            }
         }
      }


      http_response_code(404);
      Logger::log("[$clientIp] $requestMethod $requestUri - 404 Not Found");
      echo "404 Not Found";
   }
}
