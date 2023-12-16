<?php

use function src\slimConfiguration;
use App\Controllers\ContactsControllers;

$app = new \Slim\App(slimConfiguration());

$app->get('/', ContactsControllers::class . ':getContacts');
$app->post('/', ContactsControllers::class . ':createContact' . $contacts);
$app->put('/{id}', ContactsControllers::class . ':deleteContact' . $contacts);

$app->run();