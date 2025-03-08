<?php

namespace Core;

use \PDO;
use \PDOException;

class Database
{
   private $pdo;
   private $requestUri;
   private $requestMethod;
   private $clientIp;

   public function __construct()
   {
      try {
         $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
         $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
         $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
         die("Veritabanı bağlantı hatası: " . $e->getMessage());
      }

      $this->requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
      $this->requestMethod = $_SERVER['REQUEST_METHOD'];
      $this->clientIp = $_SERVER['REMOTE_ADDR'];
   }

   public function insert($table, $params)
   {
      $columns = implode(", ", array_keys($params));
      $placeholders = ":" . implode(", :", array_keys($params));

      $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
      $stmt = $this->pdo->prepare($sql);

      foreach ($params as $key => $value) {
         $stmt->bindValue(":$key", $value);
      }

      Logger::dbLog("[$this->clientIp] $this->requestMethod $this->requestUri - 200 OK - " . htmlspecialchars($sql) . " - " . json_encode($params));

      return $stmt->execute();
   }

   public function fetchAll($sql, $params = [])
   {
      $stmt = $this->pdo->prepare($sql);

      foreach ($params as $key => $value) {
         $stmt->bindValue($key, $value);
      }

      $stmt->execute();

      Logger::dbLog("[$this->clientIp] $this->requestMethod $this->requestUri - 200 OK - " . htmlspecialchars($sql) . " - " . json_encode($params));

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   public function fetch($sql, $params = [])
   {
      $stmt = $this->pdo->prepare($sql);

      foreach ($params as $key => $value) {
         $stmt->bindValue($key, $value);
      }

      $stmt->execute();

      Logger::dbLog("[$this->clientIp] $this->requestMethod $this->requestUri - 200 OK - " . htmlspecialchars($sql) . " - " . json_encode($params));

      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   public function update($sql, $params = [])
   {
      $stmt = $this->pdo->prepare($sql);

      foreach ($params as $key => $value) {
         $stmt->bindValue($key, $value);
      }

      return $stmt->execute();
   }

   public function delete($sql, $params = [])
   {
      $stmt = $this->pdo->prepare($sql);

      foreach ($params as $key => $value) {
         $stmt->bindValue($key, $value);
      }

      Logger::dbLog("[$this->clientIp] $this->requestMethod $this->requestUri - 200 OK - " . htmlspecialchars($sql) . " - " . json_encode($params));

      return $stmt->execute();
   }

   public function getPdo()
   {
      return $this->pdo;
   }
}
