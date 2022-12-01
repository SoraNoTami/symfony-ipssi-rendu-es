# SYMFONY IPSSI

## Requirements

 - PHP 8.1 or higher
 - MySQL 5.7 or higher
 - composer 2.4 or higher
 - Node version 16 or higher

## Installation

### Clone

    git clone https://github.com/CDevJenny/symfony-ipssi.git

### Create env file

    cp .env .env.local
> Dans `.env.local` remplacer la ligne DATABASE avec vos informations de connexion.
> Renseigner cette ligne `DATABASE_URL="mysql://root:root@127.0.0.1:3306/your_database"` avec vos infos de connexion
### Install dependencies
    composer install
> Installe vos dépendances renseignées dans le composer.json

### Create DB
    symfony console doctrine:database:create
> Crée la base de données renseignée dans .env.local
    symfony console doctrine:schema:update --force
> Met à jour la structure de vos entités dans votre base de données
## Front installation
    npm install
> Installe les dépendances NPM depuis le package.json
    npm run build
> Build vos fichiers assets dans votre dossier public/assets 
    npm run watch
> Refresh les changements apportés en css et js dans vos dossiers assets/styles en direct sans avoir a relancer un build

## Run symfony server

### A executer une seule fois
    symfony server:ca: install
> Installe un certificat SSL pour votre serveur local
### A lancer à chaque fois 
    symfony server:start
> Lance votre serveur local symfony 
## Dans le dossier SQL 
    Prendre le fichier .sql et importez le dans votre base de données
# Commandes utiles avec symfony console

## MakerBundle 
### Commandes make génériques
    symfony console make:entity
> Ouvre le menu de création/édition de vos entités. Génére une class dans vos Entity et un repository associé
    symfony console make:form
> Crée un fichier dans votre dossier Form pour générer des formulaires
    symfony console make:controller
> Crée un fichier controller ainsi qu'un template associé dans vos templates twig
    symfony console make:crud
> Crée un controller et y génère des fonctions CRUD pour l'entité de votre choix, génère également les templates correspondants
### Commandes 
    symfony console make:user
> Crée une entité User avec un password hasher associé
    symfony console make:auth
> Crée un système de connexion avec votre entité User précédemment généré ainsi qu'un template twig de login
    symfony console make:registration-form
> Crée un formulaire de d'inscription pour votre Entité User

# CONSIGNES DU RENDU

Le projet est mini site e-commerce composé de :

## Entités 
- Article
- Product (ajouter UN SEUL paramètre personnalisé tel qu'une couleur, une marque etc.)
- Category
- User (Client/Vendeur/Admin)
- Cart
Les articles et produits doivent avoir une option de statut, publié ou brouillon. Ils doivent pas etre affiché hors partie admin si ils sont en brouillon. 

### Un menu de navigation en haut de page 
- Les pages doivent y etre renseignées, ainsi que les options de connexion et de navigation selon les roles et permissions ainsi qu'un lien vers le panier de l'utilisateur.

### Une page d'accueil accessible sans connexion 
- Elle doit renvoyer les 3 derniers articles du plus récent au plus ancien. Vos articles doivent avoir un titre, un contenu, un auteur, une date de création et d'édition.

### Une page produit accessible sans connexion
- Elle doit lister tous les produits disponibles. On doit y voir, le nom, description, image, prix, vendeur, catégorie du produit ainsi que votre paramètre personnalisé.
- La page doit aussi avoir un formulaire permettant de trier par prix, vendeur, catégorie et doit lister par défaut les articles des plus vieux au plus récent, mais le formulaire doit aussi permettre d'ordonner par date de création. (ASC ou DESC). 
- Les produits doivent avoir des liens dirigeants vers leur page produit personnalisée.
- Si un produit a son stock inférieur à 1, il ne doit pas apparaitre. 
- Si un produit n'est pas en statut publié, il ne doit pas apparaitre.

### Une page produit accessible AVEC connexion
- Cette page doit afficher à nouveau toutes les infos du produit et également un formulaire d'action permettant de choisir la quantité désirée, le choix du paramètre personnalisé au sein d'une liste, ainsi que de l'ajouter au panier.

### Une page profil accessible avec connexion et seulement par l'utilisateur connecté actuellement
- Elle doit lister les infos de l'utilisateur, nom, prénom, email, statut. Ses produits si il est vendeur. 
- La page doit également renvoyer vers l'edition des infos de l'utilisateur d'une part(nom, prénom, email), et l'édition de son mot de passe d'autre part. Ces formulaires et pages doivent etre indépendants. 
- Si il est vendeur, il doit pouvoir accéder à la création d'un produit, l'édition et suppression des siens. 

### Une page panier accessible avec connexion
- Les utilisateurs doivent avoir accès à leur panier. Listant, les produits ajoutés à leur panier et la quantité associée ainsi que l'option personnalisée choisie.
- Le panier doit afficher un bouton "Acheter" vidant le panier et ajustant les stocks restant sur les produits venant d'être achetés. 

### Une page admin accessible UNIQUEMENT par l'admin
- L'admin doit y avoir un header différent de la base : Avec en lien, articles, produits, catégories, utilisateurs. 
- La page d'accueil de l'admin doit renseigner un panel de stats avec le nombre existant de chacune des entités.
- Chaque page doit avoir un formulaire de filtre permettant de trier avec les attributs respectifs de chaque entité. 
- Produits : Vendeur, Catégories, DESC ou ASC
- Articles : DESC ou ASC
- Catégories : DESC ou ASC
- Users : Statut (vendeur/client) 
L'admin doit pouvoir naviguer de son interface au site classique. Il doit avoir un bandeau ou un rappel visuel distinctif de son statut en tout temps sur toutes les pages lorsqu'il est connecté. 

## Attentes générales
- Votre repo github doit etre nommé selon la structure suivante :
> https://github.com/utilisateur/symfony-ipssi-rendu + vos deux initiales
> Exemple : https://github.com/utilisateur/symfony-ipssi-rendu-cj-cj
- Vous serez notés sur la qualité du nommage de vos commit, de vos fichiers, de vos fonctions, de vos routes et la cohérence de l'ensemble. Soyez logiques et organisés.
- Vous serez également attendu sur un front clair et lisible. Bootstrap et autres library sont autorisées. Utilisez des couleurs, des typos qui rendront votre projet lisible. 

Merci d'ajouter un dossier SQL a la racine de votre projet et d'y joindre l'export de votre base de données