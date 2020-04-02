<?php

namespace App\Services;

use App\Interfaces\AuthenticationInterface;
use App\Interfaces\AuthorizationInterface;

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

    /** @var AuthorizationInterface */
    private $authenticationStrategy;

    public function __construct(AuthenticationInterface $authenticationStrategy, string $owner = null, string $repository = null)
    {
        $this->client = new \Github\Client();
        $this->authenticationStrategy = $authenticationStrategy;
        $this->authenticationStrategy->authenticate($this->client);
        $this->owner = $owner;
        $this->repository = $repository;
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
