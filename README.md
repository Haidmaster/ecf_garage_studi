ECF-GARAGE-Vincent PARROT

GARAGE V PARROT est une application web qui vous accueille et vous fournit une large gamme de voitures et les services nécessaires pour vos véhicules. Cette application a été développée avec le framework Symfony version 6.4.0.

Version en ligne :
Prérequis

Pour exécuter cette application en local, vous aurez besoin de :

    Git
    Serveur XAMPP ou autres
    PHP 8.1.0 ou supérieur
    Composer
    Symfony CLI
    Un système de gestion de bases de données comme MySQL

Installation

Suivez ces étapes pour installer et exécuter le projet en local :

    Cloner le dépôt : git clone https://github.com/WalidFTAIMIA/ECF_GARAGE_V.PARROT.git](https://github.com/Haidmaster/ecf_garage_studi.git)

    Aller dans le répertoire du projet : cd ECF_GARAGE_V.PARROT

    Installer les dépendances avec Composer : composer install composer require symfony/runtime

    Configurer votre environnement local en modifiant le fichier .env ou en créant un fichier .env.local :

    Définissez la variable DATABASE_URL avec les informations de connexion à la base de données

    Créer la base de données : symfony console doctrine:database:create

    Exécuter les migrations pour créer les tables dans la base de données : symfony console doctrine:migrations:migrate

    Lancer l'application en local avec Symfony : symfony server:start

Création d'un compte administrateur local

    Connectez-vous à la base de données;

    Accédez à la table "users". Cette table contient quatre colonnes : "id", "username", "password" et "role";

    Pour créer un nouvel administrateur, ajoutez une nouvelle ligne dans cette table. Entrez un identifiant unique pour "id", choisissez un "username" et un "password" pour le nouvel administrateur. Pour la colonne "role", entrez "ROLE_ADMIN";

    Une fois le compte administrateur créé, vous pouvez vous connecter au back-office en utilisant le nom d'utilisateur et le mot de passe que vous avez définis;

Suivez ces étapes pour créer un compte administrateur :
CONNEXION AU BACK-OFFICE

    Cliquez sur Espace Professionel en haut à droit de la navbar
    Entrez le nom d'utilisateur et le mot de passe de l'administrateur
    Vous êtes maintenant connecté en tant qu'administrateur et pouvez gérer les employées, les véhicules et les avis des clients, etc;

DECONNEXION

    Pour vous déconnecter de l'administration, cliquez simplement sur Se déconnecter

    1-Un projet symfony
Déployez en local

Clonez le projet sur votre ficher htdocs de xampp et créer votre base de données grâce au ficher sql fourni.

Si vous démarrez de zéro, vous devrez commencer par ajouter un compte admin dans la table user avec un mot de passe pré-encodé avec Bcrypt : https://www.bcrypt.fr/ La commande sql est la suivante :

INSERT INTO `user` VALUES (1,NULL,'UNE ADRESSE MAIL','[\"ROLE_ADMIN\"]','MOT DE PASSE ENCRYPTE','LE NOM','LE PRENOM');

La valeur la plus importante étant le role, pensez à bien échaper les doubles quotes pour éviter les problèmes de correspondance dans symfony.

Ajoutez les fichiers de configuration des variables d'environnement (.env, .env.local).

Ce projet nécessite le paramétrage de APP_ENV, APP_SECRET, DATABASE_URL ET MAILER_DSN

Pour installer les dépendances de symfony pour ce projet, lancez la commande :

composer install

Pour servir votre application, lancez la commande :

symfony server:start

Pensez également à activer MySQL sur xampp pour que votre base de données soit accessible.

Ouvrez votre navigateur sur http://localhost:8000/

Pour plus d'informations, vous pouvez lire la documentations symfony : https://symfony.com/doc/current/setup.html
