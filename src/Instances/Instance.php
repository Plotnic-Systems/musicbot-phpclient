<?php

/**
 * Class File | src/Instance.php
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
class Instance extends RestClient
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
     * @param array $instance MusicBot File array
     */
    public function __construct($url = '', $timeout = 8000)
    {
        $sb = EDV_Musicbot::connect();
    }

    /**
     * getInstances
     *
     * @return []Instance
     * @api
     */
    public function getInstances()
    {
        $instances = $this->request('/bot/instances');
        $out = [];
        foreach ($instances as $instance) {
            array_push($out, new \MusicBot\Instance($this, $instance));
        }
        return $out;
    }

    /**
     * createInstance
     *
     * @param string $nickname Name of the Bot
     * @param string $backend MusicBot backend (Discord or TS³)
     * @return array status
     */
    public function createInstance($nickname = "MusicBot", $backend = "ts3")
    {
        $resp = $this->request('/bot/instances', 'POST', [
            "backend" => $backend,
            "nick" => $nickname,
        ]);
        return $this->getInstanceByUUID($resp['uuid']);
    }

    /**
     * getInstanceByUUID
     *
     * @param string $uuid MusicBot instance UUID
     * @return Instance
     */
    public function getInstanceByUUID($uuid)
    {
        $instance = $this->request("/bot/i/" . $uuid . "/settings");
        $instance['uuid'] = $uuid;
        return new Instance($this, $instance);
    }

}