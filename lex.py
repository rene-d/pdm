#! /usr/bin/env python3

import sys
import csv

if len(sys.argv) < 2:
    exit()

lettres = sys.argv[1]
lettres = sorted(lettres)
print("Recherche pour {}".format(' '.join(lettres)))

longueurs = set()
if len(sys.argv) > 2:
    for i in sys.argv[2:]:
        longueurs.add(int(i))

mots = []

def verif(mot):
    if len(mot) < 2: return
    if len(mot) > len(lettres): return
    if len(longueurs):
        if len(mot) not in longueurs: return
    i = 0
    for c in sorted(mot):
        while i < len(lettres) and c != lettres[i]:
            i += 1
        if i == len(lettres): return
        i += 1
    mots.append(mot)

def old():
  with open("Lexique381.txt") as f:
    r = csv.reader(f, delimiter='\t')
    row = next(r)
    last = ""
    for row in r:
            mot = row[0]
            if mot == last: continue
            last = mot
            verif(mot)

for dico in ['mots1.txt', 'mots2.txt']:
    with open(dico) as f:
        for mot in f:
            verif(mot.strip())

for i in range(2, len(lettres) + 1):
    for m in mots:
        if len(m) == i:
            print(m)
