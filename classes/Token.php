<?php
class Token
{
    public static function generate()
    {
        return Session::put(SCORPION_TOKEN, md5(uniqid()));
    }

    public static function check($token)
    {
        $tokenName = SCORPION_TOKEN;

        if(Session::exists($tokenName) && $token === Session::get($tokenName))
        {
            Session::delete($tokenName);
            return true;
        }

        return false;
    }
}