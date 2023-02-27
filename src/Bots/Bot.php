<?php

/**
 * Class File | src/Bot.php
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
class Bot extends RestClient
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
     * @param array $bot MusicBot File array
     */
    public function __construct($url = 'http://127.0.0.1:8087', $timeout = 8000)
    {
        $this->url = $url;
        $this->timeout = $timeout;
    }

    /**
     * getInfo returns the bot infos
     *
     * @return array bot infos
     */
    public function getInfo()
    {
        return $this->request('/bot/info');
    }

    /**
     * getDefaultBot
     *
     * @return string
     */
    public function getDefaultBot()
    {
        $req = $this->request('/botId');
        return (isset($req['defaultBotId'])) ? $req['defaultBotId'] : null;
    }

    /**
     * getBotLog
     *
     * @return array log
     */
    public function getBotLog()
    {
        return $this->request('/bot/log');
    }

}