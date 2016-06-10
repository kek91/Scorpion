<?php

include_once(SCORPION_DIR_ROOT.'core/users.php');

/**
 * Description of User
 *
 * @author kek
 */
class User
{
    private $userList;
    private $userData;
    private $sessionName;
    private $loggedIn = false;

    public function __construct($user = null)
    {
        $this->userList    = (array)$GLOBALS['CONFIG']['SCORPION_USERS'];
        $this->sessionName = (string)SCORPION_SESSION;
        
        if(!$user) {
            if(Session::exists($this->sessionName)) {
                $user = Session::get($this->sessionName);
                if($this->find($user)) {
                    $this->loggedIn = true;
                }
            }
        }
        else {
            $this->find($user);
        }
    }
    
    private function find($user)
    {
        if($user) {
            if(strpos($user, "@")) {
                $field = 'email';
            }
            else {
                $field = 'username';
            }
            foreach($this->userList as $user_array) {
                if($user_array[$field] == $user) {
                    $this->userData = $user_array;
                    return true;
                }
                return false;
            }
        }
        return false;
    }
    
    public function login($username = null, $password = null)
    {
        if(!$username && !$password && $this->exists())
        {
            Session::put($this->sessionName, $this->data()->username);
        }
        else
        {
            if($this->find($username))
            {
                if(password_verify($password, $this->data()->password))
                {
                    Session::put($this->sessionName, $this->data()->username);
                    return true;
                }
            }
        }
        return false;
    }
    
    public function exists()
    {
        return (!empty($this->userData)) ? true : false;
    }

    public function logout()
    {
        Session::delete($this->sessionName);
    }

    public function data()
    {
        return (object)$this->userData;
    }

    public function isLoggedIn()
    {
        return $this->loggedIn;
    }
    
}
