<?php

use function src\slimConfiguration;
use App\Controllers\ContactsControllers;

$app = new \Slim\App(slimConfiguration());

$contactsPath = '/api/contacts';

$app->get($contactsPath, ContactsControllers::class . ':getContacts');
$app->get('/api/contact/{id}', ContactsControllers::class . ':getContactById');
$app->post($contactsPath, ContactsControllers::class . ':createContact');
$app->put($contactsPath . '/{id}', ContactsControllers::class . ':deleteContact');
$app->put('/api/contacts/update/{id}', ContactsControllers::class . ':updateContact');


$app->run();