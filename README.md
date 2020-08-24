# Introduction au PHP

Nous allons modifier le site statique développé durant l'EPCF afin de le rendre
**dynamique**. Cela signifie que les pages html envoyées aux clients par le serveur ne seront plus stockées "en dur" dans des fichiers HTML, mais plûtot générées à la demande par PHP.

> Ici, quand on parle de dynamique, on parle bien de fait que les pages sont crées "à la volée" par le serveur, pas du dynamisme "visuel" coté client (animations, chargement ajax, etc...)

Le but premier de PHP est donc de **générer le contenu HTML** de la réponse HTTP du serveur. (On appelle cela un moteur de template). Mais PHP est capable de faire bien d'autre choses, comme par example **définir les en-têtes** de la réponse HTTP (par exemple pour rediriger l'utilisateur vers une autre page), **communiquer avec une base données**, envoyer des e-mails, ...

## Objectifs

- comprendre le fonctionnment du cycle _requête_/_réponse_
- manipuler PHP pour créer un site web dynamique
- concevoir et communiquer avec une base de données (MySQL)
- comprendre les failles de sécurités potentielles d'un site dynamique

## Compétences du REAC

Ce TP couvre le compétences suivantes :

- 5 : Créer une base de données
- 6 : Développer les composants d’accès aux données
- 7 : Développer la partie back-end d’une application web ou web mobile

## Installation et développment

### Pré-requis

- PHP 7.3 (ou plus)
- Apache
- MySQL ou MariaDB

### Installer le projet

Cloner le dépot distant dans le dossier de votre choix (`votre-dossier`).

```sh
git clone https://gitlab.com/infrep33-web/2020-fullstack/tp-intro-php.git votre-dossier
```

Se déplacer dans le dossier créé à la commande précédente

```sh
cd votre-dossier
```

## Etapes du développement

1. **Charger les données dynamiquement**

   - [x] Afficher dynamiquement les images de chaque projet dans la section *portfolio*
   - [x] représenter la liste des témoignages sous forme d'un tableau PHP
   - [x] parcourir ce tableau pour afficher les données dans le HTML
   - [x] faire un peu de refactoring, pour extraire les données et les morceaux de template dans des fichiers séparés.

2. **Charger les données dynamiquement avec des paramètres**

   - [x] paginer la liste des projets avec 10 résultats par page
   - [x] ajouter des liens dans HTML pour passer de page en page (précédente / suivante)
   - [x] ajouter des liens dans HTML pour voir toutes les pages (prev 1, 2, 3, next ) en mettant en avant (CSS) la page actuelle
   - [x] ajouter un nouveau paramètre qui permet de choisir le nombre de résultats par page

3. **Ajouter une page _single_ pour les projets**
    
    - [x] Créer la page php permettant de voir le projet n° 1
    - [x] Faire en sorte que le script `php` accepte un paramètre dans l'URL pour que le client puisse choisir le projet à afficher
    - [x] Définir un schema d'URL permettant d'accéder à cette page
    - [x] Ajouter des liens de navigation interne (projet précédent, projet suivant)


4. **Créer des données dynamiquement**

   - [x] créer une nouvelle page contenant un formulaire permettant à l'utilisateur de créer un témoignage
     - un champ pour le nom (**obligatoire**) 
     - un champ pour le contenu (**obligatoire**, 5 mots minimum, 280caractères max)
     - un champ "job" (optionnel) 
   - [x] créer un script PHP permettant de traiter les données reçues du formulaire, en validant les données envoyées.
      - si invalide, afficher le message d'erreur à coté du input correspondant 
      - Si valide, redirection vers la homepage
   - [x] Enregistrer le témoignage dans la BDD
   - [ ] Afficher les trois témoignages les plus récents sur la page d'accueil
   - [ ] _refactoring_ : extraire la connexion à la BDD dans un fichier séparé

5. Les utilisateurs peuvent affecter une note sur 5 lorsqu'ils laissent un message.
   
   - [x] Modifier la structure de la table feedbacks pour pouvoir enregistrer la note
   - [x] Modifier le formulaire en ajoutant un champ permettant de rentrer une note
   - [x] Modifier le script de traitement des données (une note est un nombre entier compris entre 1 et 5 inclus)
   - [x] Modifier la requête d'insertion du feedback de manière à enregistrer la note donnée
   - [ ] Modifier l'affichage des témoignages sur la page d'accueil (ex: une rangée d'étoiles)
# though
