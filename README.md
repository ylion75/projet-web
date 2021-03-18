# Projet Web
## A propos du projet
Projet réalisé dans le cadre de notre DUT Informatique. Ce projet consiste à recréer les fonctionnalités principales du site reddit. 

Nous avons travaillé sur la partie back-end avec PHP et une base de données MySQL.

## Mise en place du projet
Téléchargez le projet à cette adresse : 
   ```sh
   git clone https://github.com/ylion75/projet-web/tree/Dev
   ```
### Créez la base de donnée
Afin de pouvoir vous connecter à la base de données, un export de celle-ci est disponible dans le répertoire BDD.

## Principales fonctionnalités 
### Création d'un compte utilisateur
Cette fonctionnalité permet à l'utilsateur de créer son compte et que le compte soit créé dans la base de donnée. 

L'utilisateur peut choisir d'ajouter une photo à son profil. Nous avons choisit de stocker les images en local et non directement sur la base de donnée. Les images sont stockées avec le nom de l'utilisateur et l'extension du fichier correspondant.
Par ailleurs, nous avons ajouté un contrôle afin que la taille de la photo ne dépasse pas 2 Mo. Les formats sont également limités au jpg, jpeg, gif et au png. 

### Page de gestion de compte utilisateur
Cette page permet à l'utilisateur de modifier ses informations personnelles. Comme sur le site Reddit, le nom d'utilisateur ne peut-être changé. 
L'utilisateur peut changer son e-mail. Après un contrôle, le mail est alors changé dans la base de données. 

L'utilisateur peut également changer son image personnelle, les contrôles là-dessus sont identiques que pour la page de création de compte. 



### Création et modification d'un compte utilisateur <br />
### Ajout d'un post et d'un commmentaire <br />
### Login / logout <br />
### Upvote & downvote d'un post <br />
### Suppression d'un poste <br />
