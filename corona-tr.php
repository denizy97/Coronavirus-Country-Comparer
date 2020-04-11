<?php
/*This file is written in 2020 by Deniz YILDIRIM <denizy@protonmail.com>*/
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $TRcase = 18135;
    $TRdeath = 356;
    $turkish_countries = array(
        "ABD" => "US",
        "Afganistan" => "Afghanistan",
        "Almanya" => "Germany",
        "Andorra" => "Andorra",
        "Angola" => "Angola",
        "Antigua ve Barbuda" => "Antigua and Barbuda",
        "Arjantin" => "Argentina",
        "Arnavutluk" => "Albania",
        "Avustralya" => "Australia",
        "Avusturya" => "Austria",
        "Azerbaycan" => "Azerbaijan",
        "Bahamalar" => "Bahamas",
        "Bahreyn" => "Bahrain",
        "Bangladeş" => "Bangladesh",
        "Barbados" => "Barbados",
        "Batı Sahra" => "Western Sahara",
        "Belçika" => "Belgium",
        "Belize" => "Belize",
        "Benin" => "Benin",
        "Beyaz Rusya / Belarus" => "Belarus",
        "Butan" => "Bhutan",
        "Birleşik Arap Emirlikleri" => "United Arab Emirates",
        "Bolivya" => "Bolivia",
        "Bosna Hersek" => "Bosnia and Herzegovina",
        "Botsvana" => "Botswana",
        "Brezilya" => "Brazil",
        "Brunei" => "Brunei",
        "Bulgaristan" => "Bulgaria",
        "Burkina Faso" => "Burkina Faso",
        "Burundi" => "Burundi",
        "Cezayir" => "Algeria",
        "Cibuti" => "Djibouti",
        "Çad" => "Chad",
        "Çek Cumhuriyeti" => "Czechia",
        "Çin" => "China",
        "Danimarka" => "Denmark",
        "Doğu Timor" => "Timor-Leste",
        "Dominik Cumhuriyeti" => "Dominican Republic",
        "Dominika" => "Dominica",
        "Ekvador" => "Ecuador",
        "Ekvator Ginesi" => "Equatorial Guinea",
        "El Salvador" => "El Salvador",
        "Endonezya" => "Indonesia",
        "Eritre" => "Eritrea",
        "Ermenistan" => "Armenia",
        "Estonya" => "Estonia",
        "Esvatini" => "Eswatini",
        "Etiyopya" => "Ethiopia",
        "Fas" => "Morocco",
        "Fiji" => "Fiji",
        "Fildişi Sahili" => "Cote d'Ivoire",
        "Filipinler" => "Philippines",
        "Filistin" => "Palestine",
        "Finlandiya" => "Finland",
        "Fransa" => "France",
        "Gabon" => "Gabon",
        "Gambiya" => "Gambia",
        "Gana" => "Ghana",
        "Gine" => "Guinea",
        "Gine Bissau" => "Guinea-Bissau",
        "Grenada" => "Grenada",
        "Guyana" => "Guyana",
        "Guatemala" => "Guatemala",
        "Güney Afrika Cumhuriyeti" => "South Africa",
        "Güney Kıbrıs" => "Cyprus",
        "Güney Kore" => "Korea, South",
        "Güney Sudan" => "South Sudan",
        "Gürcistan" => "Georgia",
        "Haiti" => "Haiti",
        "Hırvatistan" => "Croatia",
        "Hindistan" => "India",
        "Hollanda" => "Netherlands",
        "Honduras" => "Honduras",
        "Iraq" => "Iraq",
        "İngiltere (Birleşik Krallık)" => "United Kingdom",
        "İran" => "Iran",
        "İrlanda" => "Ireland",
        "İspanya" => "Spain",
        "İsrail" => "Israel",
        "İsveç" => "Sweden",
        "İsviçre" => "Switzerland",
        "İtalya" => "Italy",
        "İzlanda" => "Iceland",
        "Jamaika" => "Jamaica",
        "Japonya" => "Japan",
        "Kamboçya" => "Cambodia",
        "Kamerun" => "Cameroon",
        "Kanada" => "Canada",
        "Karadağ" => "Montenegro",
        "Katar" => "Qatar",
        "Kazakistan" => "Kazakhstan",
        "Kenya" => "Kenya",
        "Kırgızistan" => "Kyrgyzstan",
        "Kiribati" => "Kiribati",
        "Kolombiya" => "Colombia",
        "Komorlar" => "Comoros",
        "Kongo (Brazzaville)" => "Congo (Brazzaville)",
        "Kongo DC (Kinşasa)" => "Congo (Kinshasa)",
        "Kosova" => "Kosovo",
        "Kosta Rika" => "Costa Rica",
        "Kuveyt" => "Kuwait",
        "Kuzey Kıbrıs" => "Northern Cyprus",
        "Kuzey Kore" => "Korea, North",
        "Küba" => "Cuba",
        "Laos" => "Laos",
        "Lesotho" => "Lesotho",
        "Letonya" => "Latvia",
        "Liberya" => "Liberia",
        "Libya" => "Libya",
        "Lihtenştayn" => "Liechtenstein",
        "Litvanya" => "Lithuania",
        "Lübnan" => "Lebanon",
        "Lüksemburg" => "Luxembourg",
        "Macaristan" => "Hungary",
        "Madagaskar" => "Madagascar",
        "Kuzey Makedonya" =>"North Macedonia",
        "Malavi" => "Malawi",
        "Maldiv Adaları" => "Maldives",
        "Malezya" => "Malaysia",
        "Mali" => "Mali",
        "Malta" => "Malta",
        "Marshall Adaları" => "Marshall Islands",
        "Meksika" => "Mexico",
        "Mısır" => "Egypt",
        "Mikronezya" => "Micronesia",
        "Moğolistan" => "Mongolia",
        "Moldova" => "Moldova",
        "Monako" => "Monaco",
        "Moritanya" => "Mauritania",
        "Moritius" => "Mauritius",
        "Mozambik" => "Mozambique",
        "Myanmar" => "Myanmar",
        "Namibya" => "Namibia",
        "Nauru" => "Nauru",
        "Nepal" => "Nepal",
        "Nikaragua" => "Nicaragua",
        "Nijer" => "Niger",
        "Nijerya" => "Nigeria",
        "Norveç" => "Norway",
        "Orta Afrika Cumhuriyeti " => "Central African Republic",
        "Özbekistan" => "Uzbekistan",
        "Pakistan" => "Pakistan",
        "Palau" => "Palau",
        "Panama" => "Panama",
        "Papua Yeni Gine" => "Papua New Guinea",
        "Paraguay" => "Paraguay",
        "Peru" => "Peru",
        "Polonya" => "Poland",
        "Portekiz" => "Portugal",
        "Romanya" => "Romania",
        "Ruanda" => "Rwanda",
        "Rusya" => "Russia",
        "Saint Kitts ve Nevis" => "Saint Kitts and Nevis",
        "Saint Lucia" => "Saint Lucia",
        "Saint Vincent ve Grenadinler" => "Saint Vincent and the Grenadines",
        "Samoa" => "Samoa",
        "San Marino" => "San Marino",
        "Sao Tome ve Principe" => "Sao Tome and Principe",
        "Senegal" => "Senegal",
        "Seyşeller" => "Seychelles",
        "Sırbistan" => "Serbia",
        "Sierra Leone" => "Sierra Leone",
        "Singapur" => "Singapore",
        "Slovakya" => "Slovakia",
        "Slovenya" => "Slovenia",
        "Solomon Adaları" => "Solomon Islands",
        "Somali" => "Somalia",
        "Somaliland" => "Somaliland",
        "Sri Lanka" => "Sri Lanka",
        "Sudan" => "Sudan",
        "Surinam" => "Suriname",
        "Suriye" => "Syria",
        "Suudi Arabistan" => "Saudi Arabia",
        "Şili" => "Chile",
        "Tacikistan" => "Tajikistan",
        "Tanzanya" => "Tanzania",
        "Tayland" => "Thailand",
        "Tayvan" => "Taiwan*",
        "Togo" => "Togo",
        "Tonga" => "Tonga",
        "Transdinyester" => "Transnistria",
        "Trinidad ve Tobago" => "Trinidad and Tobago",
        "Tunus" => "Tunisia",
        "Tuvalu" => "Tuvalu",
        "Türkiye" => "Turkey",
        "Türkmenistan" => "Turkmenistan",
        "Uganda" => "Uganda",
        "Ukrayna" => "Ukraine",
        "Umman" => "Oman",
        "Uruguay" => "Uruguay",
        "Ürdün" => "Jordan",
        "Vanuatu" => "Vanuatu",
        "Vatikan (Kutsal Makam)" => "Holy See",
        "Venezuela" => "Venezuela",
        "Vietnam" => "Vietnam",
        "Yemen" => "Yemen",
        "Yeni Zelanda" => "New Zealand",
        "Yeşil Burun Adaları" => "Cabo Verde",
        "Yunanistan" => "Greece",
        "Zambiya" => "Zambia",
        "Zimbabve" => "Zimbabwe",
        "Diamond Princess Gemisi" => "Diamond Princess"
    );
    $array = array();
    $cases = array();
    $deaths = array();
    $percentagecases = array();
    $percentagedeaths = array();
    $weeklyrate = array();
    $country_list = array();
    $tr_country_list = array();
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
    //fix Palestine
    if (array_key_exists("", $cases)){
        unset($cases[""]);
        unset($country_list[array_search("", $country_list)]);
    }
    if (array_key_exists("West Bank and Gaza", $cases)){
        $cases["Palestine"] = $cases["West Bank and Gaza"];
        unset($cases["West Bank and Gaza"]);
        $idx = array_search("West Bank and Gaza", $country_list);
        unset($country_list[$idx]);
        $country_list[$idx] = "Palestine";
    }
    //Get Turkish countries
    foreach ($turkish_countries as $tr_c => $en_c){
        if (in_array($en_c, $country_list)){
            $tr_country_list[] = $tr_c;
        }
    }
    foreach ($country_list as $en_c){
        if (!in_array($en_c, $turkish_countries) && $en_c != ""){
            $tr_country_list[] = $en_c;
            $turkish_countries[$en_c] = $en_c;
        }
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
<h1 style="text-align: center;">COVID-19 Ülke Karşılaştırması</h1>
<hr>
<p style="text-align: justify;">Bu sayfayı kullanarak zaman içinde seçtiğiniz ülkelerdeki vaka ve ölümleri karşılaştırabilirsiniz.</p>
<p style="text-align: justify;">Bu sayfa ülkelerin virüsün yayılmasını yavaşlamak için aldıkları farklı önlemlerin ne kadar etkili olduklarını karşılaştırmak için hazırladım, ama siz bu grafikleri istediğiniz amaçla kullanabilirsiniz.</p>
<p style="text-align: justify;">Veriler günde bir kere yenilendiği için güncel olmayabilir.</p>
<p style="text-align: justify;">Veriler <a href="https://github.com/CSSEGISandData/COVID-19">John Hopkins Üniversitesi'nin COVID-19 Github sayfasından</a> alınıyor. Ne kadar <a href="https://github.com/CSSEGISandData/COVID-19/issues/977">bilime politika katmaya</a> çalışsalar da.. Onların haritasına da <a href="https://coronavirus.jhu.edu/map.html">buradan</a> göz atabilirsiniz.</p>
<p style="text-align: justify;">Nüfus verisi <a href="https://restcountries.eu/">REST Countries</a>'den alınıyor.</p>
<p style="text-align: justify;">Deniz Yıldırım (denizy@protonmail.com) tarafından yapılmıştır.</p>
<p style="text-align: justify;">Kaynak kodu <a href="https://github.com/denizy97/Coronavirus-Country-Comparer">burada</a>.</p>
<hr>
<div class="column">
    <h3 style="text-align:center;">Nasıl Çalışır</h3>
    <p style="text-align: justify;">1)Aşağıdan karşılaştırmak istediğiniz ülkeleri seçin. ABD ve İtalya ilk başta örnek olarak seçili. (Eğer 10'dan fazla ülke seçerseniz kalabalık yapmaması için lejant otomatik olarak kaldırılır)</p>
    <p style="text-align: justify;">2)Grafiklerde gün 0, her ülkenin seçilmiş vaka sayısını ilk geçtiği gündür. Varsayılan değer 100'dür, çok vaka olan ülkeler için 1000 de mantıklı bir sayı, eğer karşılaştırmak istediğiniz ülkelerin bir kısmında vaka sayısı azsa o zaman daha düşük değerler seçmelisiniz. Bu değeri aşağıdaki kutudan değiştirebilirsiniz.</p>
    <p style="text-align:center;"><strong>Grafikleri </strong><input type="number" autocomplete="off" id="startcase" value=100> <strong> vakadan başlat.</strong></p>
    <p style="text-align: justify;">3)Seçimlerinizi bitirdikten sonra aşağıdaki Karşılaştır düğmesine tıklayın.</p>
    <p style="text-align:center;"><button onclick="recalculate()">Karşılaştır</button> <button onclick="resetAll()">Seçimleri Temizle</button> <button onclick="selectAll()">Hepsini Seç (Tavsiye Etmiyorum)</button></p>
    <div class="column">
        <?php
            for ($i=0; $i < floor(sizeof($tr_country_list)/3); $i++){
                echo("<p><input type=\"checkbox\" autocomplete=\"off\" id=\"" . $turkish_countries[$tr_country_list[$i]] . "\">" . $tr_country_list[$i] . "</p>");
            }
        ?>
    </div>
    <div class="column">
        <?php
            for ($i=floor(sizeof($tr_country_list)/3); $i < floor(2*sizeof($tr_country_list)/3); $i++){
                echo("<p><input type=\"checkbox\" id=\"" . $turkish_countries[$tr_country_list[$i]]  . "\">" . $tr_country_list[$i] . "</p>");
            }
        ?>
    </div>
    <div class="column">
        <?php
            for ($i=floor(2*sizeof($tr_country_list)/3); $i < sizeof($tr_country_list); $i++){
                echo("<p><input type=\"checkbox\" id=\"" . $turkish_countries[$tr_country_list[$i]]  . "\">" . $tr_country_list[$i] . "</p>");
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
    <p style= "text-align: justify;"><strong>*</strong>Son yapılan araştırmalara göre COVID-19'un temel bulaşıcılık katsayısı (R0) 3 civarında, yani eğer önlem alınmazsa virüsü kapan her birey virüsü toplamda yaklaşık 3 kşiye yayıyor ve vaka sayısını dörde katlıyor. Aynı zamanda araştırmalara göre virüsü kapanlar 1-2 hafta boyunca virüsü yayıyor. Yani eğer önlem alınmazsa vaka sayısı her hafte 2.5-4 arası bir sayı ile katlanır.</p>
    <p style= "text-align: justify;">Bazı ülkelerde vaka sayıları haftadan haftaya çok yüksek miktarda katlanıyor (bu yüzden grafik sadece x10'a kadar), çünkü test yapılan birey sayısı bu ülkelerde günden güne artıyor. Her gün virüsü kapmış olmasına rağmen test edilmeyen bireyler olduğu için, test yapılan birey sayısı yüksek ve sabit tutulmadığı sürece vakaların haftalık artış oranı pek bir bilgi vermiyor.</p>
    <p style= "text-align: justify;">Bunun yanı sıra tabi eğer bir ülke önlemsiz oranın altına inerse o ülkedeki önlemlerin bir miktar işe yaradığını söylemek yanlış olmaz. Özellikle Japonya ve Güney Kore gibi ülkelerde çok düşün haftalık vaka artış oranları görülüyor.</p>
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
    //document.write(selectable_countries);
    
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
                text: 'Günlük Vaka & Ölüm (Lineer/Doğrusal)',
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
                        labelString: 'Gün'
                    }
                }],
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Vaka/Ölüm Sayısı'
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
                text: 'Günlük Vaka & Ölüm (Logaritmik)',
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
                        labelString: 'Gün'
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
                        labelString: 'Vaka/Ölüm Sayısı'
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
                text: 'Vaka ve Ölümlerin Nüfustaki Yüzdesi',
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
                        labelString: 'Gün'
                    }
                }],
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: '% Vaka/Ölüm Sayısı / Nüfus'
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
                text: 'Haftalık Vaka Artış Oranı (Lineer/Doğrusal)',
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
                        labelString: 'Gün'
                    }
                }],
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true,
                        max:10
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Verilen gündeki vaka sayısı / 7 gün önceki vaka sayısı'
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
                        content: 'önlemsiz oran (1+R0)*',
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