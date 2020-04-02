<?php

namespace App\Interfaces;

use Github\Client;

interface AuthenticationInterface{
    public function authenticate(Client $client);
}