<?php

/**
 * File utils helper class
 */
class FileUtils
{
  /**
   * @return an array of files given a directory
   */
  static public function getFiles($dir, $startsWithFilter=NULL, $endsWithFilter=NULL)
  {
    //convenience, turn the filer into an array
    if (!is_array($startsWithFilter) && !empty($startsWithFilter))
    {
      $startsWithFilter = array($startsWithFilter);
    }
    //the resulting files
    $files = array();
    if (file_exists($dir) && $handle = opendir("$dir"))
    {
      //this is the correct way to loop over the directory
      while (($entry = readdir($handle)) !== FALSE)
      {
        if (empty($startsWithFilter) && empty($endsWithFilter))
        {
          array_push($files,$entry);
        }
        else
        {
          //support multiple starts with filters
          foreach((array)$startsWithFilter as $filter)
          {
            if (StringUtils::startsWith($entry,$filter))
            {
              array_push($files,$entry);
              break;
            }
          }
          //support multiple ends with filters
          foreach((array)$endsWithFilter as $filter)
          {
            if (StringUtils::endsWith($entry,$filter))
            {
              array_push($files,$entry);
              break;
            }
          }
        }
      }
      closedir($handle);
    }
    asort($files);
    return $files;
  }
}