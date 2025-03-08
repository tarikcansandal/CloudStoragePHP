<?php

namespace Core;

class Logger
{
   private static $logFile = 'logs/router.log';
   private static $dblogFile = 'logs/dbLog.log';

   public static function log($message)
   {
      $logDir = dirname(self::$logFile);

      if (!is_dir($logDir)) {
         mkdir($logDir, 0777, true);
      }

      if (!file_exists(self::$logFile)) {
         file_put_contents(self::$logFile, "=== HTTP REQUEST LOGS ===\n", FILE_APPEND);
      }

      $time = date('Y-m-d H:i:s');
      $logEntry = "[$time] $message" . PHP_EOL;

      file_put_contents(self::$logFile, $logEntry, FILE_APPEND);
   }

   public static function dbLog($message)
   {
      $logDir = dirname(self::$dblogFile);

      if (!is_dir($logDir)) {
         mkdir($logDir, 0777, true);
      }

      if (!file_exists(self::$dblogFile)) {
         file_put_contents(self::$dblogFile, "=== DB QUERY LOGS ===\n", FILE_APPEND);
      }

      $time = date('Y-m-d H:i:s');
      $logEntry = "[$time] $message" . PHP_EOL;

      file_put_contents(self::$dblogFile, $logEntry, FILE_APPEND);
   }
}
