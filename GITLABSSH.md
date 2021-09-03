SSH et Giltab
=============

Cette procédure permet d'utiliser l'authentification par clé SSH plutôt que de taper ses login et mot de passe à chaque requête vers Gitlab (push, pull, etc.). Elle comporte deux étapes détaillées ci-dessous :

1. Créer une clé SSH pour votre compte utilisateur
2. Copier la clé publique dans Gitlab

Si vous utilisez Gitlab à partir de plusieurs comptes (ordi de l'IUT, ordi perso, etc.), la procédure suivante est à répéter pour chaque compte.

1 - Créer une clé SSH
---------------------

1. Dans un terminal, tapez la commande suivante :
```
login@ordi:~$ ssh-keygen -b 4096 -C [nom de la clé]
```
Pour chaque question, laissez vide et validez :
```
Generating public/private rsa key pair.
Enter file in which to save the key (/.../login/.ssh/id_rsa):
Enter passphrase (empty for no passphrase):
Enter same passphrase again:
Your identification has been saved in /.../login/.ssh/id_rsa.
Your public key has been saved in /.../login/.ssh/id_rsa.pub.
The key fingerprint is:
SHA256:f3FTQpO9zwSY4DS2rIc1qT687x9C8CsuTD8MB61ogyU [nom de la clé]
The key's randomart image is:
+---[RSA 4096]----+
|          =. ooo |
|   B     = +o.o..|
|       .. B   ..o|
|  E . . .B .   +.|
|   + . oS + . oo.|
|  . + +o.+ . o .o|
|   . + == + o    |
|      o.++ o .   |
|       .o+o..    |
+----[SHA256]-----+
```

2. Deux fichiers (au moins) sont alors créés dans votre répertoire `/.../login/.ssh/` :
```
login@ordi:~$ ls ~/.ssh
... id_rsa  id_rsa.pub ...
```

- `id_rsa` contient votre clé privé : ne jamais la communiquer !
- `id_rsa.pub` contient votre clé publique : vous pouvez la communiquer au monde entier.

2 - Copier la clé publique dans Gitlab
--------------------------------------

*Un GIF illustrant les 8 points suivants est disponible dans `images/sshGitlab.gif`.*

1. Connectez-vous sur Gitlab avec vos identifiants Unistra : https://git.unistra.fr
2. Cliquez sur l'icône en haut à droite de l'écran
3. Cliquez sur le menu "Settings" ("Paramètres")
4. Dans le menu à gauche de l'écran, cliquez sur le menu "SSH Keys" ("Clés SSH")
5. Dans un terminal, affichez votre clé avec la commande suivante :
```
login@ordi:~$ cat ~/.ssh/id_rsa.pub
ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAACAQC3GZATo37T8jZVwV14k3luTLmXZUaKeUVFxqBBOow+0i1FcHmDEakdmTC6gz5iZt/o7oht8bdFFDxkroM7IkpiJ7Yb4WGBfhnw232L7U8oWb/4Wu17JZ/qeMXmUwZuSk7utX0ucW9SKOuTPID1qtJXOTrqSiiueK4BmPtAQEVI0DB5lo1q4/RNQwLAuGU06i2B9k+Fk6NWjcbWoDyNltbyvmosCpmmjNXYxiCP6GYYnEeUUBkZGoMRhwcZCG0tSm26X9oUqkauD8daY9Y+0W6xysrkEe2HVb+Aqv2ljV+L1Vnftor1VuhAwQD+LPAmUGoh2VcWMT37lOWxYOYLbf93rTwcPZKGsGQwljwVdl4cfK6+UzNU2h4/u1+YvNtEBj2eVw55AQPz34IMXmiBTa4MuKSBp9Di0ZWfiAjNEzHvzxC7l9+Uqfo/YlEWnGocfrci0dPXGJGaRNEF85BIIm+YkmMP2LRbKgCLYt3x8a/7ba56barUWs9N5rjFZ1BikPfCBCuTXR8rX/8RKBQQj0g/yqoTg6TggQ6jou5U5oQ54NpSCQZntIJ6b8ub+V9Cni1NWmURoBqEDnoxXomGJokJLhwMNqHi0Quc5OMSbZW9CNaNbv5uPrZxNfcfnD5pA0LhId3S2VlS/YxCc8iYyPj6vDwBZw43ipwk2tU8pOOHAQ== [nom de la clé]
```
6. Copiez-collez votre clé `ssh-rsa AAAA...AQ== [nom de la clé]` dans le champ "Key" ("Clé") sur Giltab
7. Cliquez sur le bouton "Add key" ("Ajouter la clé")
8. C'est terminé : vous recevez dans la foulée un mail vous indiquant qu'une clé ssh a été ajoutée.
