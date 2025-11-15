<!---------------debut: ENTETE OU BANNIERE DE LA PAGE -------------------------->
<?php require_once(DOC_ADMINISTRATEUR . "head.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->

<!-------------- Inclure la Sidebar -------------->
<?php include(DOC_ADMINISTRATEUR . 'sidebar.php'); ?>
<!--------------------------------------------------------->

<!------------------------------------------------------------->
<!-- Inclure le TAG d'ouverture du contenu principale -->
<?php include(DOC_ADMINISTRATEUR . 'openContenuPrincipale.php'); ?>
<!--------------------------------------------------------------->

<!-- Custom CSS -->
<style>
    .table thead {
        background-color: #0088a9;
        color: #ffffff;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 136, 169, 0.1);
    }

    .badge.bg-success {
        background-color: #28a745 !important;
    }

    .badge.bg-warning {
        background-color: #ffc107 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #0088a9 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #0088a9 !important;
        border-color: #0088a9 !important;
        color: #ffffff !important;
    }
</style>

<!-- Initialisation de DataTables -->
<script>
    $(document).ready(function () {
        $('#table-demandes').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json' // Traduction en français
            }
        });
    });
</script>

<!----------------debut: CORPS DE LA PAGE -------------------------->
<main id="body-liste-demandes">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Liste des demandes reçues</h1>
        <div class="table-responsive">
            <table id="table-demandes" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Recto de la carte</th>
                        <th>Verso de la carte</th>
                        <th>Date de demande</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Récupérer les données de la table etudiant_cbs_temp
                    $req = $connexionBd->query("SELECT * FROM etudiant_cbs_temp");
                    while ($etudiant = $req->fetch(PDO::FETCH_ASSOC)) :
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($etudiant['id_etu']) ?></td>
                            <td><?= htmlspecialchars($etudiant['prenom_etu']) ?></td>
                            <td><?= htmlspecialchars($etudiant['email_etu']) ?></td>
                            <td>
                                <a href="<?= ASSETS_UPLOADS_CBS_IMAGES_HOST . htmlspecialchars($etudiant['carte_recto_etu']) ?>" target="_blank">
                                    <img src="<?= ASSETS_UPLOADS_CBS_IMAGES_HOST . htmlspecialchars($etudiant['carte_recto_etu']) ?>" alt="Recto" width="50">
                                </a>
                            </td>
                            <td>
                                <a href="<?= ASSETS_UPLOADS_CBS_IMAGES_HOST . htmlspecialchars($etudiant['carte_verso_etu']) ?>" target="_blank">
                                    <img src="<?= ASSETS_UPLOADS_CBS_IMAGES_HOST . htmlspecialchars($etudiant['carte_verso_etu']) ?>" alt="Verso" width="50">
                                </a>
                            </td>
                            <td><?= htmlspecialchars($etudiant['date_inscription_etu']) ?></td>
                            <td>
                                <span class="badge <?= $etudiant['compte_confirme_etu'] ? 'bg-success' : 'bg-warning' ?>">
                                    <?= $etudiant['compte_confirme_etu'] ? 'Confirmé' : 'En attente' ?>
                                </span>
                            </td>
                            <td>
                                <?php if (!$etudiant['compte_confirme_etu']) : ?>
                                    <!-- Formulaire pour confirmer l'inscription -->
                                    <form action="" method="post" style="display:inline;">
                                        <input type="hidden" name="id_etu" value="<?= $etudiant['id_etu'] ?>">
                                        <input type="hidden" name="prenom_etu" value="<?= $etudiant['prenom_etu'] ?>">
                                        <input type="hidden" name="email_etu" value="<?= $etudiant['email_etu'] ?>">
                                        <button type="submit" name="boutton_confirmer" class="btn btn-success btn-sm">Confirmer</button>
                                    </form>

                                    <!-- Formulaire pour supprimer la demande -->
                                    <form action="" method="post" style="display:inline;">
                                        <input type="hidden" name="id_etu" value="<?= $etudiant['id_etu'] ?>">
                                        <button type="submit" name="boutton_supprimer" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<!----------------fin: CORPS DE LA PAGE -------------------------------------------------->

<!----- Inclure le TAG de fermeture du contenu principale --------->
<?php include(DOC_ADMINISTRATEUR . 'closeContenuPrincipale.php'); ?>
<!--------------------------------------------------------------->