<?php

class User
{
    private $_db,
            $_data,
            $_sessionName,
            $_isLoggedIn = false;

    public function __construct($user = null)
    {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');

        if(!$user)
        {
            if(Session::exists($this->_sessionName))
            {
                $user = Session::get($this->_sessionName);
                if($this->find($user))
                {
                    $this->_isLoggedIn = true;
                }
                else
                {
                    // Log out
                }
            }
        }
        else
        {
            $this->find($user);
        }
    }

    public function update($fields = array(), $id = null)
    {
        if(!$id && $this->isLoggedIn())
        {
            $id = $this->data()->id;
        }

        if(!$this->_db->update(Config::get('tables/users'), $id, 'id', '=', $fields))
        {
            throw new Exception('Error: Could not update database');
        }
        else
            return true;
    }

    public function create($fields = array())
    {
        if(!$this->_db->insert(Config::get('tables/users'), $fields))
        {
            throw new Exception('There was a problem creating an account');
        }
    }

    public function find($user = null)
    {
        if($user)
        {
            if(strpos($user, "@"))
                $field = 'email';
            elseif(is_numeric($user))
                $field = 'id';
            else
                $field = 'username';

            $data = $this->_db->get(Config::get('tables/users'), array($field, '=', $user));

            if($data->count())
            {
                $this->_data = $data->first();
                return true;
            }
            return false;
        }
        return false;
    }

    public function login($username = null, $password = null)
    {
        if(!$username && !$password && $this->exists())
        {
            Session::put($this->_sessionName, $this->data()->id);
        }

        else
        {
            $user = $this->find($username);

            if($user)
            {
                if(password_verify($password, $this->data()->password))
                {
                    Session::put($this->_sessionName, $this->data()->id);
                    return true;
                }
            }
        }
        return false;
    }

    public function hasPermission($key)
    {
        $group = $this->_db->get(Config::get('tables/groups'), array('id', '=', $this->data()->grp));
        if($group->count())
        {
            $permissions = json_decode($group->first()->permissions, true);
            if($permissions[$key])
            {
                return true;
            }
        }
        return false;
    }

    public function listPermissions()
    {
        $group = $this->_db->get(Config::get('tables/groups'), array('id', '=', $this->data()->grp));
        if($group->count())
        {
            $permissions = json_decode($group->first()->permissions, true);
            return $permissions;
        }
        $standardPermissions = '{"admin": 0,"technician": 0,"standard": 1}';
        $standardPermissionsReturn = json_decode($standardPermissions, true);
        return $standardPermissionsReturn;
    }

    public function makeResetHash($userid = null)
    {
        if($this->find($userid))
        {
            if($this->_db->get(Config::get('tables/users_resetpw'), array('userid', '=', $userid)))
            {
                $this->_db->delete(Config::get('tables/users_resetpw'), array('userid', '=', $userid));
            }

            $resetHash = substr(sha1(mt_rand()), 0, 40);

            if($this->_db->insert(Config::get('tables/users_resetpw'), array(
                'userid' => $userid,
                'hash'   => $resetHash)))
            {
                if(mailResetHash($this->_data->email, $this->_data->name, $resetHash, Config::get('tekcms/url')))
                {
                    return true;
                }
                return false;
            }
            return false;
        }
        else
        {
            return false;
        }
    }

    public function exists()
    {
        return (!empty($this->_data)) ? true : false;
    }

    public function logout()
    {
        Session::delete($this->_sessionName);
    }

    public function data()
    {
        return $this->_data;
    }

    public function isLoggedIn()
    {
        return $this->_isLoggedIn;
    }
}