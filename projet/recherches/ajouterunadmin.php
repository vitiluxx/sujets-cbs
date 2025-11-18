<?php

$motdepasse = "gdc6bjnsvy"; // ton mot de passe
$hash = password_hash($motdepasse, PASSWORD_DEFAULT);
echo $hash;

/* COPIE LE HASH GENERER POUR REMPLACER DANS CETTE REQUETTE ET EXECUTE DANS MYSQL

INSERT INTO admin (email_adm, mdp_adm) 
VALUES ('admin@eec.com', '$2y$10$2p91UglC90pZZ0i7eRlbCO0ndDFixqCDxRo5h0phzops7uVspiPZi'); */
?>


