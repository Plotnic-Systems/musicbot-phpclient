<?php

/**
 * Class File | src/User.php
 *
 * A single File with it's available actions
 *
 * @package      EDV_MusicBot
 * @author       Danilo Staender <edvnetwork.group@icloud.com>
 */

namespace EDV_Musicbot;

/**
 * Class File
 *
 * File represents a single File of the MusicBot
 */
class User extends RestClient
{
    /**
     * UUID holds the File UUID
     * @var array
     */
    public $uuid = null;

    /**
     * __construct
     *
     * @param API $api MusicBot API
     * @param array $user MusicBot File array
     */
    public function __construct($url = 'http://127.0.0.1:8087', $timeout = 8000)
    {
        $this->url = $url;
        $this->timeout = $timeout;
    }

    /**
     * getUsers
     *
     * @return User[] users
     */
    public function getUsers()
    {
        $users = $this->request('/bot/users');
        $out = [];
        foreach ($users as $user) {
            array_push($out, new User($this, $user));
        }
        return $out;
    }

    /**
     * addUser
     *
     * @param string $username Username
     * @param string $password Password
     * @param integer $privileges Bitmask-Value
     * @return User user object
     */
    public function addUser($username, $password, $privileges = 0)
    {
        $this->request('/bot/users', 'POST', [
            'username' => $username,
            'password' => $password,
            'privileges' => $privileges,
        ]);
        $users = $this->getUsers();
        foreach ($users as $user) {
            if ($user->getName() === $username) {
                return $user;
            }
        }
    }

    /**
     * getUserByUUID
     *
     * @param string $uuid User ID
     * @return User user object
     */
    public function getUserByUUID($uuid)
    {
        $users = $this->getUsers();
        foreach ($users as $user) {
            if ($user->getUUID() === $uuid) {
                return $user;
            }
        }
    }

    /**
     * getUserByName
     *
     * @param string $username Username
     * @return User user object
     */
    public function getUserByName($username)
    {
        $users = $this->getUsers();
        foreach ($users as $user) {
            if ($user->getName() === $username) {
                return $user;
            }
        }
    }

}