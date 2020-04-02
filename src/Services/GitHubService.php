<?php

namespace App\Services;

class GitHubService
{

    CONST STATUS_OPENED_ISSUES = 'open';
    CONST STATUS_CLOSED_ISSUES = 'closed';

    /** @var string */
    private $owner;

    /** @var string */
    private $repository;

    /** @var \Github\Client */
    private $client;

    public function __construct()
    {
        $this->client = new \Github\Client();
    }

    public function getIssuesByStatusForMilestone(string $status, int $mileStoneNumber)
    {
        return $this->client->api('issue')->all($this->owner , $this->repository  , array('milestone' => $mileStoneNumber , 'state' => $status));
    }

    public function getAllMilestones()
    {
        return $this->client->api('issue')->milestones()->all( $this->owner, $this->repository , ['state' => 'all']);
    }

    public function setGithubOwner(string $owner)
    {
        $this->owner = $owner;
    }

    public function setRepository(string $repository)
    {
        $this->repository = $repository;
    }
}
