<?php
session_start();
require_once("/db_connect.php");

include("/header.php");

$routes = require("routes.php");

$uri = explode("/", $_SERVER['REQUEST_URI']);
if(!isset($routes[$uri[0]])){
    include("/notfound.php");
}
include($routes[$uri]);
















include("/footer.php");