<?php
include_once("xlsxwriter.class.php");
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

$filename  = "example.xlsx";
$starttime = time();
$rows      = array(
    array('2003', '1', '-50.5', '2010-01-01 23:00:00', '2012-12-31 23:00:00'),
    array('2003', '=B1', '23.5', '2010-01-01 00:00:00', '2012-12-31 00:00:00'),
);

$writer = new XLSXWriter();
$writer->setAuthor('Some Author');
foreach ($rows as $row) {
    for ($i = 1; $i <= 1000000; $i++) {
        $writer->writeSheetRow('Sheet1', $row);
    }
}

$writer->writeToFile('example.xlsx');

$endtime = time();

echo '#' . floor((memory_get_peak_usage()) / 1024 / 1024) . "MB" . "\n";
echo '#' . floor((memory_get_usage()) / 1024 / 1024) . "MB" . "\n";
echo "# " . ($endtime - $starttime) . "\n";