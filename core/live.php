<?php

namespace app\core;


class live
{
    public $time = 1;
    private $commad = "";
    public function __construct(string $commad = null)
    {
        $this->commad = $commad;
        return $this;
    }
    public function ini($time = null)
    {
        if (!is_null($time) && 0 < $time) {
            $this->time = $time;
        }
        return $this;
    }
    public function gen(object $controller = null)
    {
        $pid = popen($this->commad, "r");
        while (!feof($pid)) {
            $res = fgets($pid);

            if (!is_null($controller)) {
                $res = call_user_func($controller, $res);
            }

            echo $res;


            flush();
            ob_flush();
            sleep($this->time);
        }
        pclose($pid);
    }
}
