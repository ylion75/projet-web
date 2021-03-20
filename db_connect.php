<?php
try{
    $db = new \PDO("mysql:host={$config["database"]["host"]};
                   dbname={$config["database"]["dbname"]};
                   port={$config["database"]["port"]};
                   charset=utf8mb4", 
                   $config["database"]["user"], 
                   $config["database"]["password"], 
                   [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
}catch(\PDOException $e){
    echo "erreur lors de la connexion à la base";
}