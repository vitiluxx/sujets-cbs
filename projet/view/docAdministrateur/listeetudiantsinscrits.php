<?php
require_once(DOC_ADMINISTRATEUR . "head.php");
include(DOC_ADMINISTRATEUR . 'sidebar.php');
include(DOC_ADMINISTRATEUR . 'openContenuPrincipale.php');
?>

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
        $('#table-etudiants').DataTable({
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
<main id="body-liste-etudiants">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Liste des étudiants confirmés</h1>
        <div class="table-responsive">
            <table id="table-etudiants" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Identifiant</th>
                        <th>Date d'inscription</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Récupérer les données de la table etudiant_cbs (étudiants confirmés)
                    $req = $connexionBd->query("SELECT * FROM etudiant_cbs WHERE compte_confirme_etu = 1");
                    while ($etudiant = $req->fetch(PDO::FETCH_ASSOC)) :
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($etudiant['id_etu']) ?></td>
                            <td><?= htmlspecialchars($etudiant['prenom_etu']) ?></td>
                            <td><?= htmlspecialchars($etudiant['email_etu']) ?></td>
                            <td><?= htmlspecialchars($etudiant['identifiant_etu']) ?></td>
                            <td><?= htmlspecialchars($etudiant['date_inscription_etu']) ?></td>
                            <td>
                                <span class="badge bg-success">Confirmé</span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<!----------------fin: CORPS DE LA PAGE -------------------------------------------------->

<?php include(DOC_ADMINISTRATEUR . 'closeContenuPrincipale.php'); ?>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

<!-- DataTables JS -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>