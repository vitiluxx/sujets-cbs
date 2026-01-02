<?php
include_once(CONTROLLER_ROOT."Controller.class.php");
include_once(CONTROLLER_ROOT."ControllerAdmin.class.php");
/**
 * CLASS ROUTEUR 
 * 
 * qui va nous servir de creer des route et trouver le controller
 */
class Routeur 
{
    private $requette;
    private $route = [
                      "form_inscriptionUtilisateur.php" =>                  ["controller" => "Controller", "method" => "affichePageForm_inscriptionUtilisateur"], 
                      "form_connexionUtilisateur.php" =>                    ["controller" => "Controller", "method" => "affichePageForm_connexionUtilisateur"],
                      "deconnexionUtilisateur.php" =>                       ["controller" => "Controller", "method" => "affichePageDeconnexionUtilisateur"],


                      "cefodbusinessschool.php" =>                          ["controller" => "Controller", "method" => "affichePageCbs"],                    
                      "form_inscriptionCbs.php" =>                          ["controller" => "Controller", "method" => "affichePageForm_inscriptionEtudiantCbs"], 
                      "form_connexionCbs.php" =>                            ["controller" => "Controller", "method" => "affichePageForm_connexionEtudiantCbs"], 
                      "deconnexionEtudiantCbs.php" =>                       ["controller" => "Controller", "method" => "affichePageDeconnexionEtudiantCbs"], 
                      
                      "demandesinscription.php" =>                          ["controller" => "ControllerAdmin", "method" => "affichePageDemandesInscription"], 
                      "listeetudiantsinscrits.php" =>                          ["controller" => "ControllerAdmin", "method" => "affichePageListeEtudiantsInscrits"], 
                      "sujetspdf.php" =>                                       ["controller" => "ControllerAdmin", "method" => "affichePageSujetsPdf"], 
                    //   "confirmerinscription.php" =>                         ["controller" => "ControllerAdmin", "method" => "affichePageConfirmerInscription"], 
                    //   "supprimerdemandeinscription.php" =>                         ["controller" => "ControllerAdmin", "method" => "affichePageSupprimerDemandeInscription"], 
                      "form_publierEEC.php" =>                              ["controller" => "ControllerAdmin", "method" => "affichePageForm_publierEEC"],                      
                      "form_insertionPDF.php" =>                            ["controller" => "ControllerAdmin", "method" => "affichePageForm_insertionPDF"], 
                      "zoneAdmin.php" =>                                    ["controller" => "ControllerAdmin", "method" => "affichePageZoneAdmin"], 

                                      
                      "form_admin.php" =>                                   ["controller" => "Controller", "method" => "affichePageform_admin"],      
                      "form_modifierExerciceUtilisateur.php" =>             ["controller" => "Controller", "method" => "affichePageform_modifierExerciceUtilisateur"], 
                      "liste_filieres.php" =>                               ["controller" => "Controller", "method" => "affichePageListe_filieres"],
                      "liste_niveaux.php" =>                               ["controller" => "Controller", "method" => "affichePageListe_niveaux"],
                      "cc.php" =>                                           ["controller" => "Controller", "method" => "affichePageCc"],
                      "sn.php" =>                                           ["controller" => "Controller", "method" => "affichePageSn"],
                      "sr.php" =>                                           ["controller" => "Controller", "method" => "affichePageSr"],
                      "bts.php" =>                                          ["controller" => "Controller", "method" => "affichePageBts"],
                      "td.php" =>                                           ["controller" => "Controller", "method" => "affichePageTd"],
                    //   "tp.php" =>                                           ["controller" => "Controller", "method" => "affichePageTp"],
                      "telechargerPdfCc.php" =>                             ["controller" => "Controller", "method" => "affichePageTelechargerPdfCc"],
                      "telechargerPdfSn.php" =>                             ["controller" => "Controller", "method" => "affichePageTelechargerPdfSn"],
                      "telechargerPdfSr.php" =>                             ["controller" => "Controller", "method" => "affichePageTelechargerPdfSr"],
                      "telechargerPdfBts.php" =>                            ["controller" => "Controller", "method" => "affichePageTelechargerPdfBts"],
                      "telechargerPdfTd.php" =>                             ["controller" => "Controller", "method" => "affichePageTelechargerPdfTd"],
                      "telechargerPdfTp.php" =>                             ["controller" => "Controller", "method" => "affichePageTelechargerPdfTp"],
                      "form_mdp_oublier.php" =>                             ["controller" => "Controller", "method" => "affichePageform_mdp_oublier"],
                      "reinitialisation_mdp.php" =>                         ["controller" => "Controller", "method" => "affichePageReinitialisation_mdp"],
                      "confirmation.php" =>                                 ["controller" => "Controller", "method" => "affichePageConfirmation"],
                      "erreur404" =>                                        ["controller" => "Controller", "method" => "affichePageErreur404"],


/*=================================================================================================================================================

MEME CHOSE JUSTE C'EST UNE DUPLICATION POUR QUE MEME SI L'ON DEMANDE UNE PAGE SANS L'EXTENSION .php   ALORS QUE CELA FONCTIONNE TOUJOURS

=================================================================================================================================================*/

                      "accueil" =>                                      ["controller" => "Controller", "method" => "affichePageCbs" ], 
                      "cefodbusinessschool" =>                          ["controller" => "Controller", "method" => "affichePageCbs"],                    
                      "form_inscriptionUtilisateur" =>                  ["controller" => "Controller", "method" => "affichePageForm_inscriptionUtilisateur"], 
                      "form_connexionUtilisateur" =>                    ["controller" => "Controller", "method" => "affichePageForm_connexionUtilisateur"],
                      "deconnexionUtilisateur" =>                       ["controller" => "Controller", "method" => "affichePageDeconnexionUtilisateur"],


                      "cefodbusinessschool" =>                          ["controller" => "Controller", "method" => "affichePageCbs"],                    
                      "form_inscriptionCbs" =>                          ["controller" => "Controller", "method" => "affichePageForm_inscriptionEtudiantCbs"], 
                      "form_connexionCbs" =>                            ["controller" => "Controller", "method" => "affichePageForm_connexionEtudiantCbs"], 
                      "deconnexionEtudiantCbs" =>                       ["controller" => "Controller", "method" => "affichePageDeconnexionEtudiantCbs"], 
                      

                      "dashboard" =>                                    ["controller" => "ControllerAdmin", "method" => "affichePageDemandesInscription"],                      
                      "demandesinscription" =>                          ["controller" => "ControllerAdmin", "method" => "affichePageDemandesInscription"], 
                      "listeetudiantsinscrits" =>                          ["controller" => "ControllerAdmin", "method" => "affichePageListeEtudiantsInscrits"], 
                      "sujetspdf" =>                                       ["controller" => "ControllerAdmin", "method" => "affichePageSujetsPdf"], 
                      "confirmerinscription" =>                         ["controller" => "ControllerAdmin", "method" => "affichePageConfirmerInscription"], 
                      "supprimerdemandeinscription" =>                         ["controller" => "ControllerAdmin", "method" => "affichePageSupprimerDemandeInscription"], 

                      "form_insertionPDF" =>                            ["controller" => "ControllerAdmin", "method" => "affichePageForm_insertionPDF"], 
                      "form_admin" =>                                   ["controller" => "Controller", "method" => "affichePageform_admin"], 
                      "form_modifierExerciceUtilisateur" =>             ["controller" => "Controller", "method" => "affichePageform_modifierExerciceUtilisateur"], 
                      "zoneAdmin" =>                                    ["controller" => "ControllerAdmin", "method" => "affichePageZoneAdmin"], 
                      "liste_filieres" =>                               ["controller" => "ControllerAdmin", "method" => "affichePageListe_filieres"], 
                      "liste_niveaux" =>                               ["controller" => "Controller", "method" => "affichePageListe_niveaux"],
                      "cc" =>                                           ["controller" => "Controller", "method" => "affichePageCc"],
                      "sn" =>                                           ["controller" => "Controller", "method" => "affichePageSn"],
                      "sr" =>                                           ["controller" => "Controller", "method" => "affichePageSr"],
                      "td" =>                                           ["controller" => "Controller", "method" => "affichePageTd"],
                    //   "tp" =>                                           ["controller" => "Controller", "method" => "affichePageTp"],
                      "telechargerPdfCc" =>                             ["controller" => "Controller", "method" => "affichePageTelechargerPdfCc"],
                      "telechargerPdfSn" =>                             ["controller" => "Controller", "method" => "affichePageTelechargerPdfSn"],
                      "telechargerPdfSr" =>                             ["controller" => "Controller", "method" => "affichePageTelechargerPdfSr"],
                      "telechargerPdfTd" =>                             ["controller" => "Controller", "method" => "affichePageTelechargerPdfTd"],
                      "telechargerPdfTp" =>                             ["controller" => "Controller", "method" => "affichePageTelechargerPdfTp"],
                      "form_mdp_oublier" =>                             ["controller" => "Controller", "method" => "affichePageform_mdp_oublier"],
                      "reinitialisation_mdp" =>                         ["controller" => "Controller", "method" => "affichePageReinitialisation_mdp"],
                      "confirmation" =>                                 ["controller" => "Controller", "method" => "affichePageConfirmation"],


                    ];


