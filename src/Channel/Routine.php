<?php

namespace Channel;

class Routine 
{

    public function __construct() {
        pcntl_signal(SIGCHLD, SIG_IGN);
    }

    public function go() {
        if (pcntl_fork()) {
            // Parent process
            return;
        } else {
            // Child: fire and forget
            $args = func_get_args();
            $f = array_shift($args);
            call_user_func_array($f, $args);

            exit;
        }
    }
}
