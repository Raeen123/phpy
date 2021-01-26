<?php
require_once "../vendor/autoload.php";

use app\core\App;

$app = new App();
$Snippet = $app->snippet;
$Snippet->set(
    "import subprocess as sub; sub.call('ping |&site|') ",function($site){ $site = "google.com"; return [$site];}
)->live()->ini(3)->gen();
