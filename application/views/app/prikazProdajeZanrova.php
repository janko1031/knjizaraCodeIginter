<!DOCTYPE html>
<html>
<head>
<meta http-equiv='Content-Type' content='Type=text/html; charset=utf-8'>
<title>Podaci</title>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!--Ucitava se JQuery biblioteka-->
<script type="text/javascript" src="jquery-1.8.3.min.js"></script>

<script type="text/javascript">  
// Ucitava se API za vizuelizaciju
google.load('visualization', '1', {'packages':['corechart']});  
// Šalje povratni poziv kada se ucita API
google.setOnLoadCallback(drawChart);
// Funkcija šalje asinhrono JSON podatke, koje PHP fajl podaci.php generiše iz baze
function drawChart() {
var jsonData = $.ajax({
url: "podaciKolicineZanrova.php",
dataType:"json",
async: false
}).responseText;  
// Kreira se tabela sa podacima na osnovu poslatih JSON podataka
var data = new google.visualization.DataTable(jsonData);
// Instancira se grafikon (Column Chart je grafikon sa vertikalnim linijama) i prosleduju mu se parametri, ukljucujuci i ID div-a gde ce
// grafikon biti prikazan
var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
//var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
//var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
chart.draw(data, {width: 600, height: 400});

function selectHandler() {
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
            var naziv = data.getValue(selectedItem.row, 0);
			var vrednost = data.getValue(selectedItem.row, 1);
            alert('Za izabrani zanr ' + naziv + ' dostupno je jos ' + vrednost + ' knjiga razlicitih naslova.');
          }
        }


 google.visualization.events.addListener(chart, 'select', selectHandler);

}


</script>

<script type="text/javascript">  
// Ucitava se API za vizuelizaciju
google.load('visualization', '1', {'packages':['corechart']});  
// Šalje povratni poziv kada se ucita API
google.setOnLoadCallback(drawChart1);
// Funkcija šalje asinhrono JSON podatke, koje PHP fajl podaci.php generiše iz baze
function drawChart1() {
var jsonData1 = $.ajax({
url: "podaciProdatihZanrova.php",
dataType:"json",
async: false
}).responseText;  
// Kreira se tabela sa podacima na osnovu poslatih JSON podataka
var data1 = new google.visualization.DataTable(jsonData1);
// Instancira se grafikon (Column Chart je grafikon sa vertikalnim linijama) i prosleduju mu se parametri, ukljucujuci i ID div-a gde ce
// grafikon biti prikazan
var chart1 = new google.visualization.PieChart(document.getElementById('chart_div1'));
//var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
//var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
chart1.draw(data1, {width: 600, height: 400});
}

</script>

<script type="text/javascript">  
// Ucitava se API za vizuelizaciju
google.load('visualization', '1', {'packages':['corechart']});  
// Šalje povratni poziv kada se ucita API
google.setOnLoadCallback(drawChart2);
// Funkcija šalje asinhrono JSON podatke, koje PHP fajl podaci.php generiše iz baze
function drawChart2() {
var jsonData2 = $.ajax({
url: "podaciOProdajiTokomGo	dina.php",
dataType:"json",
async: false
}).responseText;  
// Kreira se tabela sa podacima na osnovu poslatih JSON podataka
var data2 = new google.visualization.DataTable(jsonData2);
// Instancira se grafikon (Column Chart je grafikon sa vertikalnim linijama) i prosleduju mu se parametri, ukljucujuci i ID div-a gde ce
// grafikon biti prikazan
var chart2 = new google.visualization.LineChart(document.getElementById('chart_div2'));
//var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
//var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
chart2.draw(data2, {width: 600, height: 400});
}

</script>
</head>


<br/>
<br/>
<body>
<br/>
<br/>
<br/>
<h2>Prikaz dijagrama dostupnih kolicina odredjenog zanra:</h2>
<br/>
<br/>


		<div id="chart_div"></div>
		<p>Prelaskom mišem preko određenog dela dijagrama prikazuje se naziv zanra, broj dostupnih knjiga tog zanra kao i procenat koji taj zanr zauzima u celokupnoj ponudi.<p>


<br/>
<br/>
<br/>
<br/>
<h2>Prikaz dijagrama prodatih kolicina odredjenog zanra:</h2>
<br/>
<br/>


		<div id="chart_div1"></div>
		<p>Prelaskom mišem preko određenog dela dijagrama prikazuje se naziv zanra, broj prodatih knjiga tog zanra kao i procenat koji taj zanr zauzima u celokupnoj prodaji.<p>


<br/>
<br/>
<br/>


		<div id="chart_div2"></div>
</body>
</html>