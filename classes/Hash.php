<?php
class Hash
{
    public static function make($string)
    {
        return password_hash($string, PASSWORD_DEFAULT);
    }

    // The salt method is no longer needed because password_hash() makes it automatically.
    // See http://php.net/manual/en/function.password-hash.php for more information.

    /* 
    public static function salt($length)
    {
            return mcrypt_create_iv($length);
    }
    */

    public static function unique()
    {
        return self::make(uniqid);
    }

}