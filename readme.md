# WordPress Toolkit

## Responsables du projet

Nom Prénom
<email@example.com>
+410000000
Rôle de la personne

## Contacts

_Ajouter ici toutes les personnes en relation avec le projet_

Nom Prénom
<email@example.com>
+410000000
Rôle de la personne

## Accès

_Ajouter ici les URLs d'accès au projet (staging, production)_

## Documentation technique

### Prérequis

-   PHP 7.4
-   Dernière version de Wordpress
-   asdf, asdf-nodejs : https://atoz.hawaii.do/development/asdf/

### Installation

#### Nouveau projet

1. Télécharger Wordpress sur https://wordpress.org/download/
2. Décompresser et copier les fichiers dans votre dossier web.
3. Vider le dossier des thèmes `./wp-content/themes`
4. Cloner ce dépot git dans votre dossier de thème.
5. Supprimer le dossier `.git` et crer un nouveau dépot git avec `git init`
6. Créer un nouveau projet sur https://git.hawai.li/ et suivre les instructions pour lier a ce dépôt
7. Installer les dépendances `npm install`
8. Copier `config.example.json` to `config.json` et configurer le host

#### Projet existant

1. Télécharger Wordpress sur https://wordpress.org/download/
2. Décompresser et copier les fichiers dans votre dossier web.
3. Vider le dossier des thèmes `./wp-content/themes`
4. Cloner le dépot git du projet dans votre dossier de thème.
5. Installer les dépendances `npm install`
6. Copier `config.example.json` to `config.json` et configurer le host

### Commandes

-   `npm run dev` : Compile les assets en mode développement
-   `npm run watch` : Compile les assets et recharge le browser quand les fichiers changent
-   `npm run production` : Compile les assets en mode production (Exectuer cette commande avant de publier un site)

### Plus d'informations

https://toolkit.hawai.li/
