<?php

require_once 'core/init.php';

$surgeon = new Surgeon();
$surgeon->logout();
Redirect::to('index.php');