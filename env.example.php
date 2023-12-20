<?php

putenv('DISPLAY_ERRORS_DETAILS=true');

$databaseHost = '';
$databaseName = '';
$databaseUser = '';
$databasePass = '';

putenv("DB_HOST=$databaseHost");
putenv("DB_NAME=$databaseName");
putenv("DB_USER=$databaseUser");
putenv("DB_PASSWORD=$databasePass");

putenv("API_URL=http://127.0.0.1:3000/api/contacts");
