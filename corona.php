<?php
/*This file is written in 2020 by Deniz YILDIRIM <denizy@protonmail.com>*/
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $TRcase = 18135;
    $TRdeath = 356;
    $array = array();
    $cases = array();
    $deaths = array();
    $percentagecases = array();
    $percentagedeaths = array();
    $weeklyrate = array();
    $country_list = array();
    $DATE_COL = 4;
    //Get cases
    $url = "https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_covid19_confirmed_global.csv";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $csv = curl_exec($ch); //connection 1
    $lines = explode(PHP_EOL, $csv);
    curl_close($ch);
    foreach ($lines as $line) {
        if(str_getcsv($line) && array_key_exists(1, str_getcsv($line))){
            $array[] = str_getcsv($line);
        }
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
    if (array_key_exists("", $cases)){
        unset($cases[""]);
        unset($country_list[array_search("", $country_list)]);
    }
    //fix Palestine
    if (array_key_exists("West Bank and Gaza", $cases)){
        $cases["Palestine"] = $cases["West Bank and Gaza"];
        unset($cases["West Bank and Gaza"]);
        $idx = array_search("West Bank and Gaza", $country_list);
        unset($country_list[$idx]);
        $country_list[$idx] = "Palestine";
    }
    $array = array();
    //Get deaths
    $url = "https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_covid19_deaths_global.csv";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $csv = curl_exec($ch); //connection 2
    $lines = explode(PHP_EOL, $csv);
    curl_close($ch);
    foreach ($lines as $line) {
        if(str_getcsv($line) && array_key_exists(1, str_getcsv($line))){
            $array[] = str_getcsv($line);
        }
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
    if (array_key_exists("", $deaths)){
        unset($deaths[""]);
    }
    //fix Palestine
    if (array_key_exists("West Bank and Gaza", $deaths)){
        $deaths["Palestine"] = $deaths["West Bank and Gaza"];
        unset($deaths["West Bank and Gaza"]);
    }
    
    //Turkey update latest
    if(!in_array($TRcase, $cases["Turkey"])){
        $cases["Turkey"][] = $TRcase;
        $deaths["Turkey"][] = $TRdeath;
    }
    
    //get percentages relative to population
    $url = "https://restcountries.eu/rest/v2/all/";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $lines = curl_exec($ch);
    $json = json_decode($lines);
    curl_close($ch);
    for($i = 0; $i < sizeof($json); $i++){
        $cname = $json[$i]->{'name'};
        
        //echo("<p>" . $cname . "</p>");
        $cn = $cname;
        if ($cname == "Bolivia (Plurinational State of)"){
            $cn = "Bolivia";
        }
        elseif ($cname == "Brunei Darussalam"){
            $cn = "Brunei";
        }
        elseif ($cname == "Myanmar"){
            $cn = "Burma";
        }
        elseif ($cname == "Congo"){
            $cn = "Congo (Brazzaville)";
        }
        elseif ($cname == "Congo (Democratic Republic of the)"){
            $cn = "Congo (Kinshasa)";
        }
        elseif ($cname == "Côte d'Ivoire"){
            $cn = "Cote d'Ivoire";
        }
        elseif ($cname == "Czech Republic"){
            $cn = "Czechia";
        }
        elseif ($cname == "Swaziland"){
            $cn = "Eswatini";
        }
        elseif ($cname == "Iran (Islamic Republic of)"){
            $cn = "Iran";
        }
        elseif ($cname == "Korea (Republic of)"){
            $cn = "Korea, South";
        }
        elseif ($cname == "Korea (Democratic People's Republic of)"){
            $cn = "Korea, North";
        }
        elseif ($cname == "Republic of Kosovo"){
            $cn = "Kosovo";
        }
        elseif ($cname == "Lao People's Democratic Republic"){
            $cn = "Laos";
        }
        elseif ($cname == "Macedonia (the former Yugoslav Republic of)"){
            $cn = "North Macedonia";
        }
        elseif ($cname == "Moldova (Republic of)"){
            $cn = "Moldova";
        }
        elseif ($cname == "Palestine, State of"){
            $cn = "Palestine";
        }
        elseif ($cname == "Russian Federation"){
            $cn = "Russia";
        }
        elseif ($cname == "Syrian Arab Republic"){
            $cn = "Syria";
        }
        elseif ($cname == "Taiwan"){
            $cn = "Taiwan*";
        }
        elseif ($cname == "Tanzania, United Republic of"){
            $cn = "Tanzania";
        }
        elseif ($cname == "United Kingdom of Great Britain and Northern Ireland"){
            $cn = "United Kingdom";
        }
        elseif ($cname == "United States of America"){
            $cn = "US";
        }
        elseif ($cname == "Venezuela (Bolivarian Republic of)"){
            $cn = "Venezuela";
        }
        elseif ($cname == "Viet Nam"){
            $cn = "Vietnam";
        }
        

        if($json != NULL && in_array($cn, $country_list)){
            $percentagecases[$cn] = array();
            $percentagedeaths[$cn] = array();
            //echo("<p>" . $cn . "</p>");
            for ($j = 0; $j < sizeof($cases[$cn]); $j++){
                //echo("<p>" . $i . "</p>");
                $percentagecases[$cn][] = 100 * $cases[$cn][$j]/$json[$i]->{'population'};
                $percentagedeaths[$cn][] = 100 * $deaths[$cn][$j]/$json[$i]->{'population'};
            }
            
            
            //get weekly increase rate here as well
            $weeklyrate[$cn] = array();
            for ($day = 0; $day < sizeof($cases[$cn]); $day++){
                if ($day < 7 || $cases[$cn][$day-7] == 0){
                    $weeklyrate[$cn][] = 0;
                }
                else{
                    $weeklyrate[$cn][] = $cases[$cn][$day]/$cases[$cn][$day-7];
                }
            }
        }
    }
    $cn = "Diamond Princess";
    for ($i = 0; $i < sizeof($cases[$cn]); $i++){
        $percentagecases[$cn][] = 100 * $cases[$cn][$i]/3711;
        $percentagedeaths[$cn][] = 100 * $deaths[$cn][$i]/3711;
    }
    $weeklyrate[$cn] = array();
    for ($day = 0; $day < sizeof($cases[$cn]); $day++){
        if ($day < 7 || $cases[$cn][$day-7] == 0){
            $weeklyrate[$cn][] = 0;
        }
        else{
            $weeklyrate[$cn][] = $cases[$cn][$day]/$cases[$cn][$day-7];
        }
    }
    $cn = "MS Zaandam";
    for ($i = 0; $i < sizeof($cases[$cn]); $i++){
        $percentagecases[$cn][] = 100 * $cases[$cn][$i]/1829;
        $percentagedeaths[$cn][] = 100 * $deaths[$cn][$i]/1829;
    }
    $weeklyrate[$cn] = array();
    for ($day = 0; $day < sizeof($cases[$cn]); $day++){
        if ($day < 7 || $cases[$cn][$day-7] == 0){
            $weeklyrate[$cn][] = 0;
        }
        else{
            $weeklyrate[$cn][] = $cases[$cn][$day]/$cases[$cn][$day-7];
        }
    }
    /*
    foreach ($country_list as $cn){
        $cname = $cn;
        
        //fix names
        if ($cn == "Congo (Brazzaville)"){
            $cname = "Congo";
        }
        elseif ($cn == "Congo (Kinshasa)"){
            $cname = "DR Congo";
        }
        elseif ($cn == "Diamond Princess"){
            for ($i = 0; $i < sizeof($cases[$cn]); $i++){
                $percentagecases[$cn][] = 100 * $cases[$cn][$i]/3711;
                $percentagedeaths[$cn][] = 100 * $deaths[$cn][$i]/3711;
            }
            $weeklyrate[$cn] = array();
            for ($day = 0; $day < sizeof($cases[$cn]); $day++){
                if ($day < 7 || $cases[$cn][$day-7] == 0){
                    $weeklyrate[$cn][] = 0;
                }
                else{
                    $weeklyrate[$cn][] = $cases[$cn][$day]/$cases[$cn][$day-7];
                }
            }
            continue;
        }
        elseif ($cn == "Czechia"){
            $cname = "Czech";
        }
        elseif ($cn == "Korea, South"){
            $cname = "Korea (Republic of)";
        }
        elseif ($cn == "Korea, North"){
            $cname = "Korea (Democratic People's Republic of)";
        }
        elseif ($cn == "North Macedonia"){
            $cname = "Macedonia";
        }
        elseif ($cn == "Taiwan*"){
            $cname = "Taiwan";
        }
        elseif ($cn == "US"){
            $cname = "USA";
        }
        elseif ($cn == "India"){
            $cname = "Republic of India";
        }
        elseif ($cn == "Guinea"){
            $cname = "Republic of Guinea";
        }
        elseif ($cn == "Sudan"){
            $cname = "Republic of the Sudan";
        }
        elseif ($cn == "MS Zaandam"){
            for ($i = 0; $i < sizeof($cases[$cn]); $i++){
                $percentagecases[$cn][] = 100 * $cases[$cn][$i]/1829;
                $percentagedeaths[$cn][] = 100 * $deaths[$cn][$i]/1829;
            }
            $weeklyrate[$cn] = array();
            for ($day = 0; $day < sizeof($cases[$cn]); $day++){
                if ($day < 7 || $cases[$cn][$day-7] == 0){
                    $weeklyrate[$cn][] = 0;
                }
                else{
                    $weeklyrate[$cn][] = $cases[$cn][$day]/$cases[$cn][$day-7];
                }
            }
            continue;
        }
        $url = "https://restcountries.eu/rest/v2/name/" . $cname;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $lines = curl_exec($ch);
        $json = json_decode($lines);
        $percentagecases[$cn] = array();
        $percentagedeaths[$cn] = array();
        //echo("<p>" . $cn . "</p>");
        if($json == NULL){
            echo("<p>" . $cn . "</p>");
            echo("<p>" . $cname . "</p>");
            echo("<p>" . curl_error() . "</p>");
        }
        for ($i = 0; $i < sizeof($cases[$cn]); $i++){
            //echo("<p>" . $i . "</p>");
            $percentagecases[$cn][] = 100 * $cases[$cn][$i]/$json[0]->{'population'};
            $percentagedeaths[$cn][] = 100 * $deaths[$cn][$i]/$json[0]->{'population'};
        }
        curl_close($ch);
        
        //get weekly increase rate here as well
        $weeklyrate[$cn] = array();
        for ($day = 0; $day < sizeof($cases[$cn]); $day++){
            if ($day < 7 || $cases[$cn][$day-7] == 0){
                $weeklyrate[$cn][] = 0;
            }
            else{
                $weeklyrate[$cn][] = $cases[$cn][$day]/$cases[$cn][$day-7];
            }
        }
    }
    */
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
<p style="text-align: justify;">This is a simple tool to compare cases and deaths in selected countries over time.</p>
<p style="text-align: justify;">I made it to visualize how well different measures taken by countries are at slowing down the spread of the virus, but you can use it for whatever your heart desires really.</p>
<p style="text-align: justify;">Updated once a day so data might not be current.</p>
<p style="text-align: justify;">COVID-19 data is taken from <a href="https://github.com/CSSEGISandData/COVID-19">John Hopkins University's Github repository for COVID-19</a>. Despite their <a href="https://github.com/CSSEGISandData/COVID-19/issues/977">political bias</a>.. Check their map <a href="https://coronavirus.jhu.edu/map.html">here</a>.</p>
<p style="text-align: justify;">Population data is taken from <a href="https://restcountries.eu/">REST Countries</a>.</p>
<p style="text-align: justify;">Made by Deniz Yıldırım (denizy@protonmail.com)</p>
<p style="text-align: justify;">Source code is <a href="https://github.com/denizy97/Coronavirus-Country-Comparer">here</a>.</p>
<hr>
<div class="column">
    <h3 style="text-align:center;">Instructions</h3>
    <p style="text-align: justify;">1)From below, select countries you want to compare. US and Italy are selected by default as an example. (If you choose more than 10, the legend get disabled to prevent cluttering)</p>
    <p style="text-align: justify;">2)In the graphs, Day 0 is the first day each country passed a selected amount of cases. 100 is the default, for countries with a lot of cases 1000 is also a good number, on the other hand if one of the countries you compare has less cases you might want to turn it even lower. You can change it in the box below.</p>
    <p style="text-align:center;"><strong>Starting from </strong><input type="number" autocomplete="off" id="startcase" value=100> <strong>cases</strong></p>
    <p style="text-align: justify;">3)When you are done, press the Compare button below.</p>
    <p style="text-align:center;"><button onclick="recalculate()">Compare</button> <button onclick="resetAll()">Clear Selections</button> <button onclick="selectAll()">Select All (Not Recommended)</button></p>
    <div class="column">
        <?php
            for ($i=0; $i < floor(sizeof($country_list)/3); $i++){
                echo("<p><input type=\"checkbox\" autocomplete=\"off\" id=\"" . $country_list[$i] . "\">" . $country_list[$i] . "</p>");
            }
        ?>
    </div>
    <div class="column">
        <?php
            for ($i=floor(sizeof($country_list)/3); $i < floor(2*sizeof($country_list)/3); $i++){
                echo("<p><input type=\"checkbox\" id=\"" . $country_list[$i] . "\">" . $country_list[$i] . "</p>");
            }
        ?>
    </div>
    <div class="column">
        <?php
            for ($i=floor(2*sizeof($country_list)/3); $i < sizeof($country_list); $i++){
                echo("<p><input type=\"checkbox\" id=\"" . $country_list[$i] . "\">" . $country_list[$i] . "</p>");
            }
        ?>
    </div>
