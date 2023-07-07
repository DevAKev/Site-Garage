# Site-ECF-garage

Voici le fichier readme.md contenant la démarche à suivre pour l’exécution en local.
Création d’un administrateur pour l’application web.

Cette application web pour le Garage V. Parrot a pour but de présenter l'entreprise de Vincent PARROT en exposant la qualité des services proposés par cette entreprise.

## Technologies utilisées

Serveur :
● Version PHP 8.2
● Extension PHP : PDO

Pour le front :
● HTML 5
● CSS 3
● JavaScript
● Bootstrap

pour le back :
● PHP 8.2 sous PDO
● MySQL

## Installation

1. Clonez ce dépôt vers votre machine locale :

   ```shell
   git clone https://github.com/DevAKev/Site-ECF-garage.git

Présentation des différentes fonctionnalités:

US1. Se connecter

'create_database.sql' : contient la base de données + tables.
'injectdata.php' : contient l'alimentation de la base de données.

La création de l'administrateur a été crée à partir du fichier 'injectdata.php' (comme pour pour toutes les autres créations fictives pour alimenter la database).

Compte administrateur de Vincent Parrot :
email : vincent.parrot@gmail.com
mot de passe : Vparrot31

Compte employé :
email : 
mot de passe : 

Seul l'administrateur peut générer un compte pour les employés :
Il dispose d'un tableau de bord Admin avec 3 options : créer un compte employé,
modifier la section 'services' de la page d'accueil' et modifier les horaires d'ouverture.

Pour les employés, une fois connecté, ils peuvent aussi accéder à leur tableau de bord.
Ils disposent de deux options : ajouter un nouveau véhicule et gérer les avis clients.

La connexion aux différents comptes se fait via un formulaire demandant une adresse e-mail et un mot de passe sécurisé.

# US2. Présenter les services
Les services de réparation automobile proposés par le garage sont affichés sur la page d'accueil et dans une page 'services'.

# US4. Exposer les voitures d'occasion
Le site web présente les voitures d'occasion disponibles à la vente avec des photos, des descriptions détaillées et des informations techniques.
Chaque voiture affiche son prix, une image mise en avant, l'année de mise en circulation et le kilométrage.

# US5. Filtrer la liste des véhicules d’occasion
Un système de filtres permet aux visiteurs de rechercher des véhicules en fonction d'une fourchette de prix, d'un nombre de kilomètres parcourus ou d'une année de mise en circulation.

# US6. Permettre de contacter l'atelier
Les visiteurs peuvent contacter le garage par téléphone (infos en bas de page) ou en utilisant un formulaire de contact en ligne.
Le sujet du formulaire est automatiquement ajusté en fonction du titre de l'annonce.

# US7. Recueillir les témoignages des clients
Les visiteurs peuvent laisser des témoignages composés d'un nom, d'un commentaire et d'une note.
Les témoignages sont modérés par un employé du garage et s'affichent sur la page d'accueil.
Les employés du garage peuvent ajouter ou rejeter des témoignages clients directement depuis leur espace dédié.

#######################################################################################################################

Garage-V-Parrot
Site responsive pour un garage

Il s'agit d'un site Web pour un garage automobile qui permet aux clients de parcourir les services, de voir les voitures à vendre et de contacter le garage. Il fournit également des fonctionnalités permettant aux administrateurs et aux employés de gérer le contenu du site Web.

Technologies utilisées
HTML
CSS
Amorcer
Javascript
PHP
MySQL
pages
Sommaire:

Catalogue de services : explorez notre large gamme de services pour garder votre véhicule en parfait état.
Voitures à vendre : Découvrez notre collection de voitures disponibles à l'achat.
Formulaire de contact : remplissez le formulaire pour vous renseigner sur des services ou des voitures spécifiques, et notre équipe vous répondra rapidement.
Avis des clients : lisez les avis et les évaluations de nos clients satisfaits et laissez vos propres commentaires.
Page du catalogue :

Liste des voitures : consultez toutes les voitures actuellement en vente dans notre garage.
Filtres intelligents : utilisez les filtres fournis pour affiner votre recherche en fonction de l'année, du kilométrage et du prix.
Détails de la voiture : cliquez sur une voiture pour afficher des informations plus détaillées à son sujet.
Formulaire de contact : Vous avez trouvé une voiture qui vous intéresse ? Remplissez le formulaire de contact avec l'identifiant de la voiture et nous vous aiderons davantage.
Page de contact :

Entrez en contact : utilisez le formulaire de contact pour laisser vos informations et toute demande spécifique que vous pourriez avoir. Nous vous contacterons dès que possible.
Fonctionnalités utilisateur
Administrateur:

Connexion : Accédez à la zone administrative avec votre identifiant unique et votre mot de passe.
Gestion des employés : créez et gérez les comptes des employés pour un accès sécurisé au système.
Catalogue de services : Modifier la liste des services que nous proposons pour mieux répondre aux besoins de nos clients.
Commentaires des clients : gérez et répondez aux commentaires et aux évaluations des clients.
Heures d'ouverture : Mettez à jour les heures d'ouverture du garage pour une communication précise.
Gestion des voitures : ajoutez, modifiez ou supprimez des voitures du catalogue.
Employé:

Connexion : accédez à l'espace employé à l'aide de votre identifiant et de votre mot de passe.
Commentaires des clients : gérez et répondez aux commentaires et aux évaluations des clients.
Gestion des voitures : ajoutez, modifiez ou supprimez des voitures du catalogue.
Client:

Parcourir et filtrer les voitures : explorez les voitures disponibles à la vente et utilisez des filtres intelligents pour trouver la correspondance parfaite.
Contactez-nous : Contactez-nous en utilisant le formulaire de contact pour toute demande de renseignements ou demande.
Laisser des commentaires : partagez vos expériences et laissez des commentaires sur nos services et nos voitures.
Exécution locale
Pour exécuter ce site Web localement, procédez comme suit :

Clonez le référentiel.
Assurez-vous que les technologies requises sont installées (par exemple, PHP, MySQL).
Configurez la base de données à l'aide des scripts SQL ou des migrations fournis.
Modifiez les paramètres de connexion à la base de données dans le fichier de configuration.
Démarrez un serveur Web local.
Accédez au site Web dans votre navigateur Web.
Veuillez vous reporter à la documentation ou aux instructions spécifiques au projet pour les procédures d'installation et de configuration détaillées.

