TP2 - Gestion de comptes utilisateur
====================================

Créez un répertoire `TP2` contenant les 5 fichiers vides suivants :

- `signin.php`
- `authenticate.php`
- `account.php`
- `signout.php`
- `bdd.php`


Objectifs
----------

L'objectif des exercices suivants est de compléter progressivement les fichiers ci-dessus pour mettre en place un **mécanisme d'authentifications d'utilisateurs**. Ils serviront de base pour les TPs sur la POO et les BDD.

Pour tous les exercices du TP :
- **vérifiez** et **sécurisez** les variables que l'utilisateur peut modifier
- envisagez tous les cas de figures possibles (méthodes HTTP) pour accéder à vos pages et **neutralisez** les cas non désirés
- n'oubliez pas de **commiter/pusher régulièrement** votre travail sur le dépôt Git pour vous familiariser avec.


Exercice 1 : Formulaire de connexion
------------------------------------

> Ce fichier ne doit contenir **aucun code PHP** (pour le moment).

Complétez le fichier PHP `signin.php` pour affichez un document HTML avec un formulaire proposant de s'authentifier à l'aide d'un login et d'un mot de passe.


Exercice 2 : Un fichier comme BDD
---------------------------------

> Ce fichier ne doit contenir **aucun code HTML**.

Pour ce TP, la base de donnée des utilisateurs sera stockée dans le fichier `bdd.php` sous la forme d'un tableau `$users` contenant des couples `'login' => 'mot de passe'`.

Créez ce tableau avec quelques utilisateurs de votre imagination.


Exercice 3 : Authentification
-----------------------------

> **Note** : ce fichier ne comportera aucun code HTML.

Complétez le script PHP `authenticate.php` qui traite la requête HTTP POST du formulaire `signin.php` comme suit :

1. Il crée (ou charge) une session
2. Il demande une redirection vers le fichier `signin.php` si la méthode HTTP utilisée n'est pas POST.
3. Il inclut le fichier `bdd.php`.
4. Il vérifie que le tableau `$users` contient le login transmis en POST. Regardez la documentation de [array_key_exists](https://www.php.net/manual/fr/function.array-key-exists.php)
5. Si le login existe, il vérifie que le mot de passe passé en POST correspond au mot de passe du tableau `$users`.
6. Si les mots de passe correspondent :
	- le login est sauvegardé dans le tableau de session
	- une demande de redirection vers le fichier `account.php` est envoyée
7. Dans tous les cas d'échec d'authentification, une demande de redirection vers le fichier `signin.php` est envoyée.


Exercice 4 : Mon compte
-----------------------

Complétez le fichier PHP `account.php` pour qu'il se comporte ainsi :

1. Si l'utilisateur ne s'est pas encore authentifié, une demande de redirection vers le fichier `signin.php` est envoyée.
2. Si l'utilisateur est authentifié, ce fichier lui propose un contenu HTML comportant un message de bienvenue personnalisé ainsi qu'un lien de déconnexion vers le fichier PHP `signout.php`


Exercice 5 : Déconnexion
------------------------

Complétez le fichier PHP `signout.php` pour qu'il :

1. efface l'identité de l'utilisateur connecté de la session courante
2. envoie une demande de redirection vers le fichier `signin.php`

Note : Ce fichier doit contenir **exactement** 3 instructions.


Exercice 6 : Messages d'erreur du serveur vers le client
--------------------------------------------------------

Cet exercice propose de mettre en place un système de messages affichés sur la page `signin.php` pour indiquer à l'utilisateur le problème rencontré par le module PHP.

1. Dans le fichier `authenticate.php`, créez une variable de session `message` qui contiendra un texte relatif aux différents cas de figure rencontrés lors de la tentative d'authentification :
	- lorsque le login n'existe pas
	- lorsque le mot de passe est incorrect

2. Dans les fichiers `signin.php` et `account.php`, affichez le contenu de la variable de session `message` dans une balise `<section>`, si cette variable existe et n'est pas vide.


Pour les plus rapides
---------------------

- Niveau 1 : Ajoutez un fichier de style CSS pour mettre en forme votre formulaire.
- Niveau 2 : Utilisez [Bootstrap](https://getbootstrap.com) pour mettre en forme vos différentes pages.
