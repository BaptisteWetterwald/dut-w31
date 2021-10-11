TP4 - Gestion d'utilisateurs et POO
===================================

Dupliquez votre répertoire `TP3` dans un nouveau répertoire `TP4` dans lequel nous allons modifier progressivement les fichiers.

Objectifs
---------

Ce TP propose :
- de mettre en place l'inscription des utilisateurs dans une base de données SQLite,
- de mettre en place le paradigme de POO.

Exercice 1 : Modification du mot de passe
-----------------------------------------

Vous allez ajouter la fonctionnalité de changement de mot de passe avec deux nouveaux fichiers : la vue `formpassword.php` et le contrôleur `changepassword.php`.

1. Créez un nouveau fichier `formpassword.php` contenant un formulaire avec deux champs : un nouveau mot de passe et sa confirmation. Ce formulaire a pour cible `changepassword.php`.
2. Assurez-vous que ce formulaire soit proposé uniquement si l'utilisateur est connecté. Si ce n'est pas le cas, redirigez-le vers `signin.php`.
3. Créez un nouveau fichier `changepassword.php` qui :
	- vérifie que l'utilisateur est connecté
	- vérifie que la méthode HTTP utilisée est `POST`
	- vérifie et sécurise les champs du formulaire de `formpassword.php`
	- vérifie que le mot de passe et sa confirmation sont identiques
	- tente de changer le mot de passe de l'utilisateur dans la BDD  avec une **requête préparée** :
		- si la requête s'est bien passée, il demande une redirection vers `account.php`
		- Sinon il demande une redirection vers `formpassword.php`.
4. Pour plus de navigabilité, ajoutez un lien vers `formpassword.php` sur la page `account.php`, et réciproquement.

> **Note** : Pensez à mettre à jour la variable de session `message`.


Exercice 2 : Suppression d'un utilisateur
-----------------------------------------

1. Ajoutez un lien vers `deleteuser.php` sur la page `account.php`.
2. Écrivez un nouveau fichier `deleteuser.php` qui :
	- vérifie que l'utilisateur est connecté
	- tente de supprimer l'utilisateur de la BDD avec une **requête préparée** :
		- si la requête s'est bien passée, il supprime la session et demande une redirection vers `signin.php`.
		- sinon il demande une redirection vers `account.php`.

> **Note** : Pensez à mettre à jour la variable de session `message`.


Exercice 3 : Passage en POO - Les bases
---------------------------------------

Cet exercice va vous permettre de créer une classe `User` faisant le lien entre votre BDD et le reste de votre code.

1. Créez un répertoire `models`.
2. Déplacer dans `models` le fichier `bdd.php`.
3. Copiez dans `models` le fichier [`MyPDO.php`](https://git.unistra.fr/W31/w31/-/blob/master/files/MyPDO.php).
4. Créez dans `models` un fichier `User.php` qui contient la déclaration de la classe `User` avec :
	- deux attributs privés pour le login et le mot de passe avec leurs getters/setters
	- un attribut privé constant `USER_TABLE` contenant le nom de la table des utilisateurs à utiliser dans les champs `FROM` des requêtes SQL
	- un constructeur prenant en paramètre :
		- un login
		- un mot de passe avec une valeur par défaut `null`


Exercice 4 : Passage en POO - Authentification
----------------------------------------------

1. Dans la classe `User`, écrivez une méthode publique `exists`, sans paramètre, qui effectue les étapes du fichier `authenticate.php` relatives à la BDD, c'est-à-dire :
	- faire une requête vers la BDD pour récupérer l'utilisateur dont le login correspond à l'attribut du login de la classe
	- déclencher une `Exception` si la requête échoue
	- retourner vrai si l'utilisateur existe et que le mot de passe correspond, faux sinon.

**Attention** : pour accéder à l'objet PDO, utilisez la méthode statique `pdo()` de la classe `MyPDO`.

2. Modifiez le fichier `authenticate.php` en remplaçant tout ce qui concerne les requêtes vers la BDD par :
	- la création d'un objet `User` à partir des variables récupérées en POST
	- l'utilisation de la méthode `exists` pour vérifier si l'utilisateur existe dans la BDD.

> **Note 1** : "Try-catchez" toutes les exceptions pouvant être déclenchées par l'appel à la méthode `exists()`.

> **Note 2** : Utilisez à bon escient l'attribut `USER_TABLE`.


Exercice 5 : Passage en POO - Ajout d'un utilisateur
----------------------------------------------------

1. Dans la classe `User`, écrivez une méthode publique `create`, sans paramètre, qui effectue les étapes du fichier `adduser.php` relatives à la BDD, c'est-à-dire :
	- faire une requête vers la BDD pour insérer l'utilisateur `$this`
	- déclencher une `Exception` si la requête échoue

2. Modifiez le fichier `adduser.php` en remplaçant tout ce qui concerne les requêtes vers la BDD par :
	- la création d'un objet `User` à partir des variables récupérées en POST
	- l'utilisation de la méthode `create` pour insérer l'utilisateur dans la BDD.

> **Note** : "Try-catchez" toutes les exceptions pouvant être déclenchées par l'appel à la méthode `create()`.


Exercice 6 : Passage en POO - Changement de mot de passe
--------------------------------------------------------

1. Dans la classe `User`, écrivez une méthode publique `changePassword`, avec un mot de passe en paramètre, qui effectue les étapes du fichier `changepassword.php` relatives à la BDD, c'est-à-dire :
	- faire une requête vers la BDD pour mettre à jour le mot de passe de l'utilisateur `$this` avec celui passé en paramètre
	- déclenche une `Exception` si la requête échoue
	- mettre à jour l'attribut du mot de passe de la classe avec le nouveau mot de passe sinon

2. Modifiez le fichier `changepassword.php` en remplaçant tout ce qui concerne les requêtes vers la BDD par :
	- la création d'un objet `User` à partir de son login
	- l'utilisation de la méthode `changePassword` pour modifier le mot de passe de l'utilisateur dans la BDD.

> **Note** : "Try-catchez" toutes les exceptions pouvant être déclenchées par l'appel à la méthode `changePassword()`.


Exercice 7 : Passage en POO - Suppression d'un utilisateur
----------------------------------------------------------

1. Dans la classe `User`, écrivez une méthode publique `delete` qui effectue les étapes du fichier `deleteuser.php` relatives à la BDD, c'est-à-dire :
	- faire une requête vers la BDD pour supprimer l'utilisateur `$this`
	- déclenche une `Exception` si la requête échoue
2. Modifiez le fichier `deleteuser.php` en remplaçant tout ce qui concerne les requêtes vers la BDD par :
	- la création d'un objet `User` à partir de son login
	- l'utilisation de la méthode `delete` pour supprimer l'utilisateur de la BDD.

> **Note** : "Try-catchez" toutes les exceptions pouvant être déclenchées par l'appel à la méthode `delete()`.


Pour les plus rapides
---------------------

1. Créez une classe `UserException` qui hérite de la classe PHP `Exception` et utilisez-la pour les exceptions déclenchées par les méthodes de la classe `User`. Adaptez en conséquences les `try...catch` des autres fichiers.
2. Modifier l'architecture de votre application pour mettre les fichiers contrôleurs et vues dans des répertoires `controlers` et `views` au même niveau que `models`.
3. Utilisez [Bootstrap](https://getbootstrap.com) pour mettre en forme vos différentes pages.
