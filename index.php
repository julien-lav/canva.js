<?php include 'header.php'; ?>

<?php include 'sidebar.php'; ?>
<?php include 'content.php'; ?>
<h1>Home</h1>
<div id="chartContainer"></div>

<?php


$users = ['presley972', 'rizvane', 'masternono75', 'julien-lav'];
$masters = ['cvilleger', 'lp1dev', 'tdutrion'];

$myTab = [];

echo '</br> &nbsp; ---------- </br> / élève : / </br> ---------- </br>';
    foreach ($users as $user) {
    ini_set('user_agent','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2'); 
    $content = file_get_contents("https://api.github.com/users/". $user . "");
    $data = json_decode($content);
    
    echo $data->login . ' : ';
    echo $data->public_repos . '</br>';

    array_push($myTab, array("y" => $data->public_repos, "label" => $data->login));

    // $myTab = array(
    //     array("y" => $data->public_repos)
    // );
}

echo '</br> &nbsp; ---------- </br> / profs : / </br> ---------- </br>';

?>

<script type="text/javascript">

    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "theme2",
            animationEnabled: true,
            title: {
                text: "A Git repository count made with php/canva.js ;)"
            },
            data: [
            {
                type: "column",                
                dataPoints: <?php echo json_encode($myTab, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart.render();
    });
</script>

<?php include 'footer.php'; ?>