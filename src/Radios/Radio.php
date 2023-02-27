<?php

/**
 * Class File | src/Radio.php
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
class Radio extends RestClient
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
     * @param array $radio MusicBot File array
     */
    public function __construct($url = 'http://127.0.0.1:8087', $timeout = 8000)
    {
        $this->url = $url;
        $this->timeout = $timeout;
    }

    /**
     * getRadioStations returns the imported radio stations
     *
     * @param string $search optional name of the search query
     * @return array radio stations
     */
    public function getRadioStations($search = "")
    {
        return $this->request('/bot/stations?q=' . urlencode($search));
    }

    /**
     * addURL
     *
     * @param string $url stream URL
     * @param string $title track title
     * @param string $parent subfolder UUID, empty value means root folder
     * @return array status
     */
    public function addURL($url, $title, $parent = "")
    {
        return $this->request('/bot/url', 'POST', [
            "url" => $url,
            "title" => $title,
            "parent" => $parent,
        ]);
    }

}