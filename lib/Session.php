<?php

class Session
{
    public static  function init()
    {
        session_start();
    }
    public static function set($name, $val)
    {
        $_SESSION[$name] = $val;
    }
    public static function get($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return null;
        }
    }
    public static function destroy()
    {
        session_destroy();
    }
}