</div>
<div class="bigcolumn">
    <canvas id="lineGraph"></canvas><!-- Line Graph -->
    <hr>
    <canvas id="logGraph"></canvas><!-- Logarithmic Graph -->
    <hr>
    <canvas id="popGraph"></canvas><!-- Line Graph relative to population-->
    <hr>
    <canvas id="rateGraph"></canvas><!-- Rate Graph -->
    <p style= "text-align: justify;"><strong>*</strong>Latest studies claim that the basic reproduction number (R0) of COVID-19 is around 3, which means each person who gets the virus spreads it to around 3 additional people, quadroupling the number of cases, if no effort is made to slow it down. Studies also say that people with the virus stay infectious 1-2 weeks. This means without policy, each week the amount of cases would multiply by 2.5-4.</p>
    <p style= "text-align: justify;">The amount of cases multiply by insanely huge amounts in some countries (which is why the graph is capped at x10), because the number of people who get tested increase over time. At any day, there are people who have the virus but who aren't tested, which means unless the amount of people who get tested is big and remains fairly constant, the rate of increase gives little information.</p>
    <p style= "text-align: justify;">This being said, if a country goes below the no policy zone it is fair to assume that their policies work to some degree. Especially in countries like South Korea and Japan one can see very low rates of increase in cases per week.</p>
    <hr>
    <canvas id="trajectoryGraph"></canvas><!-- Trajectory Graph -->
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.js"></script>

