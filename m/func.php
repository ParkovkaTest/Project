<?php



$host = 'p556745.mysql.ihc.ru'; // адрес сервера
$database = 'p556745_parkovka'; // имя базы данных
$user = 'p556745_parkovka'; // имя пользователя
$password = 'BFbvUPye8D'; // пароль



function add_table() {
    global $host, $user, $password, $database;

    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));


    $sql = 'CREATE TABLE IF NOT EXISTS `client`
        (
        id INT(3) AUTO_INCREMENT PRIMARY KEY,
        fio VARCHAR(150) NOT NULL,
        gender VARCHAR(10) NOT NULL,
        cellphone VARCHAR(50) NOT NULL,
        adress VARCHAR(250) NOT NULL,
        UNIQUE (cellphone)
        )
        ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;';
    if (!mysqli_query($link, $sql)) {
        echo 'Ошибка при создании базы данных клиентов '  ;
    }

    $sql = 'CREATE TABLE IF NOT EXISTS `avto`
        (
        ida INT(3) AUTO_INCREMENT PRIMARY KEY,
        marka VARCHAR(50) NOT NULL,
        model VARCHAR(50) NOT NULL,
        cvet VARCHAR(50) NOT NULL,
        nomer VARCHAR(250) NOT NULL,
        flag int(1) NOT NULL,
        idcl int(3) NOT NULL,
        UNIQUE (nomer)
        )
        ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;';
    if (!mysqli_query($link, $sql)) {
        echo 'Ошибка при создании базы данных авто' ;
    }
    mysqli_close($link);

}
add_table();


/* Записываем данные клиента */
function add_person($fio, $gender, $cellphone, $adres) {
    global $host, $user, $password, $database;

    $link = mysqli_connect($host, $user, $password, $database);
    $link->set_charset("utf8");


    //$fio = trim($fio);

    if (!$link) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    $sql = mysqli_query($link, 'INSERT INTO client (`fio`, `gender`, `cellphone`, `adress`) VALUES ("' . $fio . '", "' . $gender . '", "' . $cellphone . '", "' . $adres . '")');


    if(!$sql){
        echo "Ошибка подготовки запроса: " . mysqli_error($link);
    } else {
        echo "Данные успешно добавлены в таблицу";
    }

/*    if ($sql) {
        echo "Данные успешно добавлены в таблицу";
    } else {
        echo "Произошла ошибка";
    }*/

    mysqli_close($link);
}


/* Получаем ID клиента */
function get_id_cl(){
    global $host, $user, $password, $database;

    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));


    if(!$link) {
        die("Ошибка подключения: ".mysqli_connect_error());
    }

    $sql = mysqli_query($link, 'SELECT MAX(id) FROM client');

    $rows = mysqli_num_rows($sql);

    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($sql);
        for ($j = 0 ; $j < 3 ; ++$j)
            return $row[$j];
    }

    mysqli_free_result($sql);

    mysqli_close($link);
}


/* Записываем данные авто */
function add_avto($marka, $model, $cvet, $nomer, $flag, $id){
         global $host, $user, $password, $database;

    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
    $link->set_charset("utf8");

    if(!$link) {
        die("Ошибка подключения: ".mysqli_connect_error());
    }

    $sql = mysqli_query($link, 'INSERT INTO avto (`marka`, `model`, `cvet`, `nomer`, `flag`,`idcl`) VALUES ("'.$marka.'", "'.$model.'", "'.$cvet.'", "'.$nomer.'", "'.$flag.'","'.$id.'")');


    if ($sql) {
        echo '<div class="alert alert-success" role="alert"> Данные авто успешно добавлены в таблицу </div>';
    }
    else {
        echo "Произошла авто ошибка";
    }
        mysqli_close($link);
}

//распечатать таблицу
function print_table($start, $kolvo) {
    global $host, $user, $password, $database;

    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
    $link->set_charset("utf8");

    if(!$link) {
        die("Ошибка подключения: ".mysqli_connect_error());
    }

    $avto = mysqli_query($link, 'SELECT * FROM avto, client WHERE avto.idcl=client.id ORDER BY client.id DESC LIMIT '.intval($start).', '.intval($kolvo).';');

    if ($avto) {
        return mysqli_fetch_all($avto, MYSQLI_ASSOC);
    }
    else {
        echo "Произошла в получении таблицы авто";
    }



    mysqli_close($link);
}


/*удалить АВТО*/
function del_a($delid, $idcl) {
    global $host, $user, $password, $database;

    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
    $link->set_charset("utf8");

    if(!$link) {
        die("Ошибка подключения: ".mysqli_connect_error());
    }

    $sql = mysqli_query($link, "DELETE FROM avto WHERE ida=$delid");
    if ($sql) {
        echo "Данные авто удалились";
    }
    else {
        echo "Произошла ошибка удаления";
    }
    $sql = mysqli_query($link, "SELECT * FROM avto WHERE idcl=$idcl");
    if (mysqli_num_rows ($sql)<1) {
        if ($sql) {
            echo "сосчтитано";
        } else {
            echo "Произошла ошибка счёта";
        }
        $sql = mysqli_query($link, "DELETE FROM client WHERE id=$idcl");
        if ($sql) {
            echo "последнее авто удалилось";
        } else {
            echo "Произошла ошибка удаления";
        }
    }
    mysqli_close($link);
}

/*Получает по конкретному ID*/
function get_a($idcl) {
    global $host, $user, $password, $database;

    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
    $link->set_charset("utf8");

    if(!$link) {
        die("Ошибка подключения: ".mysqli_connect_error());
    }

    $sql = mysqli_query($link, "SELECT * FROM avto, client WHERE avto.idcl=client.id AND client.id='$idcl'");
    if ($sql) {
        return mysqli_fetch_all($sql, MYSQLI_ASSOC);
    }
    else {
        echo "Произошла ошибка удаления";
    }
    mysqli_close($link);

}

function edit_person($idcl, $fio, $gender, $cellphone, $adres) {
    global $host, $user, $password, $database;

    $link = mysqli_connect($host, $user, $password, $database);
    $link->set_charset("utf8");


//$fio = trim($fio);

    if (!$link) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    $sql = mysqli_query($link, 'UPDATE client SET fio="'.$fio.'" , gender="'.$gender.'" , cellphone="'.$cellphone.'" , adress="'.$adres.'"  WHERE id="'.$idcl.'"');


    if (!$sql) {
        echo "ошибка обновления: " . mysqli_error($link);
    } else {
        echo "Данные клиента успешно обновленны<br>";
    }

    mysqli_close($link);
}

function edit_avto($ida, $marka, $model, $cvet, $nomer, $flag, $idcl){
    global $host, $user, $password, $database;

    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
    $link->set_charset("utf8");

    if(!$link) {
        die("Ошибка подключения: ".mysqli_connect_error());
    }

    $sql = mysqli_query($link, 'UPDATE avto SET  marka="'.$marka.'" , model="'.$model.'" , cvet="'.$cvet.'" , nomer="'.$nomer.'", flag="'.$flag.'",idcl="'.$idcl.'"  WHERE ida="'.$ida.'"');

    if ($sql) {
        echo "Данные авто успешно добавлены в таблицу <br>";
    }
    else {
        echo "Произошла авто ошибка <br>";
    }

    mysqli_close($link);
}



function count_avto(){
    global $host, $user, $password, $database;

    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

    if(!$link) {
        die("Ошибка подключения: ".mysqli_connect_error());
    }

    $res = mysqli_query($link, "SELECT COUNT(*) FROM `avto`");
    $row = mysqli_fetch_array($res);

    return $row[0];


    //mysqli_close($link);
}


?>










