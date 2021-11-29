TP7 - Controller et Middleware
==============================

Objectif
--------

Dans le TP précédent, nous avons mis en place la partie Vue du MVC avec Blade.

Dans ce TP7, nous allons mettre en place la partie Contrôleur du MVC, en créant un contrôleur d'utilisateur auquel nous ferons appel via le contrôleur de routage.


Exercice 1 : Un Middleware d'authentification
---------------------------------------------

> Si besoin, la documentation est ici : [https://laravel.com/docs/8.x/middleware](https://laravel.com/docs/8.x/middleware)

1. Créez le middleware `EnsureMyUserIsAuthenticated` grâce à **artisan** avec la commande suivante (il faut être à la racine de votre projet Laravel) :
	```sh
	$ php artisan make:middleware EnsureMyUserIsAuthenticated
	```

1. Déplacez les instructions de vérification de la variable de session `user` du fichier `routes/web.php` vers la fonction `handle(...)` de `EnsureMyUserIsAuthenticated.php`.

1. Dans `app/Http/Kernel.php`, ajoutez le middleware comme **middleware de routes**, avec pour nom `auth.myuser`.

1. Dans `routes/web.php`, ajoutez le middleware au groupe de routes préfixé `admin`.


Exercice 2 : Un Contrôleur pour les gouverner tous
--------------------------------------------------

1. Créez un contrôleur `UserController` avec la commande suivante (il faut être à la racine du projet Laravel) :
	```sh
	$ php artisan make:controller UserController
	```


Exercice 3 : Le contrôle dans ses plus simples éléments
-------------------------------------------------------

1. Dans `UserController.php`, créez la fonction suivante :
	```php
	/**
	 * Show the signin page
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function signin( Request $request )
	```
et copiez-y le code de la fonction associée à la route `signin` de `routes/web.php`.

1. Modifiez les routes `/` et `signin` de `routes/web.php` pour qu'elles appellent la méthode `signin` du contrôleur `UserController`.

1. Appliquez les deux étapes précédentes aux routes `signup`, `formpassword`, `signout` et `account`.


Exercice 4 : Le contrôle de l'authentification
----------------------------------------------

1. Dans `UserController.php`, créez une fonction `authenticate` sur le même modèle que celles de l'exercice précédent.

1. Copiez le code du fichier `resources/view/authenticate.php` dans la méthode `authenticate` de `UserController.php` et effectuez tous les changements possibles pour utiliser :
	- l'objet `$request` pour manipuler les données GET et POST transmises par l'utilisateur (voir [HTTP Requests](https://laravel.com/docs/8.x/requests))
	- la directive [`redirect`](https://laravel.com/docs/8.x/responses#redirects) de Laravel au lieu de `header`.

1. Les exceptions ne sont plus "catchées". Pour que le mécanisme fonctionne à nouveau, remplacez tous les `Exception` et `PDOException` par `\Exception` et `\PDOException`. Pour en savoir plus, regardez les explications sur l'[espace de noms global](https://www.php.net/manual/fr/language.namespaces.global.php)).

1. Supprimez le fichier `resources/view/authenticate.php`.

1. Appliquez l'ensemble des étapes étapes précédentes aux routes `adduser`, `changepassword` et `deleteuser`.


Exercice 5 : Les routes nommées
-------------------------------

L'objectif des routes nommées est de décorréler l'URL d'une route de la façon de la mentionner dans votre application.

1. Nommez toutes les routes dans `routes/web.php` ([voir doc ici](https://laravel.com/docs/8.x/routing#named-routes)).

1. Dans `UserController.php` et `EnsureMyUserIsAuthenticated.php`, modifiez toutes les redirections pour faire appel aux routes nommées en utilisant `redirect()->route(...)`.

1. Dans toutes les vues, replacez toutes les références à des routes par des références à des routes nommées avec `{{ route(...) }}`


Exercice 6 : Les sessions selon Laravel
---------------------------------------

Cet exercice va permettre de déléguer l'intégralité de la gestion des sessions à Laravel (qui fait ça très bien), avec pour effet de rendre le code plus lisible.

Le choix vous est laissé d'utiliser les sessions à travers l'objet `$request->session()` ou à travers la fonction globale `session` (voir la documentation disponible sur la page [HTTP Session](https://laravel.com/docs/8.x/session)).

1. Remplacez tous les appels au tableau `$_SESSION` du fichier `UserController.php` par l'utilisation des sessions de Laravel. En particulier :
	- utilisez [`put`](https://laravel.com/docs/8.x/session#storing-data) pour sauvegarder le nom de l'utilisateur
	- détruisez les sessions avec [`flush`](https://laravel.com/docs/8.x/session#deleting-data)
	- utilisez le second paramètre de la directive `view` et combiner `with` avec `redirect` pour transmettre les messages d'information et le nom de l'utilisateur. Vous n'avez plus besoin de supprimez les messages de la session.

> Note : À ce stade, l'authentification ne fonctionne plus.

1. Faite de même pour le middleware `EnsureMyUserIsAuthenticated.php`.

> Note : Maintenant l'authentification fonctionne.

1. Finalement, supprimez l'appel à `session_start()` du fichier `routes/web.php` et supprimez le groupe global.


**Félicitation : votre application est maintenant entièrement MVC !**
