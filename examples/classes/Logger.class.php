<?php

/**
 * A class to do logging for easier tracing of things
 */
class Logger
{
  //logging constants
  const ERROR   = 10;   //'[ERROR]:'
  const WARNING = 20;   //'[WARNING]:'
  const INFO    = 30;   //'[INFO]:'
  const DEBUG   = 40;   //'[DEBUG]:'
  const TRACE   = 50;   //'[TRACE]:'

  /** debug level */
  //static private $_level = self::ERROR;
  static private $_level = self::DEBUG;

  static public function init()
  {
  }

  /**
   * @return the default log directory
   */
  static public function getDefaultLogDir()
  {
    return __DIR__ . '/../log/';
  }

  /**
   * @return the current timestamp
   */
  static public function getTimestamp()
  {
    $t = microtime(true);
    $micro = sprintf("%06d",($t - floor($t)) * 1000000);
    $d = new DateTime( date('Y-m-d H:i:s.'.$micro,$t) );
    $d -> setTimeZone(new DateTimeZone(DateUtils::getDefaultTimeZone()));
    return $d -> format(DateUtils::LOGGER_DATE_TIME_FORMAT);
  }

  /**
   * @return a log level string
   */
  static public function getLogLevel($level)
  {
    if (empty($level))      { return self::getLogLevel(self::$_level); }
    else if ($level === 10) { return '[ERROR]:'; }
    else if ($level === 20) { return '[WARNING]:'; }
    else if ($level === 30) { return '[INFO]:'; }
    else if ($level === 40) { return '[DEBUG]:'; }
    else if ($level === 50) { return '[TRACE]:'; }
    else                    { return '[UNKNOWN]:'; }
  }

  /**
   * set the log level given a log level string
   */
  static public function setLogLevel($level)
  {
    if (strpos($level,'ERROR') !== FALSE)         { self::$_level = 10; }
    else if (strpos($level,'WARNING') !== FALSE)  { self::$_level = 20; }
    else if (strpos($level,'INFO') !== FALSE)     { self::$_level = 30; }
    else if (strpos($level,'DEBUG') !== FALSE)    { self::$_level = 40; }
    else if (strpos($level,'TRACE') !== FALSE)    { self::$_level = 50; }
    else                                          { self::$_level = 10; }
  }

  /**
   * @return a log file
   */
  static public function getLogFile($dir=NULL, $filename)
  {
    if ($dir == NULL) { $dir = self::getDefaultLogDir(); }
    //automatically create the directory (with full write permissions) if it doesnt exist
    if (!is_dir($dir))
    {
      $oldumask = umask(0);
      mkdir($dir, 0777, TRUE);
      umask($oldumask);
    }
    return $dir . $filename;
  }

  /**
   * return a boolean if the current level is greater than or equal to the given level
   */
  static public function isLogLevel($level)
  {
    //$current_level = self::$_level;
    //echo "\n[DEBUG]: CHECKING LOG LEVEL [$current_level][$level]\n";
    return self::$_level >= $level;
  }

  /**
   * dump an object
   */
  static public function dump($filename, $level, $desc, $object)
  {
    ob_start();
    var_dump($object);
    $result = ob_get_clean();
    self::log($filename, $level, '=== ' . $desc . ' ===');
    self::log($filename, $level, $result);
  }

  /**
   * log a message
   */
  static public function log($filename, $level, $msg)
  {
    self::logRaw($filename, $level, $msg . "\n");
  }

  /**
   * log a message
   */
  static public function logRaw($filename, $level, $msg)
  {
    if (self::isLogLevel($level))
    {
      if ($filename != NULL && !empty($msg))
      {
        $file = self::getLogFile(NULL,$filename);
        if (!file_exists($file))  { $exists = FALSE; }
        else                      { $exists = TRUE; }
        file_put_contents(
            $file, self::getTimestamp() . ' - ' . self::getLogLevel($level) . ' ' . $msg, (FILE_APPEND | LOCK_EX)
        );
        if (!$exists)
        {
          chmod($file, 0777); // octal full read/write/execute; correct value of mode
        }
      }
    }
  }
}
Logger::init();