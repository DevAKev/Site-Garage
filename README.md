<img src='./assets/images/Logo Garage V.PARROT-3.png' width='80px'>

---

# PROJET : GARAGE V. PARROT - Evaluation Studi ECF Hiver 23-24

## Evaluation en cours de formation spécialité Graduate Développeur Flutter chez Studi

---

Cette application web a était réalisé dans l'objectif de représenter la vitrine d'un garage de réparations mécanique, carrosserie et revente de véhicules d'occasions en exposant la qualité des services proposés par cette entreprise.

L'objectif du point de vue étudiant étant de valider les compétences apprises au sein de la formation débuté mi-février 2023.

Voici les conditions requises:<br>
Activité – Type 1 : Développer la partie front-end d’une application web ou web
mobile en intégrant les recommandations de sécurité <br>
● 1 Maquetter une application <br>
● 2 Réaliser une interface utilisateur web statique et adaptable <br>
● 3 Développer une interface utilisateur web dynamique <br>
● 4 Réaliser une interface utilisateur avec une solution de gestion de contenu ou ecommerce

Activité – Type 2 : Développer la partie back-end d’une application web ou web
mobile en intégrant les recommandations de sécurité <br>
● 5 Créer une base de données <br>
● 6 Développer les composants d’accès aux données <br>
● 7 Développer la partie back-end d’une application web ou web mobile <br>
● 8 Élaborer et mettre en œuvre des composants dans une application de gestion de
contenu ou e-commerce <br>

## Technologies utilisées :

**SERVEUR** :

● Version PHP 8.2
● Extension PHP : PDO
● Planethoster via FileZilla

**FRONT** :

● HTML 5
● CSS 3
● JavaScript
● Bootstrap
● jQuery

**BACK** :

● PHP 8.2 sous PDO
● MySQL

# Déploiement en local

Clonez le référentiel.
Assurez-vous que les technologies requises sont installées (par exemple, PHP, MySQL).
Configurez la base de données à l'aide des scripts SQL ou des migrations fournis.
Modifiez les paramètres de connexion à la base de données dans le fichier de configuration.
Démarrez un serveur Web local.
Accédez au site Web dans votre navigateur Web.
Veuillez-vous reporter à la documentation ou aux instructions spécifiques au projet pour les procédures d'installation et de configuration détaillées.

## Étape 1 : Installation de WampServer, Xampp, Mamp...etc

Si vous n'avez pas encore installé WampServer, suivez ces étapes :

Téléchargez le programme d'installation de WampServer à partir du site officiel : WampServer.
Lancez le programme d'installation et suivez les instructions à l'écran pour installer WampServer sur votre système.
Ensuite vous devez cloner le projet et installer les fichiers dans le répertoire de votre serveur.
Pour cloner ce dépôt vers votre machine locale :
`shell git clone https://github.com/DevAKev/Site-Garage.git `

## Étape 2 : Préparation des fichiers du site web

Assurez-vous que tous les fichiers du site web (HTML, CSS, JavaScript, etc.) sont présent et créer un nouveau dossier dans le répertoire "www" ou "htdoc" de WampServer, Xampp, Mamp... pour votre site web.

## Étape 3 : Démarrage de WampServer, Xampp, Mamp

Lancez WampServer en cliquant sur son icône depuis le bureau ou le menu de démarrage.
Vérifiez que les services Apache et MySQL sont en cours d'exécution. Vous verrez les icônes vertes dans la barre des tâches en bas à droite pour indiquer leurs statuts.

## Étape 4 : Configuration de l'accès à la base de données pour communiquer avec le backend, suivez ces étapes :

Vous pouvez importer directement le fichier garage_parrot.sql dans votre PhpMyAdmin

Dans le dossier lib, sélectionnez le fichier config.php et changez les éléments suivants : <br>

● Modifiez 'DB_NAME' par le nom de votre base de donnée à la place de 'garage_parrot' <br>
● Modifiez 'DB_USER' par votre nom d'utilisateur à la place de 'nomutilisateur' <br>
● Modifiez 'DB_PASSWORD' par votre mot de passe si vous en avez un à la place de 'motdepasse' <br>

// CONFIGURATION DE LA BASE DE DONNEES <br>
define('DB_HOST', 'localhost'); <br>
define('DB_NAME', 'garage_parrot'); <br>
define('DB_USER', 'nomutilisateur'); <br>
define('DB_PASSWORD', 'motdepasse');

PAR MESURE DE SECURITE LES INFORMATIONS DE CONNEXION A LA BASE DE DONNEE SERONT ENVOYEES UNIQUEMENT AU FORMATEUR QUI CORRIGE L'EVALUATION.

## Étape 5 : Accéder à votre site web

Ouvrez un navigateur web (Google Chrome, Mozilla Firefox, etc.).
Tapez l'adresse suivante dans la barre d'adresse : http://localhost/NOM_DU_REPERTOIRE_DE_VOTRE_SITE.
Assurez-vous de remplacer "NOM_DU_REPERTOIRE_DE_VOTRE_SITE" par le nom du dossier créé dans le répertoire "www" de WampServer.

