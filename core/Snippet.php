<?php

namespace app\core;

class Snippet
{
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
        return shell_exec('python -c "'.$code_result.'"');
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
        return shell_exec("python $path 2>&1");
    }
    public function line($line)
    {
        echo  (string) $line . "  \x0D";
    }
    public function require($name)
    {
        return shell_exec('python ' . $this->path($name) . " 2>&1");
    }
}
