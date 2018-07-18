Cherche les mots qu'on peut faire avec un ensemble de lettres.

Pour installer un dictionnaire:

```bash
# télécharge le dico, extrait le premier fichier du .zip, filtre un peu et crée deux fichiers mots1.txt et mots2.txt
curl -s http://www.lexique.org/public/Lexique381.zip | funzip 2>/dev/null | cut -f1 | grep -v '[-_]' | tr " " "\n" | sort -u | sed -e '1,60000w mots1.txt' -e '60000,$w mots2.txt' -e 'd'
```

