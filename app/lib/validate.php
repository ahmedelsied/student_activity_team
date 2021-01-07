<?php
namespace lib;
trait validate
{
    protected function emailValidate($email)
    {
        $parms;
        $validEmail = filter_var($email,FILTER_VALIDATE_EMAIL);
        if(strcmp($validEmail,$email) !== 0){
            $parms = [true,'danger'];
        }else{
            $parms = [false,'success'];
        }
        return $parms;
    }
    protected function inputStringValidate($string,$minlength,$maxLength)
    {
        if(strlen($string) > $minlength){
            return true;
        }elseif(strlen($string) > $maxLength){
            return false;
        }else{
            return false;
        }
    }
}