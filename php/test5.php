<?php
require_once "../vendor/autoload.php";

use app\core\App;

$app = new App();
$python = $app->python;
$Snippet = $app->snippet;

$Snippet->start('snippet-test5');

$Snippet->line('print("hello world")');
$Snippet->line('print("hello Raeen")');

$Snippet->end('snippet-test5');

echo $Snippet->require('snippet-test5');