<script>
resetAll();
document.getElementById("US").checked = true;
document.getElementById("Italy").checked = true;
var linearctx = document.getElementById('lineGraph').getContext('2d');
var linearChart = new Chart(linearctx);
var logctx = document.getElementById('logGraph').getContext('2d');
var logChart = new Chart(logctx);
var popctx = document.getElementById('popGraph').getContext('2d');
var popChart = new Chart(popctx);
var ratectx = document.getElementById('rateGraph').getContext('2d');
var rateChart = new Chart(ratectx);
var displayLegends = true;
function recalculate() {
    linearChart.destroy();
    logChart.destroy();
    popChart.destroy();
    rateChart.destroy();
    //Get data
    var cases = <?php echo json_encode($cases); ?>;
    var deaths = <?php echo json_encode($deaths); ?>;
    var percentagecases = <?php echo json_encode($percentagecases); ?>;
    var percentagedeaths = <?php echo json_encode($percentagedeaths); ?>;
    var weeklyrate = <?php echo json_encode($weeklyrate); ?>;
    var selectable_countries = Object.keys(cases);
    
    //get countries from user
    var compared_countries = [];
    for (i = 0; i < selectable_countries.length; i++){
        if (document.getElementById(selectable_countries[i]).checked){
            compared_countries.push(selectable_countries[i]);
        }
    }
    if (compared_countries.length > 10){
        displayLegends = false;
    }
    else{
        displayLegends = true;
    }
    var start_case = parseInt(document.getElementById("startcase").value); //get from user
    var datas = [];
    var relativedata = [];
    var ratedata = [];
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
        relativedata.push({label: compared_countries[i] + " % cases/population",
                    data: percentagecases[compared_countries[i]].slice(j, percentagecases[compared_countries[i]].length),
                    lineTension: 0,
                    fill: false,
                    borderColor: '#00'+ countrycolor + 'ff',
                    backgroundColor: '#00'+ countrycolor + 'ff'
        });
        relativedata.push({label: compared_countries[i] + " % deaths/population",
                    data: percentagedeaths[compared_countries[i]].slice(j, percentagedeaths[compared_countries[i]].length),
                    lineTension: 0,
                    fill: false,
                    borderColor: '#ff'+ countrycolor + '00',
                    backgroundColor: '#ff'+ countrycolor + '00'
        });
        ratedata.push({label: compared_countries[i] + " weekly rate of increase",
                    data: weeklyrate[compared_countries[i]].slice(j, weeklyrate[compared_countries[i]].length),
                    lineTension: 0,
                    fill: false,
                    borderColor: '#00'+ countrycolor + 'ff',
                    backgroundColor: '#00'+ countrycolor + 'ff'
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
                text: 'Cases & Deaths per Day (Linear)',
                display: true,
                fontSize: 24
            },
            legend: {
                display: displayLegends
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
                text: 'Cases & Deaths per Day (Logarithmic)',
                display: true,
                fontSize: 24
            },
            legend: {
                display: displayLegends
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
    
    //draw percentage graph
    popChart = new Chart(popctx, {
        type: 'line',
        data: {
            labels: days,
            datasets: relativedata
        },
        options: {
            title: {
                text: 'Cases & Deaths as Percentage of Population (Linear)',
                display: true,
                fontSize: 24
            },
            legend: {
                display: displayLegends
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
                        labelString: '% Number of people / Population'
                    }
                }]
            }
        }
    });
    rateChart = new Chart(ratectx, {
        type: 'line',
        data: {
            labels: days,
            datasets: ratedata
        },
        options: {
            title: {
                text: 'Weekly increase rate of cases (Linear)',
                display: true,
                fontSize: 24
            },
            legend: {
                display: displayLegends
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
                        beginAtZero: true,
                        max: 10
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Cases at given day / cases 7 days before'
                    }
                }]
            },
            annotation: {
                annotations: [{
                    type: 'line',
                    mode: 'horizontal',
                    scaleID: 'y-axis-0',
                    value: 3.25,
                    borderColor: 'rgba(0,0,0,0)',
                    label: {
                        enabled: true,
                        content: 'no policy rate (1+R0)*',
                        position: "left",
                        fontColor: "red",
                        fontSize: 10,
                        backgroundColor: 'rgba(0,0,0,0)',
                    }
                },
                {
                    type: 'box',
                    drawTime: 'afterDatasetsDraw',
                    yScaleID: 'y-axis-0',
                    yMin: 2.5,
                    yMax: 4,
                    backgroundColor: 'rgba(255, 0, 0, 0.1)',
                    borderColor: 'red',
                    label: {
                        enabled: true,
                        content: 'no policy rate (1+R0)*',
                        position: "left",
                        fontColor: "red",
                        fontSize: 10,
                        backgroundColor: 'rgba(0,0,0,0)',
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
function selectAll(){
    var cases = <?php echo json_encode($cases); ?>;
    var selectable_countries = Object.keys(cases);
    //document.write(selectable_countries);
    //get countries from user
    for (i = 0; i < selectable_countries.length; i++){
        document.getElementById(selectable_countries[i]).checked = true;
    }
}
recalculate();
</script>
</body>
</html>