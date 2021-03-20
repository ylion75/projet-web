<?php
$forums = $db->query("SELECT f.*, c.nom, c.id as categorie_id 
                      FROM forum f 
                        LEFT JOIN categorie c ON f.categorie_id=c.id"
                    )->fetchAll();

render("forums_list", ["forums" => $forums]);