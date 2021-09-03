W31 - Programmation web côté serveur
====================================

#### IMPORTANT : Il sera impératif de savoir utiliser ce dépôt pour le TP noté.

Pour démarrer, vous devez :
1. Mettre en place une clé SSH en suivant le tuto [GITLABSSH.md](GITLABSSH.md)
2. Mettre en place votre environnement de travail en suivez les instructions ci-dessous.

Ensuite, pour **utiliser** de votre dépôt, regardez la page [HOWTO.md](HOWTO.md).

1 - Créer un **clône distant** sur Gitlab
-----------------------------------------

Il suffit de cliquer sur le bouton "Fork" en haut de la page, à côté du bouton bleu "Clone".

**À FAIRE** : Ajouter votre enseignant de TP en tant que "Reporter" de votre dépôt (menu "Members").

2 - Créer un **clône local** sur votre ordinateur
-------------------------------------------------

1. Installer git sur votre ordinateur personnel (rien à faire sur les postes de l'IUT) :
```sh
$ sudo apt install git
```

2. Configurer vos informations d'utilisateur :
```sh
$ git config --global user.name "[Prenom] [Nom]"
$ git config --global user.email "[login]@unistra.fr"
```

3. Cloner votre fork :
```sh
$ git clone git@git.unistra.fr:[login]/W31.git
```

3 - Ajouter le **remote "prof"**
--------------------------------

En trois commandes :
```sh
$ cd W31
$ git remote add prof https://git.unistra.fr/W31/w31.git
$ git fetch prof
```

Si tout s'est bien passé, la commande :
```sh
$ git remote
```
affiche :
```sh
origin
prof
```
