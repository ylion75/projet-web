<?php
$config["uri_prefix"] = "/projet-web-Dev";

$config["database"]["host"] = "localhost";
$config["database"]["dbname"] = "reddit";
$config["database"]["port"] = "3306";
$config["database"]["user"] = "root";
$config["database"]["password"] = "";

$config["routes"] = [
    "/" => "home",
    "/home" => "home",
    "/index" => "home",
    "/login" => "login",
    "/account" => "account",
    "/signup" => "signup",
    "/signout" => "signout",
    "/delete_post" => "delete_post",
    "/add_post" => "add_post",
    "/forum" => "forum",
    "/post" => "post",
    "/add_comment" => "add_comment",
    "/likes" => "likes",
    "/dislikes" => "dislikes",
    "/categorie" => "categorie",
    "/page_not_found" => "error404",
];
