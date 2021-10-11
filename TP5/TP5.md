TP5 - Prise en main de Laravel
==============================

Objectif
--------

Intégrer l'application d'authentification au framework Laravel.
Vous pouvez vous baser au choix :

- sur vos propres sources résultant du TP4
- sur la proposition du répertoire [correction/TP4](correction/TP4)

Notez que le but de ce TP est d'obtenir une application fonctionnelle **mais qui ne respectera pas encore le découpage MVC**.

Les TPs suivants permettront de séparer progressivement les parties Modèle, Vue et Contrôleur en utilisant à bon escient les fonctionnalités offertes par Laravel.


Exercice 1 : Installation
-------------------------

Suivez les indications données dans [LARAVEL-installation.md](LARAVEL-Installation.md).

**Attention : `composer` n'est installé que sur webetu, pas sur troglo.**


Exercice 2 : Préparation des vues
---------------------------------

1. Copiez les fichiers suivants du TP4 dans `resources/views/` :
	- `account.php`
	- `adduser.php`
	- `authenticate.php`
	- `changepassword.php`
	- `deleteuser.php`
	- `formpassword.php`
	- `signin.php`
	- `signout.php`
	- `signup.php`

1. Dans `routes/web.php` :
	- Écrivez les routes GET et POST pour les fichiers ci-dessus (ne pas utiliser `Route::view`)
	- Faites en sorte qu'une requête vers la racine du site propose la vue `signin.php`
	- Testez toutes les routes GET. Regardez ce qu'il se passe lorsqu'on demande une route qui n'a pas été prévue dans `routes/web.php`

1. Dans chaque fichier, remplacez toutes les références à des fichiers PHP par des références à des routes.

1. Dans le fichier `app/Http/Kernel.php`, commenter les lignes qui font référence au middleware `VerifyCsrfToken`.


Exercice 3 : Modèle MyUser et PDO
---------------------------------

1. Copiez le fichier de BDD sqlite `tp4.db` du TP4 dans `database/tp5.db`.

1. Dans le fichier `.env`,  modifiez les champs `DB_CONNECTION` et `DB_DATABASE` avec les informations de l'ancien fichier `bdd.php` et en suivant [cette documentation](https://laravel.com/docs/8.x/database).

1. Copiez le fichier `models/User.php` du TP4 dans le répertoire `app/Models` de votre application et renommez-le `MyUser.php`. **Attention, n'écrasez pas le fichier `User.php` existant déjà dans ce répertoire.**

1. Dans `MyUser.php` :
	- déclarez le namespace `App\Models`
	- remplacez le nom de la classe par `MyUser`
	- remplacer les `User::USER_TABLE` par `MyUser::USER_TABLE`
	- remplacer tous les `MyPDO::pdo()` par `DB::connection()->getPdo()`
	- ajouter en entête les deux `use` suivants :
		```php
		use Illuminate\Support\Facades\DB;
		use PDO;
		```

1. Dans chacun des fichiers `adduser.php`, `authenticate.php`, `changepassword.php`, `deleteuser.php` et `signout.php` :
	- remplacer les `require_once('models/User');` par des `use App\Models\MyUser;`
	- remplacer les `new User` par des `new MyUser`

**À ce stade, l'application devrait être entièrement fonctionnelle. Solutionner les problèmes avant de passer à la suite.**

> Note : il est important d'avoir des `exit()` après chaque `header("Location: xxx")`... même si c'est la dernière instruction du fichier.

Exercice 4 : Le grand nettoyage
-------------------------------

1. Supprimer toutes les vérifications de `REQUEST_METHOD` de tous vos fichiers : c'est maintenant le routage qui le gère.

1. Supprimer tous les `session_start()` de tous vos fichiers.

1. Dans `routes/web.php`, mettre toutes les routes dans un groupe. Dans la fonction qui contient les routes de ce groupe, ajouter en première instruction un `session_start()`.

1. Dans `routes/web.php`, remplacer l'appel à la vue `signout` par le code du fichier `signout.php` et remplacer l'appel à `header()` par un appel à la méthode `redirect()` de Laravel. Supprimer `signout.php`.

1. Dans `routes/web.php`, placer les routes `changepassword`, `deleteuser`, `formpassword`, `account` et `signout` dans un groupe préfixé par `admin`. Ajouter `admin/` à ces routes dans tous les `header()` de tous vos fichiers de vues.

1. Ajouter au début de la fonction du groupe `admin` la vérification de l'existence de la variable de session `user`. Si elle n'existe pas, faire une redirection vers `signin` en utilisant `redirect` de Laravel.

**Vérifier que tout fonctionne.**
