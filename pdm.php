<!DOCTYPE html>
<html>
<head>
  <title>Pro-des-Mots</title>
  <meta charset="UTF-8">
</head>
<body>
<form action="pdm.php">
  Recherche:
  <input type="text" name="l">
  <input type="submit" value="Chercher">
  </form>
<PRE>

<?php

// When invoking the script via CLI like "php -f script.php name1=value1 name2=value2", this code will populate $_GET variables called "name1" and "name2", so a script designed to be called by a web server will work even when called by CLI
if (php_sapi_name() == "cli") {
    for ($c = 1; $c < $argc; $c++) {
        $param = explode("=", $argv[$c], 2);
        $_GET[$param[0]] = $param[1]; // $_GET['name1'] = 'value1'
    }
}


function sortc($string)
{
	//$stringParts = str_split($string);
	$stringParts = preg_split('//u', $string, -1, PREG_SPLIT_NO_EMPTY);
	sort($stringParts);
	//return implode('', $stringParts);
	return $stringParts;
}

function verif($mot, $lettres, &$result)
{
	if (mb_strlen($mot) < 2) return;
	if (mb_strlen($mot) > count($lettres)) return;

	$i = 0;
	foreach (sortc($mot) as $c)
	{
		while ($i < count($lettres) && $c !== $lettres[$i])
			$i++;
		if ($i === count($lettres)) return;
		$i++;
	}

	$result[] = $mot;
}

function cherche($fichier, $lettres, &$result)
{
	$handle = fopen($fichier, "r");
	if ($handle) {
		while (($mot = trim(fgets($handle, 4096))) !== false)
		{
			verif($mot, $lettres, $result);
			if (feof($handle)) break;
		}
		fclose($handle);
	}
}


$lettres = $_GET["l"];
if ($lettres != "")
{
	$lettres = sortc(mb_strtolower(trim($lettres)));

	$result = [];
	cherche("mots1.txt", $lettres, $result);
	cherche("mots2.txt", $lettres, $result);

	echo("Résultats pour " . mb_strtoupper(implode('', $lettres)) . "\n");
	for ($i = 1; $i <= count($lettres); ++$i)
	{
		$first = true;
		foreach ($result as $r)
		{
			if ($i === mb_strlen($r))
			{
				if ($first)
				{
					$first = false;
					echo("  $i lettres :");
				}
				echo(" " . mb_strtoupper($r));
			}
		}
		if (! $first)
		{
			echo("\n");
		}
	}
}

?>
</PRE>
</body>
</html>