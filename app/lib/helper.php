<?php
namespace lib;
trait helper
{
    public function redirect($path)
    {
        session_write_close();
        header('Location: ' . $path);
        exit();
    }
    public function refresh($time,$path)
    {
        session_write_close();
        header("REFRESH:".$time.";URL=".$path);
        exit();
    }
    public function hashPass($pass)
    {
        return sha1($pass);
    }
}