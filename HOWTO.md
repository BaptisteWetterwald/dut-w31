"*M'sieur, comment...*
======================

#### *... j'affiche l'état de mon clône ?"*

```sh
git status
```

#### *... j'ajoute des fichiers à prendre en compte au prochain commit ?"*

```sh
git add [file]
```

#### *... je commite (sauvegarde localement) mes modifications ?"*

```sh
git commit -m "[message qui DÉTAILLE les modifications]"
```
ATTENTION : Seuls les fichiers préalablement ajoutés seront sauvegardés.

#### *... je pousse mes commits sur Gitlab (sauvegarde distante) ?"*

```sh
git push origin master
```

#### *... je récupère localement les fichiers que vous avez ajouté ?"*

```sh
git pull prof master
```

#### *... je récupère sur ordinateur2 ce que j'ai fait sur ordinateur1 ?"*

1. Je **commite** sur ordinateur1 et **pousse** vers Gitlab (voir ci-dessus)
2. Je **tire** sur ordinateur2 ce qui est maintenant sur Gitlab
	```sh
	git pull origin master
	```
