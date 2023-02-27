<?php

/**
 * Class File | src/Job.php
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
class Job extends RestClient
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
     * @param array $job MusicBot File array
     */
    public function __construct($url = 'http://127.0.0.1:8087', $timeout = 8000)
    {
        $this->url = $url;
        $this->timeout = $timeout;
    }

    /**
     * getJobs
     *
     * @return array
     */
    public function getJobs()
    {
        return $this->request('/bot/jobs');
    }

    /**
     * addJob
     *
     * @param  string  $URL  {YouTube-URL, SoundCloud-URL, Directfile}
     * @return array status
     */
    public function addJob($URL)
    {
        return $this->request('/bot/jobs', 'POST', [
            'url'=>$URL,
        ]);
    }

    /**
     * deleteJob
     *
     * @param string $jobUUID job uuid
     * @return array status
     */
    public function deleteJob($jobUUID)
    {
        return $this->request('/bot/jobs/'.$jobUUID, 'DELETE');
    }

    /**
     * deleteFinishedJobs
     *
     * @return array status
     */
    public function deleteFinishedJobs()
    {
        return $this->request('/bot/jobs', 'DELETE');
    }

}