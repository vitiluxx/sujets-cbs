Guide complet : Déploiement GitHub vers Hostinger via SSH
Je vais vous guider étape par étape, du début jusqu'au déploiement automatisé.

PHASE 6 : MISES À JOUR FUTURES
    Scénario A : Vous modifiez le code sur votre ordinateur local
    Sur votre ordinateur :
        # Modifier vos fichiers localement
        # Puis commiter et pousser
            1- Avec GitHub Desktop 
            ou
            2-avec les commandes git suivantes 
                git add .
                git commit -m "Description des modifications"
                git push origin main
    Sur le serveur Hostinger (via SSH) :
        # Se connecter
        ssh votre_username@votre_domaine.com

        # Aller dans le dossier du repo
        cd ~/private/repos/votre-repo

        # Exécuter le déploiement
        ./deploy.sh

        # Vérifier le log
        tail -20 ~/private/deploy.log

        # Se déconnecter
        exit

    #apres avoir fais cela, cree un fichier .htaccess a la racine du serveur avec le contenu suivant pour assuerer la redirection vers le rep projet/ :
        RewriteEngine On
        # Ne pas rediriger si on est déjà dans le dossier projet
        RewriteCond %{REQUEST_URI} !^/projet/
        # Rediriger toutes les requêtes vers le sous-dossier
        RewriteRule ^(.*)$ /projet/$1 [L] 
    
    enuite modifie les lignes du contenu respectives des fichiers suivants sur Hostinger (ton site [sujets-cbs])
        FICHIER _config.php :
            define ('HOST', 'https://'.$host.'/projet/');
            define ('ROOT', $root.'/projet/');
        fICHIER connexionBd.php :
            $bd = "u910986903_sujetscbs";
            $utilisateur = "u910986903_sujetscbs";
            $mdp = "3K.Superroot";


PHASE 1 : PRÉPARATION ET VÉRIFICATIONS
    Étape 1.1 : Vérifier votre accès SSH à Hostinger
        Sur votre ordinateur local :
            # Tester la connexion SSH
            ssh votre_username@votre_domaine.com
            # ou
            ssh votre_username@ip_du_serveur

            # Si ça fonctionne, vous verrez le terminal de votre serveur
            # Tapez 'exit' pour vous déconnecter

        Informations à avoir sous la main :
        Nom d'utilisateur SSH
        Hôte SSH (domaine ou IP)
        Mot de passe (ou clé SSH si configurée)

    Étape 1.2 : Vérifier Git sur le serveur
        # Se connecter au serveur
        ssh votre_username@votre_domaine.com

        # Vérifier si Git est installé
        git --version

        # Si Git n'est pas installé (peu probable sur Hostinger)
        # Contactez le support Hostinger
        
    Étape 1.3 : Explorer la structure du serveur
        # Voir où vous êtes
        pwd

        # Lister les dossiers
        ls -la

        # Trouver votre dossier public
        # Généralement c'est : public_html ou domains/votre-domaine.com/public_html
        ls -la public_html/

    Notez le chemin complet de votre dossier public (exemple : /home/votre_username/public_html)


PHASE 2 : CONFIGURATION DE LA CLÉ SSH (pour automatisation future)
    Étape 2.1 : Générer une clé SSH sur le serveur
        # Toujours connecté en SSH sur votre serveur Hostinger
        cd ~

        # Générer une paire de clés
        ssh-keygen -t ed25519 -C "votre_email@exemple.com"

        # Appuyez sur Entrée pour accepter l'emplacement par défaut
        # Appuyez sur Entrée deux fois pour ne pas mettre de passphrase

    Étape 2.2 : Ajouter la clé publique à GitHub
        # Afficher la clé publique
        cat ~/.ssh/id_ed25519.pub

        # Copiez TOUTE la ligne qui s'affiche (commence par ssh-ed25519)

    Sur GitHub (dans votre navigateur) :
    Allez sur votre repo
    Settings > Deploy keys
    Cliquez sur "Add deploy key"
    Titre : "Hostinger Server"
    Collez la clé copiée
    ❌ Ne cochez PAS "Allow write access" (lecture seule pour sécurité)
    Cliquez "Add key"

    Étape 2.3 : Tester la connexion GitHub
        # Sur le serveur, tester la connexion
        ssh -T git@github.com

        # Vous devriez voir : "Hi username! You've successfully authenticated..."


