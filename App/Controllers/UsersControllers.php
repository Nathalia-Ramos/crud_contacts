<?php

namespace App\Controllers;

use App\Database\LojasDao;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

final class UsersControllers  {
    public function getUsers(Request $request, Response $response, array $args): Response {
        
        $store = new LojasDao();

        $store->getStore();
        
        return $response;
    }
}