<?php
/*
 * Copyright (c) 2021, Danilo Staender <edvnetwork.group@icloud.com>
 *
 * PDX-License-Identifier: BSD-2-Clause
 *
 * @package      EDV_MusicBot
 * @author       Danilo Staender <edvnetwork.group@icloud.com>
 *
 */

namespace EDV_Musicbot;

include('autoload.php');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use EDV_Musicbot\Instances\Instance;
use EDV_Musicbot\Files\File;
use EDV_Musicbot\Folder\Folder;
use EDV_Musicbot\Radios\Radio;
use EDV_Musicbot\Playlists\Playlist;
use EDV_Musicbot\Jobs\Job;
use EDV_Musicbot\Bots\Bot;
use EDV_Musicbot\Users\User;

/**
 * Class API
 *
 * API is the main class which will be used to connect to the MusicBot
 */
class EDV_Musicbot extends RestClient
{

    /**
     * UUID stores the MusicBot Bot UUID
     * @var string
     */
    public $uuid = null;

    /**
     * __construct
     *
     * @param  string  $url      MusicBot Bot URL
     * @param  string  $timeout  HTTP Timeout which is used to perform HTTP API requests
     * @return void
     */
    public function __construct($url = 'http://127.0.0.1:8087', $timeout = 8000)
    {
        $this->url = $url;
        $this->timeout = $timeout;
    }

    static function connect()
    {
        $sb = new EDV_Musicbot(env('SINUSBOT_URL'), 8000);
        return $sb->login(env('SINUSBOT_USER'), env('SINUSBOT_PASSWORD'));
    }

    /**
     * login logs on to the MusicBot and retrieves the token
     *
     * @param string $username MusicBot username
     * @param string $password MusicBot password
     * @param string $uuid     MusicBot Bot UUID
     * @return boolean success
     */
    public function login($username, $password, $uuid = null)
    {
        $this->uuid = !$uuid?$this->getDefaultBot():$uuid;
        $login = $this->request('/bot/login', 'POST', [
            'username' => $username,
            'password' => $password,
            'botId' => $this->uuid,
        ]);
        if ($login != null and isset($login['token'])) {
            $this->token = $login['token'];
        }
        return $login['success'];
    }

    static function createInstance($nickname, $backend)
    {
        return \EDV_Musicbot\Instance::createInstance($nickname, $backend);
    }

}