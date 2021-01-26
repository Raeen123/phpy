<?php
require_once "../../vendor/autoload.php";

use app\core\App;

$app = new App();
$Snippet = $app->snippet;

$Snippet->select('snippet-test8')->live()->gen(function($res){ return "<b><pre>$res</pre></b>";});