PHASE 3 : CLONER VOTRE PROJET
    Étape 3.1 : Créer un dossier pour le repo
        # Se placer dans le home directory
        cd ~

        # Créer un dossier privé pour le repo (HORS du dossier public)
        mkdir -p private/repos
        cd private/repos

        # Vérifier où vous êtes
        pwd
        # Devrait afficher quelque chose comme : /home/votre_username/private/repos

    Étape 3.2 : Cloner votre projet GitHub
        # Cloner votre repo (remplacez par votre URL)
        git clone git@github.com:votre-username/votre-repo.git

        # Entrer dans le dossier
        cd votre-repo

        # Vérifier le contenu
        ls -la

        # Vérifier la branche actuelle
        git branch

        # Vérifier le statut
        git status


PHASE 4 : CRÉER LE SCRIPT DE DÉPLOIEMENT
    Étape 4.1 : Créer le script de déploiement
        # Se placer dans le dossier du repo
        cd ~/private/repos/votre-repo

        # Créer le script
        nano deploy.sh
    Copiez ce contenu dans le fichier :
        #!/bin/bash

        # Configuration
        REPO_DIR="/home/votre_username/private/repos/votre-repo"
        PUBLIC_DIR="/home/votre_username/public_html"
        LOG_FILE="/home/votre_username/private/deploy.log"

        # Fonction de logging
        log() {
            echo "[$(date '+%Y-%m-%d %H:%M:%S')] $1" | tee -a "$LOG_FILE"
        }

        log "=== Début du déploiement ==="

        # Aller dans le dossier du repo
        cd "$REPO_DIR" || { log "ERREUR: Impossible d'accéder au dossier du repo"; exit 1; }

        # Sauvegarder la branche actuelle
        CURRENT_BRANCH=$(git branch --show-current)
        log "Branche actuelle: $CURRENT_BRANCH"

        # Récupérer les dernières modifications
        log "Récupération des modifications depuis GitHub..."
        git fetch origin

        # Mettre à jour le code
        log "Mise à jour du code..."
        git pull origin "$CURRENT_BRANCH" || { log "ERREUR: git pull a échoué"; exit 1; }

        # Afficher le dernier commit
        LAST_COMMIT=$(git log -1 --pretty=format:"%h - %s (%an, %ar)")
        log "Dernier commit: $LAST_COMMIT"

        # Synchroniser vers le dossier public
        log "Copie des fichiers vers $PUBLIC_DIR..."

        # Option 1 : Copie simple (copie tout sauf .git, node_modules, etc.)
        rsync -av --delete \
            --exclude='.git' \
            --exclude='node_modules' \
            --exclude='.env.local' \
            --exclude='.env' \
            --exclude='deploy.sh' \
            --exclude='*.log' \
            --exclude='.gitignore' \
            "$REPO_DIR/" "$PUBLIC_DIR/" || { log "ERREUR: rsync a échoué"; exit 1; }

        # Définir les bonnes permissions
        log "Configuration des permissions..."
        find "$PUBLIC_DIR" -type f -exec chmod 644 {} \;
        find "$PUBLIC_DIR" -type d -exec chmod 755 {} \;

        log "=== Déploiement terminé avec succès ==="
        log ""
    
    Adaptez ces lignes dans le script :

    Ligne 4 : remplacez /home/votre_username/private/repos/votre-repo par votre chemin
    Ligne 5 : remplacez /home/votre_username/public_html par votre chemin public
    Lignes 33-40 : ajoutez d'autres exclusions si nécessaire

    Sauvegarder et quitter :

    Appuyez sur Ctrl + X
    Tapez Y pour confirmer
    Appuyez sur Entrée

    Étape 4.2 : Rendre le script exécutable
        # Rendre le script exécutable
        chmod +x deploy.sh

        # Vérifier les permissions
        ls -l deploy.sh
        # Devrait afficher : -rwxr-xr-x


PHASE 5 : PREMIER DÉPLOIEMENT
    Étape 5.1 : Faire une sauvegarde du dossier public actuel
        //pas important pour moi @vitiluxx, continuons...

    Étape 5.2 : Exécuter le premier déploiement
        # Se placer dans le dossier du repo
        cd ~/private/repos/votre-repo

        # Exécuter le script
        ./deploy.sh

    Étape 5.3 : Vérifier le déploiement
        echo "fichiers dans le depot : $(find ~/private/depot/sujets-cbs -type f | wc -l)"; \
        echo "fichiers dans public_html de sujetscbs : $(find ~/domains/alliance-adhet.org/public_html/sujetscbs -type f | wc -l)"

    Étape 5.4 : Tester votre site
        Dans votre navigateur :

        Visitez votre domaine : http://votre-domaine.com
        Vérifiez que tout fonctionne correctement