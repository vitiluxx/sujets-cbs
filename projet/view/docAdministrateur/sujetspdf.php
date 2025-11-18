<?php
require_once(DOC_ADMINISTRATEUR . "head.php");
include(DOC_ADMINISTRATEUR . 'sidebar.php');
include(DOC_ADMINISTRATEUR . 'openContenuPrincipale.php');

$examensLabels = [
    'cc' => 'Contrôle Continu (CC)',
    'sn' => 'Session Normale (SN)',
    'sr' => 'Session de Rattrapage (SR)',
    'bts' => 'BTS',
    'td' => 'Travaux Dirigés (TD)',
    'tp' => 'Travaux Pratiques (TP)',
];
?>

<style>
    .table thead {
        background-color: #0088a9;
        color: #ffffff;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 136, 169, 0.05);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #0088a9 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #0088a9 !important;
        border-color: #0088a9 !important;
        color: #ffffff !important;
    }

    .badge-filiere {
        background-color: rgba(0, 136, 169, 0.15);
        color: #0088a9;
        font-weight: 600;
    }
</style>

<script>
    $(document).ready(function () {
        var table = $('#table-sujets').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            order: [[2, 'desc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
            }
        });

        $('#filtre-filiere').on('change', function () {
            var valeur = this.value;
            table.column(3).search(valeur ? '^' + valeur + '$' : '', true, false).draw();
        });
    });
</script>

<main id="body-sujets-pdf">
    <div class="container mt-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <h1 class="mb-0">Gestion des sujets PDF</h1>
            <div class="w-100 w-md-50">
                <label for="filtre-filiere" class="form-label">Filtrer par filière</label>
                <select class="form-select" id="filtre-filiere">
                    <option value="">Toutes les filières</option>
                    <?php foreach ($filieres as $cleFiliere => $libelleFiliere) : ?>
                        <option value="<?= htmlspecialchars($libelleFiliere); ?>">
                            <?= htmlspecialchars($libelleFiliere); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table id="table-sujets" class="table table-striped table-bordered align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Matière</th>
                        <th>Année</th>
                        <th>Filière</th>
                        <th>CC</th>
                        <th>SN</th>
                        <th>SR</th>
                        <th>BTS</th>
                        <th>TD</th>
                        <th>TP</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($allSujets)) : ?>
                        <?php foreach ($allSujets as $sujet) : ?>
                            <tr>
                                <td><?= htmlspecialchars($sujet->id); ?></td>
                                <td><?= htmlspecialchars($sujet->matiere); ?></td>
                                <td><?= htmlspecialchars($sujet->annee); ?></td>
                                <td>
                                    <span class="badge badge-filiere">
                                        <?= htmlspecialchars($sujet->libelle_filiere); ?>
                                    </span>
                                </td>
                                <?php foreach (array_keys($examensLabels) as $colonne) : ?>
                                    <td class="text-center">
                                        <?php if (!empty($sujet->$colonne)) : ?>
                                            <a href="<?= ASSETS_HOST . "uploads/docpdf/" . rawurlencode($sujet->$colonne); ?>"
                                               target="_blank"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf me-1"></i> Voir
                                            </a>
                                        <?php else : ?>
                                            <span class="text-muted">—</span>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="text-center">
                                    <button type="button"
                                            class="btn btn-warning btn-sm mb-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal-modifier-<?= $sujet->filiere . '-' . $sujet->id; ?>">
                                        Modifier
                                    </button>
                                    <form method="post"
                                          class="d-inline"
                                          onsubmit="return confirm('Confirmer la suppression complète de ce sujet et des fichiers associés ?');">
                                        <input type="hidden" name="action" value="supprimer">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($sujet->id); ?>">
                                        <input type="hidden" name="filiere" value="<?= htmlspecialchars($sujet->filiere); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include(DOC_ADMINISTRATEUR . 'closeContenuPrincipale.php'); ?>

<?php if (!empty($allSujets)) : ?>
    <?php foreach ($allSujets as $sujet) : ?>
        <div class="modal fade"
             id="modal-modifier-<?= $sujet->filiere . '-' . $sujet->id; ?>"
             tabindex="-1"
             aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Modifier le sujet #<?= htmlspecialchars($sujet->id); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="action" value="modifier">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($sujet->id); ?>">
                            <input type="hidden" name="filiere" value="<?= htmlspecialchars($sujet->filiere); ?>">

                            <div class="mb-3">
                                <label for="matiere-<?= $sujet->filiere . '-' . $sujet->id; ?>" class="form-label">Matière</label>
                                <input type="text"
                                       class="form-control"
                                       id="matiere-<?= $sujet->filiere . '-' . $sujet->id; ?>"
                                       name="matiere"
                                       value="<?= htmlspecialchars($sujet->matiere); ?>"
                                       required>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="annee-<?= $sujet->filiere . '-' . $sujet->id; ?>" class="form-label">Année</label>
                                    <input type="number"
                                           class="form-control"
                                           id="annee-<?= $sujet->filiere . '-' . $sujet->id; ?>"
                                           name="annee"
                                           value="<?= htmlspecialchars($sujet->annee); ?>"
                                           min="2000"
                                           max="<?= date('Y') + 1; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Filière</label>
                                    <input type="text"
                                           class="form-control"
                                           value="<?= htmlspecialchars($sujet->libelle_filiere); ?>"
                                           disabled>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row">
                                <?php foreach ($examensLabels as $colonne => $libelle) : ?>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="<?= $colonne . '-' . $sujet->filiere . '-' . $sujet->id; ?>">
                                            <?= htmlspecialchars($libelle); ?>
                                        </label>
                                        <input type="file"
                                               class="form-control"
                                               name="<?= $colonne; ?>"
                                               id="<?= $colonne . '-' . $sujet->filiere . '-' . $sujet->id; ?>"
                                               accept=".pdf">
                                        <?php if (!empty($sujet->$colonne)) : ?>
                                            <small class="text-muted d-block mt-1">
                                                Actuel : <?= htmlspecialchars($sujet->$colonne); ?>
                                            </small>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>

