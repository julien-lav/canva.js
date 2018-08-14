<?php include 'header.php'; ?>

<?php include 'sidebar.php'; ?>
<?php include 'content.php'; ?>
<h1>Home</h1>
<div id="chartContainer1"></div>

<br />
<div style="margin: 260px auto;">&nbsp;</div>
<br />

<!--
<div id="chartContainer2"></div>
-->

<?php


$myTab2 = array(array("y" => 4181563, "legendText" => "PS 3", "indexLabel" => "PlayStation 3" ),
            array("y" => 2175498, "legendText" => "Wii", "indexLabel" => "Wii"),
            array("y" => 3125844, "legendText" => "360", "indexLabel" => "Xbox 360" ),
            array("y" => 1176121, "legendText" => "DS", "indexLabel" => "Nintendo DS" ),
            array("y" => 1727161, "legendText" => "PSP", "indexLabel" => "PSP" ),
            array("y" => 4303364, "legendText" => "3DS", "indexLabel" => "Nintendo 3DS" ),
            array("y" => 1717786, "legendText" => "Vita", "indexLabel" => "PS Vita" ));


$users = ['presley972', 'rizvane', 'masternono75', 'julien-lav'];
$masters = ['cvilleger', 'lp1dev', 'tdutrion'];

$myTab = [];


foreach ($users as $user) {
    ini_set('user_agent','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2'); 
    $content = file_get_contents("https://api.github.com/users/". $user . "");
    $data = json_decode($content);
    
    // echo "<h1>" . $data->login . ' : </h1>';
    // echo $data->public_repos . '</br>';

    array_push($myTab, array("y" => $data->public_repos, "label" => $data->login));
}

?>

<script type="text/javascript">


        var chart1 = new CanvasJS.Chart("chartContainer1", {
            theme: "theme2",
            animationEnabled: true,
            title: {
                text: "A Git repository count from D20.1 class made with php/canva.js ;)"
            },
            data: [
            {
                type: "column",                
                dataPoints: <?php echo json_encode($myTab, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });

        var chart2 = new CanvasJS.Chart("chartContainer2",
            {
                animationEnabled: true,
                title: {
                    text: "Whitch console do you play",
                },
                data: [
                {
                    type: "pie",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($myTab2); ?>
                },
                ]
            });

        chart2.render();
        chart1.render();

</script>

<?php include 'footer.php'; ?>