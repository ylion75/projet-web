<?php
$config["uri_prefix"] = "/projet-web";

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
    "/verify_user" => "verify_user",
    "/account" => "account",
    "/modify_account" => "modify_account",
    "/signup" => "signup",
    "/create_account" => "create_account",
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
