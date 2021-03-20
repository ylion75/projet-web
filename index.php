<?php
session_start();
require("config.php");
require("db_connect.php");
require("header.php");

function uri($path){
    global $config;
    return $config["uri_prefix"].$path;
}

$path = explode("?", basename($_SERVER['REQUEST_URI']));

if(!isset($config["routes"][$path[0]])){
    include($config["routes"][""].".php");
}else{
    include($config["routes"][$path[0]].".php");
}
require("footer.php");
