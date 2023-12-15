<?php

namespace App\controllers;

use App\models\Contacts;
use Exception;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

final class ContactsControllers  {

    public function createContact(Request $request, Response $response, array $args): Response {
        try {
            $data = $request->getParsedBody();

            $contact = new Contacts();

            $contact->createContact(
                $data['full_name'],
                $data['date_of_birth'],
                $data['mail'],
                $data['profession'],
                $data['telephone'],
                $data['cellphone'],
                $data['have_whatsapp'],
                $data['send_mail'],
                $data['send_sms']
            );

            $response
                ->withStatus(201)
                ->withHeader('Content-Type', 'application/json')
                ->getBody()
                ->write(json_encode(['message' => 'Contato criado com sucesso']));

            return $response;

        } catch (Exception $e) {
            return $response
                ->withStatus(500)
                ->withHeader('Content-Type', 'application/json')
                ->getBody()
                ->write(json_encode(['error' => 'Erro interno no servidor']));
        }
    }

    public function getContacts(Request $request, Response $response, array $args): Response {
        $contact = new Contacts();
    
        $contacts = $contact->getAllContacts();
    
        if (empty($contacts)) {
            $response
                ->withStatus(404)
                ->withHeader('Content-Type', 'application/json')
                ->getBody()->write(json_encode(['error' => 'Nenhum contato encontrado']));

            return $response;
        }
    
        $response->getBody()->write(json_encode($contacts));
    
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
    
}