<?php

namespace app\core;

class Snippet
{
    public Python $python;
    public function path($name)
    {
        return str_replace('core\\', '', __DIR__ . '\Python\include/' . $name . '.py');
    }
    public function start(string $name)
    {
        ob_start();
    }
    public function gen($code, $fun = null)
    {
        $code = (string) $code;
        if (is_object($fun)) {
            $prams = explode('|', $code);
            $all_prams = array();
            for ($i = 0; $i < count($prams); $i++) {
                if ($prams[$i][0] == '&') {
                    array_push($all_prams, $prams[$i]);
                }
            }
            $code_res = call_user_func_array($fun, $all_prams);
            if (!is_array($code_res)) {
                die("You must return array");
            }
            $o = 0;
            foreach ($prams as $key => $value) {
                if ($value[0] == '&') {
                    $prams[$key] = $code_res[$o];
                    $o++;
                }
            }
            $code_result = implode("", $prams);
        } else {
            $code_result = $code;
        }
        return shell_exec(Python::python_path . ' -c "' . $code_result . '"');
    }
    public function gen_live($code, $time, $read,  object $fun = null, object $result_controller = null)
    {
        $code = (string) $code;
        if (is_object($fun)) {
            $prams = explode('|', $code);
            $all_prams = array();
            for ($i = 0; $i < count($prams); $i++) {
                if ($prams[$i][0] == '&') {
                    array_push($all_prams, $prams[$i]);
                }
            }
            $code_res = call_user_func_array($fun, $all_prams);
            if (!is_array($code_res)) {
                die("You must return array");
            }
            $o = 0;
            foreach ($prams as $key => $value) {
                if ($value[0] == '&') {
                    $prams[$key] = $code_res[$o];
                    $o++;
                }
            }
            $code_result = implode("", $prams);
        } else {
            $code_result = $code;
        }
        $command = Python::python_path . ' -c "' . $code_result . '"' . " 2>&1";
        $pid = popen($command, "r");
        if (is_object($result_controller)) {
            while (!feof($pid)) {
                $res = fread($pid, $read);
                $return = call_user_func($result_controller, $res);
                echo $return;
                flush();
                ob_flush();
                sleep($time);
            }
        } else {
            while (!feof($pid)) {
                $res = fread($pid, $read);
                echo $res;
                flush();
                ob_flush();
                sleep($time);
            }
        }

        pclose($pid);
    }
    public function end(string $name, bool $save_last = false)
    {
        $codes = ob_get_clean();
        $path = $this->path($name);
        $metod = ($save_last) ? 'a' : 'w';
        $file = fopen($path, $metod);
        if (!$save_last) {
            if (file_get_contents($path) != $codes) {
                fwrite($file, (string) $codes);
            }
            fclose($file);
        } else {
            $file = fopen($path, $metod);
            fwrite($file, (string) $codes);
            fclose($file);
        }
        return shell_exec(Python::python_path . " $path 2>&1");
    }
    public function line($line)
    {
        echo  (string) $line . "  \x0D";
    }
    public function require($name)
    {
        return shell_exec(Python::python_path . $this->path($name) . " 2>&1");
    }
    public function require_live(string $name, $time, int $read, object $fun)
    {
        $command = Python::python_path . " " . $this->path($name) . " 2>&1";
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
}
