<?php //definiše se mime type
header("Content-type: application/json");?>{
"cols": [
{"label":"Godina","type":"string"},
{"label":"Kolicina prodatih knjiga","type":"number"},
{"label":"Ukupan prihod","type":"number"}
],
"rows": [
<?php
//konekcija ka bazi
require_once "konekcija.php";
//priprema upita
$sql="SELECT COUNT(id_kk) as kolicina, SUM(cena) as prihod, YEAR(datum_kupovine) as godina FROM kupljene_knjige INNER JOIN knjige ON kupljene_knjige.knjiga_id = knjige.id_knjige GROUP BY godina";
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
$red_json = '{"c":[{"v":"'.$red->godina.'"},{"v":'.$red->kolicina.'},{"v":'.$red->prihod.'}]}'.',';
echo $red_json;
echo "\n";
} else {
//ako je poslednji element
$red_json = '{"c":[{"v":"'.$red->godina.'"},{"v":'.$red->kolicina.'},{"v":'.$red->prihod.'}]}';
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