# http://www.freelang.com/dictionnaire/dic-francais.php
#wget http://www.freelang.com/download/misc/liste_francais.zip
#unzip -p ../liste_francais.zip liste_francais.txt | iconv -f iso-8859-1 -t utf-8 | grep -v "[A-Z]" > mots.txt


#
cut -f1 ../Lexique381.txt | grep -v '[-_]' | tr " " "\n" | sort -u > mots.txt