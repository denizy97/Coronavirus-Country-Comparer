<?php
/*This file is written in 2020 by Deniz YILDIRIM <denizy@protonmail.com>*/
    $array = array();
    $cases = array();
    $deaths = array();
    $country_list = array();
    $DATE_COL = 4;
    
    //Get cases
    $url = "https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_covid19_confirmed_global.csv";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $csv = curl_exec($ch);
    $lines = explode(PHP_EOL, $csv);
    curl_close($ch);
    foreach ($lines as $line) {
        $array[] = str_getcsv($line);
    }
    
    for ($i = 1; $i < sizeof($array); $i++){
        if(empty($array[$i][0])){
            if(!array_key_exists($array[$i][1], $cases)){
                $country_list[] = $array[$i][1];
            }
                $cases[$array[$i][1]] = array_slice($array[$i], $DATE_COL);
        }
        //if separated into provinces, add them together.
        else{
            if(array_key_exists($array[$i][1], $cases)){
                $province_cases = array_slice($array[$i], $DATE_COL);
                for ($j = 0; $j < sizeof($cases[$array[$i][1]]); $j++){
                    $cases[$array[$i][1]][$j] += $province_cases[$j];
                }
            }
            else{
                $country_list[] = $array[$i][1];
                $cases[$array[$i][1]] = array_slice($array[$i], $DATE_COL);
            }
        }
    }
    $array = array();
    //Get deaths
    $url = "https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_covid19_deaths_global.csv";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $csv = curl_exec($ch);
    $lines = explode(PHP_EOL, $csv);
    curl_close($ch);
    foreach ($lines as $line) {
        $array[] = str_getcsv($line);
    }
    
    for ($i = 1; $i < sizeof($array); $i++){
        if(empty($array[$i][0])){
            $deaths[$array[$i][1]] = array_slice($array[$i], $DATE_COL);
        }
        //if separated into provinces, add them together.
        else{
            if(array_key_exists($array[$i][1], $deaths)){
                $province_deaths = array_slice($array[$i], $DATE_COL);
                for ($j = 0; $j < sizeof($deaths[$array[$i][1]]); $j++){
                    $deaths[$array[$i][1]][$j] += $province_deaths[$j];
                }
            }
            else{
                $deaths[$array[$i][1]] = array_slice($array[$i], $DATE_COL);
            }
        }
    }
    
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Corona Comparer</title>
	<style>
	    .column {
            float: left;
            width: 33%;
	    }
	    .bigcolumn {
            float: right;
            width: 66%;
	    }
	</style>
</head>
<body>
<h1 style="text-align: center;">COVID-19 Country Comparison</h1>
<hr>
<p style="text-align: justify;">Updated once a day so data might not be current.</p>
<p style="text-align: justify;">Data is taken from <a href="https://github.com/CSSEGISandData/COVID-19">John Hopkins University's Github repository for COVID-19</a>. Check their map at <a href="https://coronavirus.jhu.edu/map.html">here</a>.</p>
<p style="text-align: justify;">Made by Deniz Yıldırım (denizy@protonmail.com)</p>
<p style="text-align: justify;">Source code is <a href="https://github.com/denizy97/Coronavirus-Country-Comparer">here</a>.</p>
<hr>
<div class="column">
    <h3 style="text-align:center;">Instructions</h3>
    <p style="text-align: justify;">1)From below, select countries you want to compare (US and Italy are selected by default as an example).</p>
    <p style="text-align: justify;">2)In the graphs, Day 0 is the first day each country passed a selected amount of cases. 100 is the default, for countries with a lot of cases 1000 is also a good number, on the other hand if one of the countries you compare has less cases you might want to turn it even lower. You can change it in the box below.</p>
    <p style="text-align:center;"><input type="number" autocomplete="off" id="startcase" value=100></p>
    <p style="text-align: justify;">3)When you are done, press the Compare button below.</p>
    <p style="text-align:center;"><button onclick="recalculate()">Compare</button> <button onclick="resetAll()">Clear Selections</button></p>
    <div class="column">
        <?php
            for ($i=0; $i < floor(sizeof($country_list)/3); $i++){
                echo("<p><input type=\"checkbox\" autocomplete=\"off\" id=\"" . $country_list[$i] . "\" onclick=\"myFunction()\">" . $country_list[$i] . "</p>");
            }
        ?>
    </div>
    <div class="column">
        <?php
            for ($i=floor(sizeof($country_list)/3); $i < floor(2*sizeof($country_list)/3); $i++){
                echo("<p><input type=\"checkbox\" id=\"" . $country_list[$i] . "\" onclick=\"myFunction()\">" . $country_list[$i] . "</p>");
            }
        ?>
    </div>
    <div class="column">
        <?php
            for ($i=floor(2*sizeof($country_list)/3); $i < sizeof($country_list); $i++){
                echo("<p><input type=\"checkbox\" id=\"" . $country_list[$i] . "\" onclick=\"myFunction()\">" . $country_list[$i] . "</p>");
            }
        ?>
    </div>
