# http://www.freelang.com/dictionnaire/dic-francais.php
#wget http://www.freelang.com/download/misc/liste_francais.zip
#unzip -p ../liste_francais.zip liste_francais.txt | iconv -f iso-8859-1 -t utf-8 | grep -v "[A-Z]" > mots.txt

# télécharge le dico, extrait le premier fichier du .zip, filtre un peu et crée deux fichiers mots1.txt et mots2.txt
curl -s http://www.lexique.org/public/Lexique381.zip | funzip 2>/dev/null | cut -f1 | grep -v '[-_]' | tr " " "\n" | sort -u | sed -e '1,60000w mots1.txt' -e '60000,$w mots2.txt' -e 'd'
