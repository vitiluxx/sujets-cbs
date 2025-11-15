<!---------------debut: ENTETE OU BANNIERE DE LA PAGE --------------------------> 
<?php require_once (DOC_ADMINISTRATEUR."head.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->

<!-------------- Inclure la Sidebar -------------->
<?php include(DOC_ADMINISTRATEUR.'sidebar.php'); ?>
<!--------------------------------------------------------->

<!-------------------------------------------------------------> 
<!-- Inclure le TAG d'ouverture du contenu principale -->
<?php include(DOC_ADMINISTRATEUR.'openContenuPrincipale.php'); ?>
<!--------------------------------------------------------------->

            <h1>Bienvenue !</h1>
            <p>Vous êtes connecté avec l'identifiant : </p>

            <!-- Exemple de cartes -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Statistiques de l'App</h5>
                            <p class="card-text">Visualisez les données importantes.</p>
                            <a href="" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Utilisateurs</h5>
                            <p class="card-text">Gérez les utilisateurs de la plateforme.</p>
                            <a href="" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Paramètres</h5>
                            <p class="card-text">Personnalisez votre expérience.</p>
                            <a href="" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </div>
            </div>


<!----- Inclure le TAG de fermeture du contenu principale --------->
<?php include(DOC_ADMINISTRATEUR.'closeContenuPrincipale.php'); ?>
<!--------------------------------------------------------------->