<?php


namespace App\Services;

use http\Client;

class GitHubService
{

    private $githubOwner;
    private $repo;

    public function __construct(string $githubOwner, string $repo)
    {
        $this->githubOwner = $githubOwner;
        $this->repo = $repo;
    }

    public function getIssuesByStatusForMilestone(string $status, int $mileStoneNumber)
    {
        $client = new \Github\Client();
        return $client->api('issue')->all($this->githubOwner , $this->repo  , array('milestone' => $mileStoneNumber , 'state' => $status));
    }

    public function getAllMilestones()
    {
        $client = new \Github\Client();
        return $client->api('issue')->milestones()->all( $this->githubOwner, $this->repo , ['state' => 'all']);
    }
}
