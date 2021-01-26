<?php

namespace app\core;

require_once "App.php";
class Python
{
    public Snippet $snippet;
    public live $live;
    const python_path = 'python';
    public $command = "";
    public $args = "";
    public function set($path)
    {
        $command = self::python_path . " " . $path . " 2>&1";
        $this->command = $command;
        return $this;
    }
    public function send(...$datas)
    {
        $resultargs = null;
        foreach ($datas as $send) {
            $resultargs .= escapeshellarg(json_encode($send)) . " ";
        }
        $this->args = $resultargs;
        return $this;
    }
    protected function command_config()
    {
       return $this->command." ".$this->args;
    }
    public function gen()
    {
        return shell_exec($this->command_config());
    }
    public function live()
    {
       $this->live = new live($this->command_config());
       return $this->live;
    }
}
