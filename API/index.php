<?php
include_once('v1/config.php');
include_once('v1/db_connect.php');
include_once('v1/functions.php');
include_once('v1/err_handler.php');

if(!isset($_GET['type'])){
    echo ajax_echo(
        "Ошибка!", 
        "Нет GET параметра type",
        true,
        "ERROR",
        null
    );
    exit();
}

//ДОБАВЛЕНИЕ

//добавить продукт
if(preg_match_all("/^(add_product)$/ui", $_GET['type'])){

    if(!isset($_GET['name'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр name!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    if(!isset($_GET['price'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр price!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    if(!isset($_GET['type_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр type_id!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    if(!isset($_GET['sup_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр sup_id!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    if(!isset($_GET['date_of_delivery'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр date_of_delivery!",
            true,
            "ERROR",
            null
        );
        exit();
    }


    if(!isset($_GET['store_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр store_id!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    

    $query = "INSERT INTO `product`(`name`,`price`,`type_id`,`sup_id`,`date_of_delivery`,`store_id`) VALUES ('".$_GET['name']."','".$_GET['price']."',
    '".$_GET['type_id']."','".$_GET['sup_id']."','".$_GET['date_of_delivery']."','".$_GET['store_id']."')";

    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    echo ajax_echo(
         "Уcпех!",
         "Новый продукт добавлен в бд!",
         false,
         "SUCCESS",
         null
     );
     exit();
} 

//добавить поставщика
else if(preg_match_all("/^(add_supplier)$/ui", $_GET['type'])){
    if(!isset($_GET['name_comp'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр name_comp!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    if(!isset($_GET['inn'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр inn!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    if(!isset($_GET['phone'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр phone!",
            true,
            "ERROR",
            null
        );
        exit();
    }


    $query = "INSERT INTO `suppliers`(`name_comp`,`inn`,`phone`) VALUES ('".$_GET['name_comp']."','".$_GET['inn']."','".$_GET['phone']."')";

    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    echo ajax_echo(
         "Уcпех!",
         "Новый поставщик добавлен в бд!",
         false,
         "SUCCESS",
         null
     );
     exit();
}    

//добавить тип продукта 
else if(preg_match_all("/^(add_type_of_product)$/ui", $_GET['type'])){

    if(!isset($_GET['name'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр name!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    if(!isset($_GET['animal_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр animal_id!",
            true,
            "ERROR",
            null
        );

        exit();
    }


    $query = "INSERT INTO `type_of_product`(`name`,`animal_id`) VALUES ('".$_GET['name']."','".$_GET['animal_id']."')";

    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    echo ajax_echo(
         "Уcпех!",
         "Новый тип продукта добавлен в бд!",
         false,
         "SUCCESS",
         null
     );
     exit();
}   


//ВЫВОД

//вывод таблицы поставщиков 
if(preg_match_all("/^(list_sup)$/ui", $_GET['type'])){

    $query = "SELECT `name_comp` AS 'название компании', `inn` AS 'ИНН', `phone` AS 'телефон' FROM `suppliers` WHERE 1";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $arr_res = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_res, $row);
    }

    echo ajax_echo(
        "Уcпех!",
        "Список поставщиков",
        false,
        "SUCCESS",
        $arr_res
    );
    exit();
}

//вывод таблицы магазинов
if(preg_match_all("/^(list_addres)$/ui", $_GET['type'])){

    $query = "SELECT `city` AS 'город', `street` AS 'улица', `num_of_house` AS 'номер дома' FROM `stores` WHERE 1";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $arr_res = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_res, $row);
    }

    echo ajax_echo(
        "Уcпех!",
        "Список адресов магазинов",
        false,
        "SUCCESS",
        $arr_res
    );
    exit();
}

//вывод названия+тип+стоимоть+животное товара
if(preg_match_all("/^(list_prd)$/ui", $_GET['type'])){

    $query = "SELECT `product`.`name` AS 'навзание продукта', `product`.`price` AS 'стоимость(руб)', `type_of_product`.`name` AS 'тип продукта', `animals`.`name` AS 'животное' FROM `product`, `type_of_product`, `animals` WHERE `product`.`type_id`=`type_of_product`.`id` && `type_of_product`.`animal_id`=`animals`.`id`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $arr_res = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_res, $row);
    }

    echo ajax_echo(
        "Уcпех!",
        "Список продукции",
        false,
        "SUCCESS",
        $arr_res
    );
    exit();
}

//вывод товаров для опред. животного
if(preg_match_all("/^(show_pr_for)$/ui", $_GET['type'])){
    
    $animal_id = 0;
    if(isset($_GET['animal_id'])){
        $animal_id = $_GET['animal_id'];
    }

    if(!isset($_GET['animal_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр animal_id!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $query = "SELECT `name` FROM `type_of_product` WHERE `animal_id` = ".$animal_id."";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $arr_res = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_res, $row);
    }

    echo ajax_echo(
        "Уcпех!",
        "Список продукции",
        false,
        "SUCCESS",
        $arr_res
    );
    exit();

}

//вывод ассортимента магазина в опред. городе и его адрес  
if(preg_match_all("/^(show_pr_from)$/ui", $_GET['type'])){
    
    $store_id = 0;
    if(isset($_GET['store_id'])){
        $store_id = $_GET['store_id'];
    }

    if(!isset($_GET['store_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр store_id!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $query = "SELECT `product`.`name` AS 'навзание продукта', `product`.`price` AS 'стоимость(руб)', `type_of_product`.`name` AS 'тип продукта', `animals`.`name` AS 'животное', CONCAT(`stores`.`street`,' ', `stores`.`num_of_house`) AS 'адрес' FROM `product`, `type_of_product`, `animals`, `stores` WHERE `product`.`type_id`=`type_of_product`.`id` && `type_of_product`.`animal_id`=`animals`.`id` && `product`.`store_id` = `stores`.`id` && `stores`.`id` = ".$store_id."";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $arr_res = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_res, $row);
    }

    echo ajax_echo(
        "Уcпех!",
        "Список ассортимента магазина",
        false,
        "SUCCESS",
        $arr_res
    );
    exit();

}



//ИЗМЕНЕНИЕ

//изм. тип продукта 
else if(preg_match_all("/^(update_type)$/ui", $_GET['type'])){

    $product_id = '';
    if(isset($_GET['id'])){
      $product_id = $_GET['id'];
    }


    if(!isset($_GET['id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр id",
            true,
            "ERROR",
            null
        );
        exit();
    }

    
    $type_id2 = ''; //старое
    if(isset($_GET['type_id2'])){
      $type_id2 = $_GET['type_id2'];
    }

    if(!isset($_GET['type_id2'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр type_id2",
            true,
            "ERROR",
            null
        );
        exit();
    }

    if(!isset($_GET['type_id'])){ //новое значени
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр type_id!",
            true,
            "ERROR",
            null
        );
        exit();
    } else{
        $type_id =  $_GET['type_id'];
    }


    $query = "UPDATE `product` SET `type_id` = '" .$type_id. "' WHERE `type_id` = '".$type_id2."' && `id` ='".$product_id."'"; 
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    echo ajax_echo(
        "Уcпех!",
        "Тип продукта изменен в бд!",
        false,
        "SUCCESS",
        null
    );
    exit();
}


//изм. стоимость продукта
else if(preg_match_all("/^(update_price)$/ui", $_GET['type'])){

    $product_id = '';
    if(isset($_GET['id'])){
      $product_id = $_GET['id'];
    }


    if(!isset($_GET['id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр id продукта",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $price2 = ''; //старое
    if(isset($_GET['price2'])){
      $price2 = $_GET['price2'];
    }

    if(!isset($_GET['price2'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр price2",
            true,
            "ERROR",
            null
        );
        exit();
    }

    if(!isset($_GET['price'])){ //новое значени
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр price!",
            true,
            "ERROR",
            null
        );
        exit();
    } else{
        $price =  $_GET['price'];
    }

    $query = "UPDATE `product` SET `price` = '" .$price. "' WHERE `price` = '".$price2."' && `id` ='".$product_id."'"; 
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    echo ajax_echo(
        "Уcпех!",
        "Стоимость продукта изменено в бд!",
        false,
        "SUCCESS",
        null
    );
    exit();
}


//изм. адрес магазина 
else if(preg_match_all("/^(update_addres)$/ui", $_GET['type'])){

    $store_id = '';
    if(isset($_GET['id'])){
      $store_id = $_GET['id'];
    }


    if(!isset($_GET['id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр id",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $street2 = ''; //старое
    if(isset($_GET['street2'])){
      $street2 = $_GET['street2'];
    }

    if(!isset($_GET['street2'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр street2",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $num_house2 = ''; //старое
    if(isset($_GET['num_house2'])){
      $num_house2 = $_GET['num_house2'];
    }

    if(!isset($_GET['num_house2'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр num_house2",
            true,
            "ERROR",
            null
        );
        exit();
    }

    if(!isset($_GET['street'])){ //новое значени
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр street!",
            true,
            "ERROR",
            null
        );
        exit();
    } else{
        $street =  $_GET['street'];
    }

    if(!isset($_GET['num_house'])){ //новое значени
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр num_house!",
            true,
            "ERROR",
            null
        );
        exit();
    } else{
        $num_house =  $_GET['num_house'];
    }


    $query = "UPDATE `stores` SET `street` = '" .$street. "', `num_of_house` = '" .$num_house. "' WHERE `street` = '".$street2."' && `num_of_house` = '" .$num_house2. "' && `id` ='".$store_id."'"; 
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    echo ajax_echo(
        "Уcпех!",
        "Адрес магазина изменен в бд!",
        false,
        "SUCCESS",
        null
    );
    exit();
}