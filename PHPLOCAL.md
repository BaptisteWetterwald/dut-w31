Serveur PHP local
=================

Pour l'environnement de travail, l'utilisation d'**une usine à gaz comme LAMP ou WAMP est inutile : vous n'avez besoin que de PHP**.

Installation sur un ordinateur personnel
----------------------------------------

### Sous Linux

Il vous faut les droits root pour installer l'ensemble des paquets dont vous aurez besoin en une seule commande :
```bash
$ sudo apt install php sqlite3 php-sqlite3 sqlitebrowser composer
```

### Sous windows

**L'utilisation d'une distribution Linux est fortement recommandée.**

Il existe une méthode simple sous windows :

1. Télécharger l'archive des binaires de PHP pour Windows ([x64](https://windows.php.net/downloads/releases/php-8.0.10-Win32-vs16-x64.zip) - [x86](https://windows.php.net/downloads/releases/php-8.0.10-Win32-vs16-x86.zip))
2. Extraire quelque part, de préférence dans `C:\Programmes\php` (créer le dossier).
3. Ajouter le dossier au PATH :
   1. Win+R, `SystemPropertiesAdvanced.exe`
   2. Cliquer sur "Variables d'environnement"
   3. Sélectionner `PATH` et cliquer sur "Modifier..."
   4. Cliquer sur "Nouveau" et coller le chemin d'installation de PHP (`C:\Programmes\php`).
4. Vérifier que PHP est bien installé:
   1. Win+R, `cmd`
   2. `php --version`

Si vous obtenez quelque chose comme :
```
PHP 8.0.10 (cli) (built: Aug 26 2021 10:26:33) ( NTS )
Copyright (c) The PHP Group
Zend Engine v4.0.10, Copyright (c) Zend Technologies
```
alors félicitations, votre installation de PHP ets fonctionnelle.

Si vous obtenez :
```
'php' n’est pas reconnu en tant que commande interne
ou externe, un programme exécutable ou un fichier de commandes.
```
alors essayez de vous reconnecter à votre session utilisateur. Si le problème persiste, vérifiez votre PATH et votre chemin d'installation de PHP.


**Alternatives :**

1. Installer une distribution Linux en Dual Boot
2. Installer une machine virtuelle avec une distribution Linux => ici [un tuto pour installer Ubuntu avec Hyper-V](https://www.windowscentral.com/how-run-linux-distros-windows-10-using-hyper-v)


Utilisation
-----------

### Lancement d'un serveur local

La procédure à suivre pour lancer un serveur PHP local est détaillée [dans la doc de PHP](https://www.php.net/manual/fr/features.commandline.webserver.php) dont voici un résumé :

0. On suppose que le répertoire `/chemin/vers/mon/repertoire/de/TP/` sera la racine de l'ensemble des fichiers de votre TP.
1. Ouvrir un terminal
2. Lancer un serveur local dont la racine est ce répertoire :
	```bash
	$ php -S 127.0.0.1:port -t /chemin/vers/mon/repertoire/de/TP/
	```
	avec `port` un entier compris entre 1025 et 65535. Si vous avez un message d'erreur, essayez un autre port.

### Accéder au serveur local depuis un navigateur

Pour visualiser le rendu d'un fichier PHP par le serveur que vous avez lancé, il suffit d'ouvrir un navigateur à cette URL :

**`http://127.0.0.1:port`**

et d'ajouter son chemin à la fin de l'URL.

##### Exemples :

|                   Fichier à visualiser                 |                      URL                     |
|--------------------------------------------------------|----------------------------------------------|
| `/chemin/vers/mon/repertoire/de/TP/signin.php`         | `http://127.0.0.1:port/signin.php`           |
| `/chemin/vers/mon/repertoire/de/TP/rep1/rep2/test.php` | `http://127.0.0.1:port/rep1/rep2/signin.php` |
