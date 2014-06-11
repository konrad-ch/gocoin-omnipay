<?php

date_default_timezone_set('UTC');

/**
 * Date utils helper class
 */
class DateUtils
{
  const LOGGER_DATE_TIME_FORMAT          = "Y-m-d H:i:s.u T";
  const MYSQL_DATE_TIME_FORMAT           = "Y-m-d H:i:s";
  const DEFAULT_DATE_TIME_FORMAT         = "Y-m-d h:i A";
  const DEFAULT_DATE_TIME_FORMAT_WITH_TZ = "Y-m-d h:i A T";

  static public function getDateInSeconds($value)
  {
    if (StringUtils::contains($value,'T'))
    {
      $value = substr($value, 0, strpos($value, 'T'));
    }
    if (StringUtils::contains($value,'-'))
    {
      $date = explode('-', $value);
    }
    else if (StringUtils::contains($value,'/'))
    {
      $date = explode('/', $value);
    }
    else
    {
      return $value;
    }
    if (sizeof($date) != 3) { throw new Exception("Invalid date format [$value]"); }
    $first = reset($date);
    //yyyy mm dd
    if (strlen($first) > 2)
    {
      $year = trim($date[0]);
      $month = trim($date[1]);
      $day = trim($date[2]);
    }
    else
    {
      $month = trim($date[0]);
      $day = trim($date[1]);
      $year = trim($date[2]);
    }
    $date = "{$year}-{$month}-{$day}";
    return date('U',strtotime($date));
  }

  /**
   * @return the current timestamp
   */
  static public function getCurrentTimestamp()
  {
    $now = date(self::MYSQL_DATE_TIME_FORMAT);
    return $now;
  }

  static public function getDefaultOutputFormat()
  {
    return self::DEFAULT_DATE_TIME_FORMAT_WITH_TZ;
  }

  static public function getDefaultTimeZone()
  {
    return 'America/New_York';
  }

  static public function getLocalTimestampFromMySql($timestamp=NULL, $input_timezone=NULL, $output_timezone=NULL)
  {
    return self::getLocalTimestamp($timestamp,$output_timezone,NULL,$input_timezone,NULL);
  }

  static public function getLocalTimestamp($timestamp=NULL, $output_timezone=NULL, $output_format=NULL,
    $input_timezone=NULL, $input_format=NULL)
  {
    if (empty($output_format))  { $output_format = self::getDefaultOutputFormat(); }
    if (empty($timestamp))
    {
      if (!empty($input_format))      { $timestamp = date($input_format, strtotime('now')); }
      elseif (!empty($output_format))
      {
        $timestamp = new DateTime('now');
        $timestamp = $timestamp -> format($output_format);
      }
      else                            { $timestamp = new DateTime('now'); }
    }

    //default output time zone
    if ($output_timezone == NULL) { $output_timezone = self::getDefaultTimeZone(); }

    $input_tz = NULL;
    if ($input_timezone != NULL) { $input_timezone = new DateTimeZone($input_timezone); }

    if (is_subclass_of($timestamp, 'DateTime'))
    {
      $date_time = $timestamp;
    }
    else
    {
      if (!empty($input_format) && !empty($input_timezone))
      {
        $date_time = DateTime::createFromFormat(
          $input_format, $timestamp, $input_tz
        );
      }
      else if (is_int($timestamp))
      {
        $date_time = new DateTime('@'.$timestamp,$input_tz);
      }
      else
      {
        $date_time = new DateTime($timestamp,$input_tz);
      }
    }

    $local_date = $date_time;
    $local_date -> setTimeZone(new DateTimeZone($output_timezone));

    return $local_date -> format($output_format);
  }
}
