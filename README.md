# Mes Films Préférés

Application web permettant à des utilisateurs inscrits de rechercher des films via l'API TMDB, de gérer leur liste de favoris et de partager des films avec leurs amis.

"Application en ligne" : [mesfilmspreferes.ranya.portfoliobtssio66.fr](https://mesfilmspreferes.ranya.portfoliobtssio66.fr/)


## Technologies utilisées

Backend
- "Laravel (PHP)" — framework utilsé pour la gestion des routes, contrôleurs et migrations
- "PHP" — langage serveur pour la logique métier
- "MySQL" — base de données relationnelle (hébergée sur O2Switch)

Frontend
- "Blade" — moteur de templates natif Laravel pour les vues HTML dynamiques
- "Bootstrap Icons" — bibliothèque d'icônes CSS

API externe
- "TMDB API" (The Movie Database) — récupération des données films : titre, affiche, description, note, genres, réalisateur, casting



## Guide d'utilisation

1. Créer un compte
<br>Rendez-vous sur la page d'inscription et renseignez vos informations (nom, prénom, nom d'utilisateur, adresse mail et mot de passe). Une fois le formulaire validé, vous êtes automatiquement connecté et redirigé vers l'accueil.

![Création de compte](docs/screens/1.png)

2. Rechercher un film
Depuis la barre de navigation, accédez à la page "Rechercher un film". Tapez le titre d'un film dans le champ de recherche : les résultats proviennent de l'API TMDB et s'affichent avec l'affiche, le titre et l'année de sortie.

![Recherche de film](docs/screens/2.png)

3. Ajouter un film en favori
Sur la page de recherche, cliquez sur le bouton "Ajouter aux favoris" sous le film souhaité. Le film apparaît ensuite dans votre liste de favoris.

![Favoris](docs/screens/3.png)

4. Gérer ses amis
Depuis la page "Amis", recherchez un utilisateur par son nom d'utilisateur et envoyez-lui une demande d'ami. Vous pouvez également supprimer un ami depuis cette même page.

![Gestion des amis](docs/screens/4.png)

5. Partager un film
Depuis votre liste de favoris, partagez un film à l'un de vos amis en sélectionnant le destinataire et en ajoutant un message optionnel. Les films reçus et envoyés sont visibles dans la page "Partages".

![Gestion des amis](docs/screens/5.png)
![Partage de film](docs/screens/6.png)



## MCD

![MCD](docs/screens/7.png)
