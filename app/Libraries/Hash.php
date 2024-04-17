<?php

namespace App\Libraries;
class Hash
{
    public static function encrypt($password){

        return password_hash($password,PASSWORD_DEFAULT);
    }


    public static function checkEncypt($a,$b){

        if(password_verify($a,$b)){
            return true;
        }
        
        return false;
        
        
    }



}


?>