<?php

namespace App\Models;

use RedBeanPHP\R;

class User {

    function __construct() {
    }

    public function getUsers() {

    }

    public function getUserById($id) {
        $r = array();
        return $r;
    }

    /**
     * @param Array $data
     * ['name','fullname','password']
     * @return string
     */
    public function insertUser($data)
    {
        $user = R::dispense('user');
        $user->name = $data['name'];
        $user->fullname = $data['fullname'];
        $user->hash = password_hash($data['password'] , PASSWORD_DEFAULT);
        $id = R::store($user);
        return $id;
    }

    /**
     * Update a user.
     * @param Array $data
     * ['name','fullname','password']
     * @return string
     * @throws \Exception
     */
    public function updateUser($data)
    {
        if(empty($data['name'])){
            throw new \Exception('need a user name to update');
        }
        $user = R::findOne('user',' name = ? ', [ $data['name'] ] );
        if(!empty($user)){
            $user->name = $data['name'];
            $user->fullname = $data['fullname'];
            if(!empty($data['password'])){
                $user->hash = password_hash($data['password'] , PASSWORD_DEFAULT);
            }
            R::store($user);
        }
    }
}