<?php

include 'config.php';
$d = new delve_channels();
$d->access_key = ACCESS_KEY;
$d->secret = SECRET;
$d->org_id = ORG_ID;

var_dump($d->all());