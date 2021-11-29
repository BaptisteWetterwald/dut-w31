TP6 - Blade, le moteur de vues
==============================

Objectif
--------

Dans le TP précédent, nous avons migrer notre application dans le framework Laravel pour obtenir une version fonctionnelle mais qui ne respecte ni les principes de Laravel, ni les principes MVC.

Dans ce TP6, l'objectif est de mettre en place la partie "Vue" grâce à Blade.

[Toute la documentation officielle se trouve ici](https://laravel.com/docs/8.x/blade)


Exercice 1 : Le layout principal
--------------------------------

1. Dans `resources/views`, créez un répertoire `shared` avec un fichier `message.blade.php` qui :
	- vérifie que la variable `$message` existe et n'est pas nulle
	- si c'est le cas, l'affiche

1. Dans `resources/views`, créez un répertoire `layouts` avec un fichier `app.blade.php` contenant la structure HTML de base et les directives blade suivantes :
	- un élément `<title>` paramétrable avec `@yield`
	- une `@section` pour le contenu principal du corps HTML contenant elle-même déjà un élément `<h1>` identique au `<title>`
	- un `@include` du fichier de la question précédente

Exercice 2 : Les héritiers
--------------------------

Appliquer chaque étape aux quatre fichiers suivants :

- `formpassword.php`
- `signin.php`
- `signup.php`
- `account.php`

1. Renommer le fichier en `.blade.php`.

1. Adapter le fichier en le faisant étendre `app.blade.php `.

Exercice 3 : Les messages comme paramètres
------------------------------------------

À ce stade tout devrait fonctionner excepté les messages qui ne s'affichent plus.

Pour remédier à cela, dans `routes/web.php`, pour chaque directives `view(...)` qui pointent vers l'un des 4 fichier de l'exercice 2, ajoutez en paramètre une variable nommée `message`. Elle a pour valeur le contenu de la variable de session "message" ou `null` si cette dernière n'existe pas.

> Conseil n°1 : Utilisez le second argument des directives `view(...)`.<br>
> Conseil n°2 : Regardez la syntaxe [`??`](https://www.php.net/manual/fr/migration70.new-features.php) de PHP.

Exercice 4 : Finitions
----------------------

1. Afin de rendre les vues totalement indépendantes des sessions, faites-en sorte que la variable de session `user` affichée dans `account.blade.php` soit transmise à la vue dans une variable `$user` depuis `routes/web.php`.

1. Maintenant que Blade est utilisé, nous pouvons remettre en place la vérification CSRF des formulaires. Ajouter la directive requise aux formulaires Blade (voir [CSRF Protection](https://laravel.com/docs/8.x/csrf)) et dé-commenter la ligne correspondante dans `app/Http/Kernel.php`.
