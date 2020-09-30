<?php
include_once ('m/func.php');
$kolvo=20;
$start=0;
$count_str=ceil(count_avto()/$kolvo);

if (!empty($_GET)) {
    $delid = $_GET["delid"];
    if ($delid) {
        del_a($delid, $_GET["idcl"]);
    }
    $start = $_GET["start"];
    //print_r($delid);
}
$table=print_table($start,$kolvo);


?>
<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Стоянка</title>
</head>
<body>
<h1>Стоянка</h1>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">ФИО</th>
        <th scope="col">Авто</th>
        <th scope="col">Номер</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $result_table="";
    foreach ($table as $tr)
    {
    $result_table .= "
     <tr>
     <td>".$tr["fio"]."</td>
        <td>".$tr["marka"]." ".$tr["model"]."</td>
        <td>".$tr["nomer"]."</td>
        <td><a href=\"v/edit.php?idcl=".$tr["idcl"]."\"><svg width=\"1em\" height=\"1em\" viewBox=\"0 0 16 16\" class=\"bi bi-brush\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\">
                <path d=\"M15.213 1.018a.572.572 0 0 1 .756.05.57.57 0 0 1 .057.746C15.085 3.082 12.044 7.107 9.6 9.55c-.71.71-1.42 1.243-1.952 1.596-.508.339-1.167.234-1.599-.197-.416-.416-.53-1.047-.212-1.543.346-.542.887-1.273 1.642-1.977 2.521-2.35 6.476-5.44 7.734-6.411z\"/>
                <path d=\"M7 12a2 2 0 0 1-2 2c-1 0-2 0-3.5-.5s.5-1 1-1.5 1.395-2 2.5-2a2 2 0 0 1 2 2z\"/>
            </svg> </td>
        <td> <a href=\"?delid=".$tr["ida"]."&idcl=".$tr["idcl"]."\"><svg width=\"1em\" height=\"1em\" viewBox=\"0 0 16 16\" class=\"bi bi-x-octagon\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\">
                <path fill-rule=\"evenodd\" d=\"M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z\"/>
                <path fill-rule=\"evenodd\" d=\"M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z\"/>
                <path fill-rule=\"evenodd\" d=\"M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z\"/>
            </svg></td>
    </tr>";
    }
    echo $result_table;
    ?>

    </tbody>

</table>
<nav aria-label="Page navigation example">
    <ul class="pagination">
<?php
/*<li class="page-item"><a class="page-link" href="#">Previous</a></li>
<li class="page-item"><a class="page-link" href="#">Next</a></li>*/
for ($i=0;$i<$count_str;$i++){
echo '   
    <li class="page-item"><a class="page-link" href="?start='.($i*$kolvo).'">'.($i+1).'</a></li>
    ';
}
?>
    </ul>
</nav>
<div style="text-align: center">
    <a href="v/add.php" class="btn btn-primary">Добавить</a>
    </div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
