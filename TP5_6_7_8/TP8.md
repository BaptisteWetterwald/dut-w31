TP8 - Eloquent ORM
==================

Objectif
--------

Dans le TP précédent, nous avons mis en place la partie Contrôleur de notre application Laravel qui est maintenant totalement MVC.

Dans ce TP8, l'objectif est d'utiliser les fonctionnalités de l'ORM Eloquent pour gérer les modèles sans se soucier de leur enregistrement en base de données.


Exercice 1 : Un utilisateur qui manie le verbe
----------------------------------------------

Pour cet exercice, référez-vous aux documentations sur [la migration](https://laravel.com/docs/8.x/migrations) et sur [Eloquent ORM](https://laravel.com/docs/8.x/eloquent).

1. Supprimez tous les fichiers du répertoire `databases/migrations`.

1. Créez un modèle d'utilisateur `UserEloquent` avec artisan et générez le fichier de migration en une seule commande :
	```sh
	$ php artisan make:model UserEloquent -m
	```

1. Modifiez le fichier de migration `database/migrations/2020_..._create_user_eloquents_table.php` pour avoir une table :
	- qui s'appelle `UserEloquent`,
	- qui possède un champ numérique `user_id` qui est clé primaire,
	- qui possède un champs varchar `user` unique,
	- qui possède un champ varchar `password` de taille 256.

1. Effectuez la migration avec la commande :
	```sh
	$ php artisan migrate
	```
	et vérifiez que la table `UserEloquent` a bien été créée avec `sqlite3` ou `sqlitebrowser`.

1. Dans `app/Models/UserEloquent.php`, indiquez :
	- que la table s'appelle `UserEloquent`
	- que la clé primaire s'appelle `user_id`
	- qu'il n'y a pas de `timestamps` dans les attributs

> Note : pour effectuer une nouvelle migration (qui supprimera également toutes les données) utilisez la commande suivante :
> ```sh
>	$ php artisan migrate:fresh
> ```

Exercice 2 : De MyUser à UserEloquent
-------------------------------------

Cet exercice a pour objectif de remplacer l'utilisation du modèle `MyUser` par `UserEloquent` dans `UserController.php`.

1. Commencez par effectuer le remplacement dans la méthode `addUser` en :
	- réintroduisant le principe de `password_hash` mais avec la [facade `Hash`](https://laravel.com/docs/8.x/hashing) de Laravel,
	- "try-catchant" les exceptions de type `\Illuminate\Database\QueryException` pouvant survenir lors de la sauvegarde du nouvel utilisateur.

1. Continuez avec la méthode `authenticate` en :
	- utilisant `firstOrFail()` pour déclencher une exception de type `\Illuminate\Database\Eloquent\ModelNotFoundException` (à "try-catcher") lorsque l'utilisateur n'est pas trouvé dans la BDD
	- réintroduisant la méthode `password_verify` mais avec la [facade `Hash`](https://laravel.com/docs/8.x/hashing) de Laravel,

1. Poursuivez avec `changePassword` en :
	- réintroduisant la méthode `password_hash`mais avec la [facade `Hash`](https://laravel.com/docs/8.x/hashing) de Laravel,
	- "try-catchant" les exceptions de type `\Illuminate\Database\QueryException` pouvant survenir lors de la sauvegarde de l'utilisateur.

1. Modifiez enfin `deleteUser` en utilisant `firstOrFail()` pour déclencher une exception de type `\Illuminate\Database\Eloquent\ModelNotFoundException` (à "try-catcher") lorsque l'utilisateur n'est pas trouvé dans la BDD.

1. Finalement, supprimez le fichier `MyUser.php` et toutes les instructions qui y font référence.


Exercice 3 : Un UserEloquent en session
---------------------------------------

Actuellement, nous considérons qu'un utilisateur est connecté si on a stocké son login en session. Cet exercice a pour but de stocker directement l'objet UserEloquent en session, ce qui aura pour conséquence de réduire le nombre de requêtes et de simplifier l'écriture des contrôleurs et des vues.

Modifiez :
- les méthodes `authenticate` pour sauvegarder l'objet UserEloquent en session
- les méthodes `changePassword` et `deleteUser` pour manipuler directement l'utilisateur stocké en session
- la vue `account.blade.php` pour d'adapter l'affichage du login de l'utilisateur connecté
