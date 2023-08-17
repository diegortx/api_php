<?php
# Headers for all responses from api

## For accept all request from any path
header('Access-Control-Allow-Origin: *');
## For all responses as json (default api-rest)
header('Content-type: application/json');

## Define default time as America/Sao_Paulo 
date_default_timezone_set("America/Sao_Paulo");

# Autoload
include_once "classes/Autoload.class.php";
new Autoload();


# Routes
$route = new Routes();

## Routes - Clientes
$route->add("GET", '/clientes/show', 'Clientes::show');
$route->add("GET", '/clientes/show/[param]', 'Clientes::showId');
$route->add("POST", '/clientes/store', 'Clientes::store');
$route->add("PUT", '/clientes/update/[param]', 'Clientes::update');
$route->add("DELETE", '/clientes/delete/[param]', 'Clientes::delete');


$route->go($_GET['path']);