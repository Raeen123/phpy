<?php

namespace app\core;

class Python
{
    const python_path = 'python';
    public function gen()
    {
        $whattogen = func_get_args();
        $file = $whattogen[0];
        unset($whattogen[0]);
        $resultargs = null;
        foreach ($whattogen as $send) {
            $resultargs .= escapeshellarg(json_encode($send)) . " ";
        }
        $command = self::python_path . " " . $file . " " . $resultargs . " 2>&1";
        $cmd_result = shell_exec($command);
        return $cmd_result;
    }
    public function gen_live_show($path, $time, $read, array $args, object $fun)
    {
        $resultargs = null;
        foreach ($args as $send) {
            $resultargs .= escapeshellarg(json_encode($send)) . " ";
        }
        $command = self::python_path . " " . $path . " " . $resultargs . " 2>&1";
        $pid = popen($command, "r");
        while (!feof($pid)) {
            $res = fread($pid, $read);
            $return = call_user_func($fun, $res);
            echo $return;
            flush();
            ob_flush();
            sleep($time);
        }
        pclose($pid);
    }
    public function gen_line()
    {
        $whattogen = func_get_args();
        $file = $whattogen[0];
        unset($whattogen[0]);
        $resultargs = null;
        foreach ($whattogen as $send) {
            $resultargs .= escapeshellarg(json_encode($send)) . " ";
        }
        $command = self::python_path . " " . $file . " " . $resultargs . " 2>&1";
        $cmd_result = exec($command);
        return $cmd_result;
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
    public function dump($data, bool $pre_tag = true)
    {
        $output = json_decode($data);
        if ($pre_tag) {
            echo "<pre>";
            var_dump($output);
            echo "</pre>";
        } else {
            var_dump($output);
        }
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
            $result_local .= $value . "/";
        }
        foreach ($dir_path as $key => $value) {
            if ($key < (count($dir_path) - $back)) {
                $result_dir .= $value . "/";
            }
        }
        return $result_dir . $result_local;
    }
    public function path_file($dir, $path)
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
            if ($key + 1 == count($local_path)) {
                $result_local .= $value;
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
