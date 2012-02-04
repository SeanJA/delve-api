<?php

include 'config.php';
$d = new delve_status();
$d->access_key = ACCESS_KEY;
$d->secret = SECRET;
$d->org_id = ORG_ID;

$status = $d->check();

var_dump($status);