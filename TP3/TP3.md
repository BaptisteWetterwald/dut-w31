TP3 - Gestion d'utilisateurs et BDD
===================================

Dupliquez votre répertoire `TP2` dans un nouveau répertoire `TP3` dans lequel nous allons modifier progressivement les fichiers.

Objectifs
---------

Cet exercice vous propose de mettre en place une gestion des utilisateurs dans une base de données SQLite.

> **Note** : il est fortement recommandé d'avoir réalisé l'exercice 6 du TP2 afin de transmettre les message d'erreur de PHP au client.


Exercice 1 : Mise en place de la BDD
------------------------------------

1. Créez un fichier vide `tp3.db`.
2. Utilisez `sqlite3` ou `sqlitebrowser` pour créer une table `Users` permettant de stocker les logins et mots de passe des utilisateurs. Réfléchissez bien aux champs et attributs des champs : auto-increment, unique, null, etc.
3. Ajoutez manuellement plusieurs utilisateurs.

Utilisation de `sqlite3` en ligne de commande :
```bash
$ sqlite3 tp3.db
sqlite> CREATE TABLE ... ;
sqlite> INSERT INTO ... ;
sqlite> .exit
```

Exercice 2 : Déclaration de la BDD
----------------------------------

1. Supprimez toutes les instructions du fichier `bdd.php`
2. Créez une variable `$sqliteFile` qui contient le chemin absolu vers `tp3.db` **sur le serveur PHP que vous utilisez** (utiliser  [`$_SERVER['DOCUMENT_ROOT']`](https://www.php.net/manual/fr/reserved.variables.server.php)).
3. Ajoutez un test d'existence du fichier (voir [`file_exists`](https://www.php.net/manual/fr/function.file-exists.php)) et si ce n'est pas le cas, propagez une `Exception` qui indique que le fichier de BDD n'existe pas.
4. Créez une variable `$SQL_DSN` qui correspond au paramètre de la construction d'un objet PDO (voir [le cours](http://adrien.krahenbuhl.fr/courses/IUTRS/W31/CM2) et [la documentation PHP](https://www.php.net/manual/fr/book.pdo.php)).


Exercice 3 : Authentification
-----------------------------

Il s'agit de modifier le fichier `authenticate.php` pour remplacer l'utilisation du tableau `$users` par la BDD `tp3.db` en utilisant **PDO**.

1. Créez un objet PDO en utilisant les informations contenues dans `bdd.php`.
2. Construisez et exécutez une **requête préparée** permettant de récupérer le mot de passe de l'utilisateur.
3. Adaptez les vérifications suivantes du TP2 :
	- que l'utilisateur existe (i.e. que le résultat contient des données).
	- que le mot de passe transmis en POST correspond au mot de passe trouvé dans la BDD.

> **Note** : Toutes les erreurs possibles doivent déclencher une demande de redirection vers `signin.php` et mettre à jour le messages d'erreur de variable de session `message`.


Exercice 4 : Inscription
------------------------

1. Écrivez un nouveau fichier `signup.php` qui propose un formulaire d'inscription pour un nouvel utilisateur (avec mot de passe et confirmation de mot de passe) et le soumet à la page `adduser.php`.
2. Écrivez un nouveau fichier `adduser.php` qui :
	- vérifie que la méthode HTTP utilisée est `POST`
	- vérifie et sécurise les champs du formulaire de `signup.php`
	- vérifie que le mot de passe et sa confirmation sont identiques
	- tente d'insérer le nouvel utilisateur avec une **requête préparée** :
		- si la requête s'est bien passée, il demande une redirection vers `signin.php`
		- sinon il demande une redirection vers `signup.php`
3. Pour plus de navigabilité, ajoutez sur la page `signin.php` un lien vers `signup.php`, et réciproquement.

> **Note** : Si vous avez fait l'exercice 6 du TP2, vous pouvez ajouter les messages d'erreur et de réussite à la variable de session `message`.


Exercice 5 : Mots de passe cryptés
----------------------------------

Actuellement les mots de passe sont codés en clair dans votre base de données. Vous allez mettre en place le chiffrement (et le décryptage) des mots de passe.

> **Note 1** : Ce serait le bon moment pour faire un commit Git de votre 1ère version fonctionnelle de ce TP.

> **Note 2** : Si tout a bien été fait jusque là, les questions 2. et 3. de cet exercice nécessitent de ne changer **qu'une seule ligne** dans chacun des fichiers.

1. Supprimez de votre BDD tous les utilisateurs inscrits, via `sqlite3` ou `sqlitebrowser`.
2. Modifiez le fichier `adduser.php` afin qu'il enregistre le mot de passe chiffré avec la fonction PHP [`password_hash`](http://php.net/manual/fr/function.password-hash.php).
3. Modifiez le fichier `authenticate.php` pour qu'il compare le mot de passe du formulaire avec celui récupéré dans la BDD à l'aide de la fonction [`password_verify`](http://php.net/manual/fr/function.password-verify.php).


Exercice 6 (bonus) : Vérification des mots de passe côté client
---------------------------------------------------------------

En théorie, la vérification de la similarité des deux mots de passe s'effectue aussi côté client, en Javascript, afin de réduire les requêtes inutiles.

1. Dans `signup.php`, écrivez une fonction javascript `checkPassword` qui récupère le contenu des `input` du mot de passe et de sa confirmation et les compare. Utilisez la fonction [`setCustomValidity`](https://developer.mozilla.org/fr/docs/Web/API/HTMLSelectElement/setCustomValidity) pour mettre à jour la validité du champ de confirmation.
2. Faite exécuter la fonction `checkPassword` à chaque saisie d'un nouveau caractère dans le champ de confirmation. Regardez du côté de l'attribut HTML [`oninput`](https://developer.mozilla.org/fr/docs/Web/API/GlobalEventHandlers/oninput).


Pour les plus rapides
---------------------

- Niveau 1 : Mise en place de fonctions utilitaires pour la redirection et la vérification de la méthode HTTP utilisée dans un fichier `helpers.php`. Pensez au typage !
- Niveau 2 : Ajoutez un fichier de style CSS pour mettre en forme votre formulaire.
- Niveau 3 : Utilisez [Bootstrap](https://getbootstrap.com) pour mettre en forme vos différentes pages.
