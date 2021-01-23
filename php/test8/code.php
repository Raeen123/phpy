<?php
require_once "../../vendor/autoload.php";

use app\core\App;

$app = new App();
$site = 'google.com';
$Snippet = $app->snippet;

$Snippet->start('snippet-test8');

$Snippet->line('import subprocess as sub');
$Snippet->line("sub.call('ping $site')");

$Snippet->end('snippet-test8');