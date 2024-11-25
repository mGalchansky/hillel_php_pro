<?php
require_once __DIR__ . '/vendor/autoload.php';
use Classes\Logger;
use Classes\DeliverySMS;
use Classes\DeliveryConsole;
use Classes\DeliveryEmail;
use Classes\FormatRaw;
use Classes\FormatWithDate;
use Classes\FormatWithDateAndDetails;

$formater = new FormatRaw();
$deliver = new DeliverySMS();
$logger = new Logger($formater, $deliver);
$logger->log('Emergency error! Please fix me!');

$formater1 = new FormatWithDate();
$deliver1 = new DeliveryEmail();
$logger1 = new Logger($formater1, $deliver1);
$logger1->log('New log entry!');

$formater2 = new FormatWithDateAndDetails();
$deliver2 = new DeliveryConsole();
$logger2 = new Logger($formater2, $deliver2);
$logger2->log('Another log entry!');