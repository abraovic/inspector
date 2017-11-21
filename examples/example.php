<?php
require_once '../vendor/autoload.php';

use \abraovic\inspector\Inspector;

// print on stdout
Inspector::startTimeInspector();
sleep(5);
Inspector::printTimeAndMemoryStats(true);