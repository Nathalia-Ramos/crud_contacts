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

            //verifica se os campos full_name, mail existe e não estão vazios
            if(!isset($data['full_name']) || empty($data['full_name'])) {
                $response
                    ->withStatus(400)
                    ->withHeader('Content-Type', 'application/json')
                    ->getBody()
                    ->write(json_encode(['error' => 'O campos full_name é obrigatório e não pode ser vazios.']));

                return $response;
            }

            if(!isset($data['mail']) || empty($data['mail'])) {
                $response
                    ->withStatus(400)
                    ->withHeader('Content-Type', 'application/json')
                    ->getBody()
                    ->write(json_encode(['error' => 'O campos mail é obrigatório e não pode ser vazios.']));

                return $response;
            }

            if(!isset($data['phone']) || !isset($data['cellphone'])) {
                $response
                    ->withStatus(400)
                    ->withHeader('Content-Type', 'application/json')
                    ->getBody()
                    ->write(json_encode(['error' => 'Informar ao menos um telefone para contato.']));

                return $response;
            }

            $contact = new Contacts();

            //verifica se existe o mail, phone ou telefone cadastrado
            if(isset($data['mail'])){
                $mailExistVerify = $contact->getContactByMail($data['mail']);
                if($mailExistVerify) {
                    $response
                    ->withStatus(409)
                    ->withHeader('Content-Type', 'application/json')
                    ->getBody()
                    ->write(json_encode(['message' => 'O email existe em nosso sistema.']));

                    return  $response;
                }
            }

            if(isset($data['phone'])){
                if (strlen($data['phone']) > 10) {
                    $response
                        ->withStatus(400)
                        ->withHeader('Content-Type', 'application/json')
                        ->getBody()
                        ->write(json_encode(['error' => 'Informe um número de telefone válido.'], JSON_UNESCAPED_UNICODE)); //verificar se o JSON_UNESCAPED_UNICODE é algo válido
                    
                    return $response;
                }

                $phoneExistVerify = $contact->getContactByPhone($data['phone']);
                
                if($phoneExistVerify) {
                    $response
                    ->withStatus(409)
                    ->withHeader('Content-Type', 'application/json')
                    ->getBody()
                    ->write(json_encode(['message' => 'O phone informado existe em nosso sistema.']));

                    return  $response;
                }
            }

            if(isset($data['cellphone'])){
                if (strlen($data['cellphone']) > 11) {
                    $response
                        ->withStatus(400)
                        ->withHeader('Content-Type', 'application/json')
                        ->getBody()
                        ->write(json_encode(['error' => 'Informe um número de celular válido.'], JSON_UNESCAPED_UNICODE));
                    
                    return $response;
                }

                $cellphoneExistVerify = $contact->getContactByCellPhone($data['cellphone']);
                
                if($cellphoneExistVerify) {
                    $response
                    ->withStatus(409)
                    ->withHeader('Content-Type', 'application/json')
                    ->getBody()
                    ->write(json_encode(['message' => 'O cellphone informado existe em nosso sistema.']));

                    return  $response;
                }
            }

            $contact->createContact(
                $data['full_name'],
                $data['birthday'],
                $data['mail'],
                $data['occupation'],
                $data['phone'],
                $data['cellphone'],
                $data['have_whatsapp'],
                $data['send_mail_permission'],
                $data['send_sms_permission']
            );

            $response
                ->withStatus(201)
                ->withHeader('Content-Type', 'application/json')
                ->getBody()
                ->write(json_encode(['message' => 'Contato criado com sucesso']));

            return $response;

        } catch (Exception $e) {
            var_dump($e);
            $response
                ->withStatus(500)
                ->withHeader('Content-Type', 'application/json')
                ->getBody()
                ->write(json_encode(['error' => 'Erro interno no servidor']));

            return $response;
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