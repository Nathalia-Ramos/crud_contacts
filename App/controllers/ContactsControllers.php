<?php

namespace App\controllers;

use App\models\Contacts;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

final class ContactsControllers  {
    public function getContacts(Request $request, Response $response, array $args): Response {
        
        $contact = new Contacts();

        $contacts = $contact->getAllContacts();
            
        $response->getBody()->write(json_encode($contacts));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}