## Étape 6 : Visualisation de votre site web

BRAVO, vous avez terminé l'installation ! Vous devriez maintenant pouvoir visualiser cette application en local via WampServer.

## Informations

Pour accéder à l'espace d'administration, sélectionnez l'icône de connexion à droite dans la navbar et insérez les identifiants :

- Pour tester les modes **administrateurs** et **employés**, des comptes _'exemples'_ ont été créés et insérés dans la base de donnée :

Email : vanessa@gmail.com <br>
Mot de passe : PAR SECURITE, VEUILLEZ ME CONTACTER A L'ADRESSE SUPPORT (kevynpro7700@gmail.com) <br>
Rôle : Employée

Email : vincent.parrot@gmail.com <br>
Mot de passe : PAR SECURITE, VEUILLEZ ME CONTACTER A L'ADRESSE SUPPORT (kevynpro7700@gmail.com) <br>
Rôle : Administrateur

## APPLICATION SUR INTERNET

L'application est déployé à cette adresse:
https://garageparrot.les-amis-de-la-montagne.go.yj.fr/

Ce nom de domaine est issu d'une création d'un sous domaine afin de continuer à utiliser WorldLite, la version gratuite pour l'hébergement via Planethoster, le but étant d'éviter de devoir louer un domaine en tant qu'étudiant encore en formation.

# Trello

Lien vers logiciel de gestion de projet Trello :
https://trello.com/b/8XhoeUz1/conduite-de-projet

## PRESENTATION DES FONCTIONNALITES ET DIFFERENTS SERVICES

# US1. Se connecter

Seul l'administrateur ou les employés peuvent se connecter à l'espace administration via leurs identifiants (Email et MDP). <br>
Les comptes utilisateur pouvant être générés uniquement par l'administrateur (Vincent Parrot) <br>
Il dispose d'un dashboard avec la possibilité de : <br>
● Gérer les services ( Ajout, modification, suppression de services) <br>
● Gérer les annonces (Ajout, modification, suppression de véhicules) * POUR MODIFIER UNE ANNONCE, L'ADMINISTRATEUR, APRES IDENTIFICATION, DOIT SE RENDRE DIRECTEMENT SUR LA PAGE DU VEHICULE A MODIFIER * <br>
● Gérer les avis (Ajout, modification, suppression des avis) * LES AVIS DES UTILISATEURS PEUVENT APPARAITRE SUR LA PAGE D'ACCUEIL UNIQUEMENT APRES MODERATION PAR UN ADMINISTRATEUR * <br>
● Messagerie (Lecture, modification du statut de réception, suppression des messages clients) <br>
● Gérer les horaires ( Modification et suppression des horaires du garage) <br>
● Gérer les comptes ( Ajout, modification, suppression des utilisateurs)

L'employé dispose de son côté d'un espace avec les fonctionnalités suivantes : <br>
● Gérer les services ( Ajout, modification, suppression de services) <br>
● Gérer les annonces (Ajout, modification, suppression de véhicules) <br>
● Gérer les avis (Ajout, modification, suppression des avis) <br>
● Messagerie (Lecture, modification du statut de réception, suppression des messages clients)

# US2. Présenter les services

Les services de réparation automobile proposés par le garage sont affichés sur la page d'accueil et dans les pages 'Entretien & Mécanique' et 'Carrosserie & Peinture'

# US3. Définir les horaires d’ouverture

Les horaires sont affichés dans le footer de toutes les pages du site et l'administrateur a la possibilité de modifier ces informations via son espace.

# US4. Exposer les voitures d'occasion

Le site web présente les voitures d'occasion disponibles à la vente avec des photos, des descriptions détaillées et des informations techniques.
Chaque voiture affiche son prix, une image mise en avant ainsi qu'une galerie, l'année de mise en circulation et le kilométrage.

# US5. Filtrer la liste des véhicules d’occasion

Un système de filtrage qui permet aux visiteurs de rechercher des véhicules en fonction de la marque, du type de carburant, d'une fourchette de prix, d'un nombre de kilomètres parcourus ou d'une année de mise en circulation.

# US6. Permettre de contacter l'atelier

Les visiteurs peuvent contacter le garage par téléphone (présent sur toutes les pages en bas à gauche) ou en utilisant le formulaire de contact en ligne. Le sujet du formulaire est automatiquement ajusté en fonction de la marque et de l'ID du véhicule en cliquant sur le button contact de l'annonce.

# US7. Recueillir les témoignages des clients

Les visiteurs peuvent laisser des témoignages composés d'un nom, d'un commentaire et d'une note.
Les témoignages sont modérés par un employé du garage et s'affichent sur la page d'accueil une fois validés.
Les employés du garage peuvent ajouter ou rejeter des témoignages clients directement depuis leur espace dédié.

---

Toutes les fonctions sont opérationnelles et plus aucun bug ne subsiste après la dernière correction. Veuillez contacter le support (kevynpro7700@gmail.com) et communiquer toutes erreurs ou bugs qui pourrait apparaitre durant l'utilisation de l'application afin d'apporter des correctifs.
