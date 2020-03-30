<?php
define('MAXIMUM_LINE_LENGTH', 100000);
define('CSV_DELIMITER', ',');
$file_path = 'source.csv';
if ($source_file_handle = fopen($file_path, 'r')) {
  // Get CSV header from source file.
  $header = array();
  // Process data per time.
  $data = array();
  // Index for process per time.
  $current_row_index = 0;

  while (($row = fgetcsv($source_file_handle, MAXIMUM_LINE_LENGTH, CSV_DELIMITER)) !== FALSE) {
    // Trim each row before processing.
    $row = array_map('trim', $row);
    // Get CSV header from source file and treat first row as header.
    if (!$header) {
      $header = $row;
    }
    // Processing each row.
    else {
      $data[] = $row[0];
      $current_row_index ++;
    }
  }
  fclose($source_file_handle);
  $output = implode(',', $data);
  $file = 'output.txt';
  file_put_contents($file, $output);
  var_dump($current_row_index);
}
