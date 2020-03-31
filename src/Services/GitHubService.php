<?php


namespace App\Services;

use http\Client;

class GitHubService
{

    private $githubOwner;
    private $repo;
    private $client;

    public function __construct(string $githubOwner, string $repo)
    {
        $this->client = new \Github\Client();
        $this->githubOwner = $githubOwner;
        $this->repo = $repo;
    }

    public function getIssuesByStatusForMilestone(string $status, int $mileStoneNumber)
    {
        return $this->client->api('issue')->all($this->githubOwner , $this->repo  , array('milestone' => $mileStoneNumber , 'state' => $status));
    }

    public function getAllMilestones()
    {
        return $this->client->api('issue')->milestones()->all( $this->githubOwner, $this->repo , ['state' => 'all']);
    }
}
