<?php

ini_set('display_errors', 1);

header("Content-Type: text/html");

include_once('classes/FileUtils.class.php');
include_once('classes/StringUtils.class.php');

$file = getRequestParam('file');
$tail = getRequestParam('tail');
$customer = getRequestParam('customer');

//get all the files that end with log in the default log directory
$log_files = FileUtils::getFiles('log',NULL,'.log');

if (!empty($file))
{
  $log_file = 'log/' . $file;
  $file_contents = '';
  if (file_exists($log_file)) { $file_contents = file_get_contents($log_file); }
  $lines = preg_split('/\R/', $file_contents);
}

if ($tail=='true') { $lines = array_reverse($lines); }

/**
 * @return a more convenient way to get a request param without seeing errors/warnings
 */
function getRequestParam($key, $default='')
{
  if (array_key_exists($key, $_REQUEST)) { return trim($_REQUEST[$key]); }
  return $default;
}

?>
<html>
  <head>
    <title>Log Viewer</title>
  </head>
  <body style="font-size: 10pt;">
    <div>
      <div>
        <b>Log Files:</b>
      </div>
      <ul>
        <?php foreach($log_files as $log_file) { ?>
        <li><a href="logs.php?file=<?php echo $log_file?>"><?php echo $log_file?></a></li>
        <?php } ?>
      </ul>
    </div>
    <hr/>
    <?php
    if (isset($lines))
    {
      $in_pre = FALSE;
      foreach($lines as $line)
      {
        //support customer filtering
        if (!empty($customer))
        {
          if (!StringUtils::contains($line,"Customer [$customer]")) { continue; }
        }
        if (StringUtils::contains($line,"<pre"))  { $in_pre = TRUE; }
        if (StringUtils::contains($line,"</pre")) { $in_pre = FALSE; }
        if (!$in_pre && !StringUtils::contains($line,"<pre"))
        {
          echo "<pre>" . $line . "</pre>" . "\n";
        }
        else
        {
          echo $line . "\n";
        }
      }
    }
    ?>
  </body>
</html>