</div>
<div class="bigcolumn">
    <canvas id="lineGraph"></canvas><!-- Line Graph -->
    <canvas id="logGraph"></canvas><!-- Logarithmic Graph -->
    <canvas id="DeathPercentGraph"></canvas><!-- Logarithmic Graph -->
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>
resetAll();
document.getElementById("US").checked = true;
document.getElementById("Italy").checked = true;
var linearctx = document.getElementById('lineGraph').getContext('2d');
var linearChart = new Chart(linearctx);
var logctx = document.getElementById('logGraph').getContext('2d');
var logChart = new Chart(logctx);
function recalculate() {
    linearChart.destroy();
    logChart.destroy();
    //Get data
    var cases = <?php echo json_encode($cases); ?>;
    var deaths = <?php echo json_encode($deaths); ?>;
    var selectable_countries = Object.keys(cases);
    //document.write(selectable_countries);
    //get countries from user
    var compared_countries = [];
    for (i = 0; i < selectable_countries.length; i++){
        if (document.getElementById(selectable_countries[i]).checked){
            compared_countries.push(selectable_countries[i]);
        }
    }
    
    var start_case = parseInt(document.getElementById("startcase").value); //get from user
    var datas = [];
    var days = [];
    var biggestday = 0;
    //document.write(JSON.stringify(cases));
    
    //cut days before the start case
    //create datasets and labels
    for (i = 0; i < compared_countries.length; i++){
        var j = 0;
        var countrycolor = "";
        if (compared_countries.length == 1){
            countrycolor = "00";
        }
        else{
            countrycolor = (i*Math.floor(255/(compared_countries.length-1))).toString(16);
            if (countrycolor.length == 1){
                countrycolor = "0" + countrycolor;
            }
        }
        while(cases[compared_countries[i]][j] < start_case && j < cases[compared_countries[i]].length){
            j++;
        }
        datas.push({label: compared_countries[i] + " cases",
                    data: cases[compared_countries[i]].slice(j, cases[compared_countries[i]].length),
                    lineTension: 0,
                    fill: false,
                    borderColor: '#00'+ countrycolor + 'ff',
                    backgroundColor: '#00'+ countrycolor + 'ff'
        });
        datas.push({label: compared_countries[i] + " deaths",
                    data: deaths[compared_countries[i]].slice(j, deaths[compared_countries[i]].length),
                    lineTension: 0,
                    fill: false,
                    borderColor: '#ff'+ countrycolor + '00',
                    backgroundColor: '#ff'+ countrycolor + '00'
        });
        if (datas[datas.length - 1]["data"].length > biggestday){
            biggestday = datas[datas.length - 1]["data"].length;
        }
    }
    for (i = 0; i < biggestday; i++){
        days.push(i);
    }
    
    //draw linear graph
    linearChart = new Chart(linearctx, {
        type: 'line',
        data: {
            labels: days,
            datasets: datas
        },
        options: {
            title: {
                text: 'Linear Scale',
                display: true,
                fontSize: 24
            },
            scales: {
                xAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Days'
                    }
                }],
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Number of people'
                    }
                }]
            }
        }
    });
    
    //draw logarithmic graph
    logChart = new Chart(logctx, {
        type: 'line',
        data: {
            labels: days,
            datasets: datas
        },
        options: {
            title: {
                text: 'Log Scale',
                display: true,
                fontSize: 24
            },
            scales: {
                xAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Days'
                    }
                }],
                yAxes: [{
                    type: 'logarithmic',
                    ticks: {
                        autoSkip: true,
                        min: 0,
                        max: 1000000,
                        callback: function (value, index, values) {
                            if( value==10 || value==100 || value==1000 || value==10000 || value==100000  || value==1000000 ){
                                return value;
                            }
                        }
                    },
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Number of people'
                    }
                }]
            }
        }
    });
}
function resetAll(){
    var cases = <?php echo json_encode($cases); ?>;
    var selectable_countries = Object.keys(cases);
    //document.write(selectable_countries);
    //get countries from user
    for (i = 0; i < selectable_countries.length; i++){
        document.getElementById(selectable_countries[i]).checked = false;
    }
}
recalculate();
</script>
</body>
</html>