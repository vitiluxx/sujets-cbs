<?php

$motdepasse = "Python66"; // ton mot de passe
$hash = password_hash($motdepasse, PASSWORD_DEFAULT);
echo $hash;

/* COPIE LE HASH GENERER POUR REMPLACER DANS CETTE REQUETTE ET EXECUTE DANS MYSQL

INSERT INTO admin (email_adm, mdp_adm) 
VALUES ('gdc6.td@gmail.com', '$2y$10$gNPRRyZrXufmlwvdXDk3c.rwCs0s26B5HRuPIRbxF54Xx5kt6NV8O'); */
?>


