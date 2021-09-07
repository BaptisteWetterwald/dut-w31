Serveur PHP local
=================

Pour l'environnement de travail, l'utilisation d'une usine à gaz comme LAMP ou WAMP est inutile : vous n'avez besoin que de PHP.

Installation sur une ordinateur personnel
-----------------------------------------

### Sous windows

**L'utilisation d'une distribution Linux est fortement recommandée.** Il n'y a pas de méthode "simple" sous Windows. Deux solutions :

1. Installer une distribution Linux en Dual Boot
2. Installer une machine virtuelle avec une distribution Linux => ici [un tuto pour installer Ubuntu avec Hyper-V](https://www.windowscentral.com/how-run-linux-distros-windows-10-using-hyper-v)

### Sous Linux

Il vous faut les droits root pour installer l'ensemble des paquets dont vous aurez besoin en une seule commande :
```bash
$ sudo apt install php sqlite3 php-sqlite3 sqlitebrowser composer
```

Utilisation
-----------

> *Cette procédure remplace l'utilisation de `public_html` et `webetu`.*

Ce qui suit peut être réalisé :

- sur votre ordinateur personnel si vous avez réalisé l'installation de la section précédente
- sur un bureau à distance de l'IUT depuis `troglo`, `phoenix` ou `cannette`

### Lancement d'un serveur local

La procédure à suivre pour lancer un serveur PHP local est détaillée [dans la doc de PHP](https://www.php.net/manual/fr/features.commandline.webserver.php) dont voici un résumé :

0. On suppose que le répertoire `/chemin/vers/mon/repertoire/de/TP/` sera la racine de l'ensemble des fichiers de votre TP.
1. Ouvrir un terminal
2. Lancer un serveur local dont la racine est ce répertoire :
	```bash
	$ php -S localhost:port -t /chemin/vers/mon/repertoire/de/TP/
	```
	avec `port` un entier compris entre 1025 et 65535. Si vous avez un message d'erreur, essayez un autre port.

### Accéder au serveur local depuis un navigateur

Pour visualiser le rendu d'un fichier PHP par le serveur que vous avez lancé, il suffit d'ouvrir un navigateur à cette URL :

**`http://localhost:port`**

et d'ajouter son chemin à la fin de l'URL.

##### Exemples :

|                   Fichier à visualiser                 |                      URL                     |
|--------------------------------------------------------|----------------------------------------------|
| `/chemin/vers/mon/repertoire/de/TP/signin.php`         | `http://localhost:port/signin.php`           |
| `/chemin/vers/mon/repertoire/de/TP/rep1/rep2/test.php` | `http://localhost:port/rep1/rep2/signin.php` |
