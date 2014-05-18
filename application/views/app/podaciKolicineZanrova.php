<?php //definiše se mime type
header("Content-type: application/json");?>{
"cols": [
{"label":"Naziv zanra","type":"string"},
{"label":"Kolicina ponuda","type":"number"}
],
"rows": [
<?php
//konekcija ka bazi
require_once "konekcija.php";
//priprema upita
$sql="SELECT SUM(kolicina) as kolicina, nazivZanra FROM knjige INNER JOIN zanr ON knjige.zanr_id = zanr.zanr_id GROUP BY nazivZanra";
//izvršavanje upita
if (!$q=$mysqli->query($sql)){
//ako se upit ne izvrši
echo ("Došlo je do greške pri izvršavanju upita.");
} else {
//ako je upit u redu
$broj_redova = $q->num_rows;
if ($broj_redova>0){
//ako ima rezultata u bazi
$niz = array();
$brojac = 1;
while ($red=$q->fetch_object()){
if ($brojac < $broj_redova){
//ako nije poslednji element
$red_json = '{"c":[{"v":"'.$red->nazivZanra.'"},{"v":'.$red->kolicina.'}]}'.',';
echo $red_json;
echo "\n";
} else {
//ako je poslednji element
$red_json = '{"c":[{"v":"'.$red->nazivZanra.'"},{"v":'.$red->kolicina.'}]}';
echo $red_json;
echo "\n";
}
$brojac++;
}
?>
<?php
}
}
//zatvaranje konekcije
$mysqli->close();
?>]
}