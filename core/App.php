<?php

namespace app\core;

class App
{
    public Python $python;
    public Snippet $snippet;
    public live $live;
    public function __construct()
    {
        $this->python = new Python();
        $this->snippet = new Snippet();
        $this->live = new live();
    }
    public function img(string $output, string $type, bool $show = false, array $style = null)
    {
        $styles = null;
        if (!is_null($style) && $show) {
            foreach ($style as $key => $value) {
                $styles .= "$key : $value;";
            }
        }
        $res = substr($output, 2, -1);
        if ($show) {
            echo "<img src='data:image/$type;base64,$res' style='$styles' >";
        }
        return "data:image/" . $type . ";base64," . $res;
    }
    public function path($dir, $path)
    {
        $local_path = explode('/', $path);
        $dir_path = explode("\\", $dir);

        $back = null;
        if (isset(array_count_values($local_path)['..'])) {
            $back = array_count_values($local_path)['..'];
        } else {
            $back = 0;
        }

        $result_local = null;
        $result_dir = null;
        foreach ($local_path as $key => $value) {
            if ($local_path[$key] < $back) {
                continue;
            }
            if (!is_dir($path)) {
                if ($key + 1 == count($local_path)) {
                    $result_local .= $value;
                } else {
                    $result_local .= $value . "/";
                }
            } else {
                $result_local .= $value . "/";
            }
        }
        foreach ($dir_path as $key => $value) {
            if ($key < (count($dir_path) - $back)) {
                $result_dir .= $value . "/";
            }
        }
        return $result_dir . $result_local;
    }
    public function ini()
    {
        @ini_set("output_buffering", "Off");
        @ini_set('implicit_flush', 1);
        @ini_set('zlib.output_compression', 0);
        @ini_set('max_execution_time', 1200);
        header('Content-type: text/html; charset=utf-8');
    }
}