    public function __construct($requette)
    {
        
        $this->requette = $requette;
        
    }


    public function runderController()
    {
        $requette = $this->requette;
        
        if(key_exists($requette, $this->route))
        {
            $controller = $this->route[$requette]["controller"]; //on recupere la requette + le controller
            $method = $this->route[$requette]["method"]; // de meme on recupere la requette + la method adequoite
    
            $controllerDemander = new $controller();
            $controllerDemander->$method();

            // if($requette === "form_admin" OR $requette === "form_admin.php" OR $requette === "form_insertionPDF" OR $requette === "form_insertionPDF.php")
            // {
            //     echo $_1; exit();
            //     if(isset($_1) && $_1 === (int)(1))
            //     {
            //         $controller = $this->route[$requette]["controller"]; //on recupere la requette + le controller
            //         $method = $this->route[$requette]["method"]; // de meme on recupere la requette + la method adequoite

            //         $controllerDemander = new $controller();
            //         $controllerDemander->$method();
            //     }
            //     else
            //     {
                     ?>
            <!--        <script>alert("Desoler page proteger !! Vous n'etes pas connecter en tant que Super_Root")</script> -->
                     <?php
            //         echo "Erreur ... Revenez plus tard lorsque vous serez connecter en tant que Super_Root";
            //     }
            // }
            // else
            // {
            //     $controller = $this->route[$requette]["controller"]; //on recupere la requette + le controller
            //     $method = $this->route[$requette]["method"]; // de meme on recupere la requette + la method adequoite
    
            //     $controllerDemander = new $controller();
            //     $controllerDemander->$method();
            // }
  
        }else{ 
            include_once (VIEW_ROOT.'erreur404.php');  
        }
    }
}