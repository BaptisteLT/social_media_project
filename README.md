# Documentation du projet:

### Tables:

```
CREATE TABLE userlikepost (
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_post`)
);

CREATE TABLE utilisateur (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(255) DEFAULT NULL,
  password varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE post (
  id int(11) NOT NULL AUTO_INCREMENT,
  comment varchar(255) DEFAULT NULL,
  created_at datetime DEFAULT NULL,
  updated_at datetime DEFAULT NULL,
  created_by int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
);
```

### Configation de l'application:
dans config.php

### Démarrer l'application:
se rendre dans le dossier public et lancer la commande: php -S localhost:8000

### Actions réalisables:
1) Créer un compte
2) Se connecter
3) Modifier son mot de passe
4) Voir les posts
5) Créer un post
6) Liker un post
7) Supprimer un post
8) Se déconnecter

### Librairies utilisées: 
jQuery/Bootstrap

### Créer une route:
dans src/app.php

### Tester le token csrf sur la route:
/delete-post?id=ID&csrf=TOKEN

### Gestion des erreurs:
En cas d'erreur, un fichier est généré à la racine du dossier, appelé my-errors.log








