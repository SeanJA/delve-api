<?php

require 'config.php';

$d = new delve_media();
$d->access_key = ACCESS_KEY;
$d->secret = SECRET;
$d->org_id = ORG_ID;

$result = $d->all();

var_dump($result);