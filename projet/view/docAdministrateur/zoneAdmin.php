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

<main id="body-zone">

    
<style>
    #div-zoneAdmin    {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        min-height: 100vh;
        padding: 20px;
        background-color: #f4f4f9;
        margin: 0;
    }
        .card {
            width: 300px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-header {
            padding: 20px;
            text-align: center;
            background-color: #4CAF50;
            color: #fff;
            font-size: 1.2em;
            font-weight: bold;
        }
        .card-body {
            padding: 20px;
            flex: 1;
        }
        .card-body p {
            margin: 10px 0;
            color: #333;
            font-size: 0.9em;
        }
        .card-body .label {
            font-weight: bold;
            color: #555;
        }
        .card-footer {
            text-align: center;
            padding: 15px;
            border-top: 1px solid #ddd;
        }
        .card-footer img {
            width: 80%;
            border-radius: 5px;
        }
        .actions {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
        }
        .btn {
            padding: 8px 12px;
            font-size: 0.9em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-success {
            background-color: #28a745;
            color: #fff;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        } 
    </style>

<div id="div-zoneAdmin">
    

<?php foreach ($etudiants as $etudiant): ?>
    <div class="card">
        <div class="card-header">
            <?= htmlspecialchars($etudiant->prenom_etu) ?>
        </div>
        <div class="card-body">
            <p><span class="label">Email :</span> <?= htmlspecialchars($etudiant->email_etu) ?></p>
            <p><span class="label">Date d'inscription :</span> <?= htmlspecialchars($etudiant->date_inscription_etu) ?></p>
        </div>
        <div class="card-footer">
        <a href="<?= $etudiant->carte_etu; ?>" target="_blank">
            <img src="<?= $etudiant->carte_etu; ?>" alt="Carte étudiant" style="width: 100%; border-radius: 4px;" />
        </a>
            <div class="actions">
                <!-- Bouton pour ajouter l'étudiant -->
                <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="id_etu" value="<?= $etudiant->id_etu ?>">
                    <button type="submit" name="boutton_ajouter" class="btn btn-success">Ajouter</button>
                </form>

                
                <!-- Bouton pour supprimer les données de l'étudiant -->
                <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="id_etu" value="<?= $etudiant->id_etu ?>">
                    <button type="submit" name="boutton_supprimer" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

<?php endforeach; ?>



<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.0/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#laTable').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            paging: true,
            autoWidth: false,
            responsive: true,
            info: false,
            ordering: false,
        });
    });
</script>





    <div>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    </div>
</div>
        
</main>    

<!----- Inclure le TAG de fermeture du contenu principale --------->
<?php include(DOC_ADMINISTRATEUR.'closeContenuPrincipale.php'); ?>
<!--------------------------------------------------------------->