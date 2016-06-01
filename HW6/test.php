<?php
// set default timezone
date_default_timezone_set('America/Los_Angeles');

// timestamp
$timestamp = 1307595105;

// output
echo date('H:',$timestamp)%12;
echo date('i',$timestamp);

?> 