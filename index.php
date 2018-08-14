<?php include 'header.php'; ?>

<?php include 'sidebar.php'; ?>
<?php include 'content.php'; ?>
<h1>Home</h1>
<div id="chartContainer"></div>

<br />
<div style="margin: 260px auto;">&nbsp;</div>
<br />

<div id="chartContainer2"></div>

<?php

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

    $(function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "theme2",
            animationEnabled: true,
            title: {
                text: "A Git repository count from D20.1 class made with php/canva.js ;)"
            },
            data: [
            {
                type: "column",                
                dataPoints: <?php echo json_encode($myTab, JSON_NUMERIC_CHECK); ?>,
                click: function(e){
                        alert(  e.dataSeries.type+ ", données : { nom:" + e.dataPoint.label + ", nombre de repos: "+ e.dataPoint.y + " }" ); // as defined in the array 
                    }
            }
            ]
        });

        chart.render();
    });


</script>

<?php include 'footer.php'; ?>