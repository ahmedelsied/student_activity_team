<?php
namespace lib;
trait sessionmanger
{
    public static function start()
    {
        session_start();
    }
    public function checkSession($session)
    {
        if(isset($_SESSION[$session])){
            return true;
        }else{
            return false;
        }
    }
    public function setSession($username)
    {
        $_SESSION['username'.sha1(md5('@Ahmed123'))] = $username;
        session_regenerate_id(true);
        return $_SESSION['username'.sha1(md5('@Ahmed123'))];
    }
    public function finishSession()
    {
        session_destroy();
        session_unset();
    }
}