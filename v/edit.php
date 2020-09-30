<?php
include_once('../m/func.php');
/* изменение данных авто и клиента */

if (!empty($_POST)) { // если пришел POST
    /* данные клиенты */
    $idcl=$_POST["idcl"];
    $fio=htmlspecialchars($_POST["fio"]);
    $gender=htmlspecialchars($_POST["gender"]);
    $cellphone=htmlspecialchars($_POST["cellphone"]);
    $adres=htmlspecialchars($_POST["adres"]);

    /* данные авто */
    $ida=$_POST["ida"];
    $marka=$_POST["marka"];
    $model=$_POST["model"];
    $cvet=$_POST["cvet"];
    $nomer=$_POST["nomer"];
    $flag=$_POST["flag"];


    // перезаписываем введенные данные клиента
    edit_person($idcl, $fio, $gender, $cellphone, $adres);

    // перезаписываем введенные данные авто
   foreach ($nomer as $key=>$schet) {
       if ($ida[$key] == 'false') {
           if (empty($marka[$key]) && empty($model[$key]) && empty($cvet[$key]) && empty($nomer[$key])) {
               echo 'Ошибка данных нового авто';
           } else {
               add_avto($marka[$key], $model[$key], $cvet[$key], $nomer[$key], $flag[$key], $idcl);
           }
       } else {
           if (empty($marka[$key]) && empty($model[$key]) && empty($cvet[$key]) && empty($nomer[$key])) {
               echo 'Ошибка данных старых авто';
           } else {
               edit_avto($ida[$key], $marka[$key], $model[$key], $cvet[$key], $nomer[$key], $flag[$key], $idcl);
           }
       }
   }
       /* echo $marka[$key].' - мар <br>';
        echo $model[$key].' - мод <br>';
        echo $cvet[$key].' - цвет <br>';
        echo $nomer[$key].' - ном <br>';
        echo $flag[$key].' - фл <br>';
        echo $idcl.' - id  <br>';
       */


    $data_cl=get_a($idcl);
}
 else {             // первый запуск
    $idcl = $_GET["idcl"];
    if (!empty($idcl)) {
        $data_cl=get_a($idcl);
        /*print_r($data_cl);*/
    }
}

?>
<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../сss/style.css">
    <title>Стоянка</title>
</head>
<body>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a href="/park/"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-fill home" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 3.293l6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                </svg></a></li>
    </ol>
</nav>
<form method="post">
    <?php
    $count = 0;
    foreach ($data_cl as $row) {
        if ($count == 0) {
            echo '<div class="block-client">
               <h1>Клиент</h1>
                <div class="container">
                 <input name="idcl" type="hidden" value="' . $row['idcl'] . '">
                    <div class="row justify-content-md-center">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fio">ФИО</label>
                                <input name="fio" type="text" required class="form-control" id="fio" value="' . $row['fio'] . '">
                            </div>
                            <div class="form-group">
                                <label for="gender">Пол</label>
                                <select name="gender" class="form-control" id="gender">
                                    <option value="жен" ' . ($row['gender'] == 'жен' ? 'selected' : '') . '>жен</option>
                                    <option value="муж" ' . ($row['gender'] == 'муж' ? 'selected' : '') . '>муж</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cellphone">Телефон</label>
                                <input name="cellphone" type="text" required class="form-control" id="cellphone" value="' . $row['cellphone'] . '">
                            </div>
                            <div class="form-group">
                                <label for="adres">Адрес</label>
                                <input name="adres" type="text" required class="form-control" id="adres" value="' . $row['adress'] . '">
                            </div>
                        </div>
                    </div>
                </>
                </div>
                <h2> Автомобиль </h2>
                  <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-6">';
        }

            echo '
        <div class="block-avto">
            <div class="form-group" >
                    <label for="Inputmarka" > Марка</label >
                    <input name = "marka[]" type = "text" required class="form-control" id = "marka" value="' . $row['marka'] . '">
                </div >
                <div class="form-group" >
                    <label for="Inputmodel" > Модель </label >
                    <input name = "model[]" type = "text" required class="form-control" id = "model" value="' . $row['model'] . '">
                </div >
                <div class="form-group" >
                    <label for="Inputcolour" > Цвет кузова </label >
                    <input name = "cvet[]" type = "text" required class="form-control" id = "cvet" value="' . $row['cvet'] . '">

                </div >
                <div class="form-group" >
                    <label for="number" > Гос Номер РФ </label >
                    <input name = "nomer[]" type = "text" required class="form-control" id = "nomer" value="' . $row['nomer'] . '">
                </div >
                <div class="form-group" >
                    </div>
                    <div class="form-group form-check" >
                        <input value="1" name = "flag[]" type = "checkbox" class="form-check-input"  ' . ($row['flag'] == '1' ? 'checked' : '') . '>
                        <label class="form-check-label" for="exampleCheck1" > Машина на парковке </label >
                </div>
                
                 <input name="ida[]" type="hidden" value="' . $row['ida'] . '">
         </div>';

            $count++;
    }

    ?>


    <div class="block-avto">
                <div class="form-group">
                    <label for="Inputmarka">Марка</label>
                    <input name="marka[]" required type="text" class="form-control" id="marka" >

                </div>
                <div class="form-group">
                    <label for="Inputmodel">Модель </label>
                    <input name="model[]" required type="text" class="form-control" id="model">
                </div>
                <div class="form-group">
                    <label for="Inputcolour">Цвет кузова</label>
                    <input name="cvet[]" required type="text" class="form-control" id="cvet" >

                </div>
                <div class="form-group">
                    <label for="number">Гос Номер РФ</label>
                    <input name="nomer[]" required type="text" class="form-control" id="nomer">
                </div>
                <div class="form-group">
                    <div class="form-group form-check">
                        <input value="1" name="flag[]" type="checkbox" class="form-check-input" id="flag">
                        <label class="form-check-label" for="exampleCheck1">Машина на парковке</label>
                    </div>
                    </div>

                     <input name="ida[]" type="hidden" value="false">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>

            </div>
        </div>
    </div>
</form>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>