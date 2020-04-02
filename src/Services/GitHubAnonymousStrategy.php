<?php

namespace App\Services;

use App\Interfaces\AuthenticationInterface;
use Github\Client;

class GitHubAnonymousStrategy implements AuthenticationInterface
{
    public function authenticate(Client $client)
    {

        return true;
    }
}
