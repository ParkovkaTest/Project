<?php
include_once('../m/func.php');

if (!empty($_POST)) {
    $fio=htmlspecialchars($_POST["fio"]);
    $gender=htmlspecialchars($_POST["gender"]);
    $cellphone=htmlspecialchars($_POST["cellphone"]);
    $adres=htmlspecialchars($_POST["adres"]);
    $ida=$_POST["ida"];
    $marka=$_POST["marka"];
    $model=$_POST["model"];
    $cvet=$_POST["cvet"];
    $nomer=$_POST["nomer"];
    $flag=$_POST["flag"];

    if (mb_strlen($fio)<3){
        echo '<div class="alert alert-danger" role="alert"> Минимум 3 символа </div>';
        $fio_err="is-invalid";
    } else {
        add_person($fio, $gender, $cellphone, $adres);
        $idcl = get_id_cl();
        add_avto($marka, $model, $cvet, $nomer, $flag, $idcl);

        $new_url='../' ;
        header('Location:'.$new_url);
        echo '<meta http-equiv="refresh" content="1;URL=../">';
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
<h1>Клиент</h1>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-6">
                <div class="form-group">
                    <label for="fio">ФИО</label>
                    <input name="fio" type="text" required class="form-control <?php echo $fio_err; ?>" id="fio" value="<?php echo $fio; ?>">
                    <?php if ($fio_err=="is-invalid") {echo '<div class="invalid-feedback"> Неверные данные </div>';}?>
                </div>
                <div class="form-group">
                    <label for="gender">Пол</label>
                    <select name="gender" class="form-control" id="gender">
                    <option value="жен" <?php ($gender == 'жен' ? 'selected' : ''); ?>  >жен</option>
                    <option value="муж" <?php ($gender == 'муж' ? 'selected' : ''); ?>  >муж</option>
                    </select>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cellphone">Телефон</label>
                    <input name="cellphone" type="text" required class="form-control" id="cellphone" value="<?php echo $cellphone; ?>">
                </div>
                <div class="form-group">
                    <label for="adres">Адрес</label>
                    <input name="adres" type="text" class="form-control" id="adres" value="<?php echo $adres; ?>">
                </div>
         </div>
    </div>
</div>

<h2> Автомобиль </h2>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-6">

    <div class="form-group">
        <label for="Inputmarka">Марка</label>
        <input name="marka" type="text" class="form-control" id="marka" required value="<?php echo $marka; ?>" >

    </div>
    <div class="form-group">
        <label for="Inputmodel">Модель </label>
        <input name="model" type="text" class="form-control" id="model" required value="<?php echo $model; ?>">
    </div>
    <div class="form-group">
        <label for="Inputcolour">Цвет кузова</label>
        <input name="cvet" type="text" class="form-control" id="cvet" required value="<?php echo $cvet; ?>" >

    </div>
    <div class="form-group">
        <label for="number">Гос Номер РФ</label>
        <input name="nomer" type="text" class="form-control" id="nomer" required value="<?php echo $nomer; ?>">
    </div>
    <div class="form-group">
        <div class="form-group form-check">
            <input value="1" name = "flag[]" type = "checkbox" class="form-check-input"  ' . ($row['flag'] == '1' ? 'checked' : '') . '>
            <label class="form-check-label" for="exampleCheck1">Машина на парковке</label>
        </div>
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
