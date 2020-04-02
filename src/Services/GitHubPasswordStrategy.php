<?php

namespace App\Services;

use App\Interfaces\AuthenticationInterface;
use Github\Client;

class GitHubPasswordStrategy implements AuthenticationInterface
{
    /** @var string  */
    private $login;

    /** @var string  */
    private $password;

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function authenticate(Client $client)
    {
        $client->authenticate($this->login, $this->password, Client::AUTH_HTTP_PASSWORD);

        return true;
    }
}
