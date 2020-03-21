<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type = "text/css" href="style.css">
    <title>
    </title>
</head>

<body>
<br>
<h1>
Latest Coronavirus Stats: 
</h1>
<br><br>
<?php
    $ch = curl_init('https://coronavirus-tracker-api.herokuapp.com/v2/latest');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($ch);

    $info = curl_getinfo($ch);

    $jsonIterator = new RecursiveIteratorIterator(
        new RecursiveArrayIterator(json_decode($data, TRUE)),
        RecursiveIteratorIterator::SELF_FIRST);
        $population = 7500000000;
    foreach ($jsonIterator as $key => $val) {
        if ((!is_array($val))) {
            echo "<p>";
            if ($key == 'confirmed') {
                echo "Confirmed Cases: ";
                echo $val;
                echo "   -->   ";
                $percentage = $val/$population;
                echo "<b>";
                echo sprintf('%.8f',floatval($percentage))*100;
                echo "% </b> of people on Earth";
            }
            elseif ($key == 'deaths') {
                echo "Deaths: ";
                echo $val;
                echo "  -->    ";
                $percentage = $val/$population;
                echo "<b>";
                echo sprintf('%.8f',floatval($percentage))*100;
                echo "% </b> of people on Earth";
            }
            else {
                echo "Recovered Cases: ";
                echo $val;
                echo "  -->    ";
                $percentage = $val/$population;
                echo "<b>";
                echo sprintf('%.8f',floatval($percentage))*100;
                echo "% </b> of people on Earth";
             }
            echo "</p>";
        }
    }

    curl_close($ch);
    echo "<br><br>Today is " . date("m/d/Y") . "<br>";
    
?>

<input type="button" value="REFRESH" onclick="return RefreshWindow();"/>
<script>
    function RefreshWindow()
        {
         window.location.reload(true);
        }
</script>
<br> <br>
source: github@laurastephaniecortes
</body>
</html>