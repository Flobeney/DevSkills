<?php
require 'functPHP/functions.php';

echo "TEST<br>";
$motDePasse = "super";
$motDePasse = hash('sha256', (SALT . $motDePasse));
echo "$motDePasse";
