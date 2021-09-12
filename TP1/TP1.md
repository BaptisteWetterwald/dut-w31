TP n°1 : requêtes GET/POST, cookies et sessions
===============================================

Afin de lancer un serveur local PHP, suivez les instructions de [PHPLOCAL.md](./PHPLOCAL.md).

Exemple :
- Je crée un répertoire `TP1` qui contiendra les fichiers du 1er TP
- J'ouvre un terminal et me rend dans ce répertoire :
```bash
$ cd /home/.../TP1/
```
- Je lance un serveur PHP avec la commande :
```bash
$ php -S localhost:port -t .
```
avec `port` un entier compris entre 1025 et 65535.
- J'ouvre un navigateur à l'adress `http://localhost:port`

Exercice 1 - Bonjour
--------------------

1. Écrivez un fichier PHP `bonjour.php` qui contient uniquement du code HTML5 **valide**. Visualisez-le avec Postman puis avec votre navigateur.

2. Écrivez un fichier `bonjourGet.php` qui contient la structure de base d'un fichier HTML5 valide.
	- Dans le `<body>`, ajoutez du code PHP qui affiche le contenu de la variable `module` du tableau `$_GET`.
	- Testez avec Postman et votre navigateur, en transmettant ou non une variable via la méthode `GET`.
	- Ajoutez un **test** pour vérifier que la variable existe et n'est pas vide et affichez un message si la condition n'est pas remplie.
	- **Sécurisez** la variable

3. Écrivez un fichier `bonjourPost.php` qui contient la structure de base d'un fichier HTML5 valide.
	- Affichez le contenu des variables `firstname` et `lastname` du tableau `$_POST` dans le `<body>`
	- Testez avec Postman en transmettant 0, 1 ou les 2 variables via la méthode `POST`
	- Ajoutez le test d'existence des deux variables et **sécurisez-les**.

4. Écrivez un fichier **HTML** `formulaire.html` qui contient un formulaire demandant à l'utilisateur son nom et son prénom avec des balises `<input>` de type texte. Ce formulaire doit avoir pour **action** le fichier `bonjourPost.php`. Testez avec votre navigateur l'affichage du formulaire et ce qu'il se produit lorsque vous le soumettez.

5. Dans `bonjourPost.php`, ajoutez **en tout début de fichier** un test pour vous assurer que la page est demandée via la méthode POST du protocole HTTP (regardez la doc du tableau [`$_SERVER`](https://www.php.net/manual/fr/reserved.variables.server.php)). Si ce n'est pas le cas, effectuez une demande de redirection vers la page `formulaire.html` (regardez la doc de la directive [`header`](http://php.net/manual/fr/function.header.php)).


Exercice 2 - Générer une liste
------------------------------

1. Écrivez un fichier PHP `liste.php` qui produit un document HTML contenant
**une liste de 10 items** générés en PHP avec une boucle `for`. Testez avec Postman et votre navigateur.

2. Écrivez un fichier PHP `listeGet.php` similaire à `liste.php`, où le
nombre d'items à générer est disponible dans **la variable `nbItems` du tableau `$_GET`**. Testez avec Postman et un navigateur. Pensez à ajouter un test pour vérifier que votre variable est un entier et transtypez-la (cast).

3. Écrivez un fichier PHP `listePost.php` similaire à `liste.php`, où le
nombre d'items à générer est disponible dans **la variable `nbItems` du tableau `$_POST`**. Testez avec Postman.

4. Testez le 3. avec votre navigateur. Pour cela, créez un fichier PHP contenant un **formulaire** avec `listesPost.php` pour action.


Exercice 3 - Compteur de visites en session
-------------------------------------------

1. Écrivez un fichier PHP `counter.php` qui :
	- crée ou rétablit une session PHP pour le client
	- initialise ou incrémente la variable `$counter` qui sert de compteur
	- affiche le nombre de fois que le fichier a été demandé.

	Testez avec Postman et le navigateur en appellant plusieurs fois la page `counter.php`. Le chiffre indiqué doit augmenter de 1.

2. Écrivez un fichier PHP `resetCounter.php` qui :
	1. réinitialise le compteur présent dans la session
	2. effectue une demande de redirection vers le fichier `counter.php` (regardez la doc de la directive [`header`](http://php.net/manual/fr/function.header.php)).

	> **Note** : ce script doit contenir exactement 3 instructions.

3. Ajoutez un lien HTML vers le script `resetCounter.php` dans le `<body>` renvoyé par `counter.php`. Testez dans votre navigateur.

4. Dans Postman ou votre navigateur, supprimez le cookie de session `PHPSSID` puis rechargez la page. Que se passe-t-il ?

5. Réalisez un schéma comportant un navigateur, un serveur web et un module PHP. Présentez à l'aide de flèches et de numéros la série de requêtes/réponses qui sont échangées lorsque vous cliquez sur le lien ajouté à la question 3. Pour chaque numéro :
	- expliquer brièvement l'objet de la requête/réponse : qui envoie/réceptionne ?
	- indiquez le contenu de la requête/réponse : entête, corps, variables, etc.


Exercice 4 - Compteur de visites dans un cookie
-----------------------------------------------

Faites les questions 1 à 3 de l'exercice 3 sans utiliser les sessions mais uniquement un cookie qui contient la variable `counter`.
