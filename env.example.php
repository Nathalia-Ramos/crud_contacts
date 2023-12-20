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