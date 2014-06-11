<?php

/**
 * Functions for easier string maniuplation
 */
class StringUtils
{
  static function contains($haystack, $needle)
  {
    return strpos($haystack, $needle) !== FALSE;
  }
  static function startsWith($haystack, $needle)
  {
    return $needle === "" || strpos($haystack, $needle) === 0;
  }
  static function endsWith($haystack, $needle)
  {
    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
  }
}