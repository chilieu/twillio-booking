<?php

    // now greet the caller
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

    // make an associative array of callers we know, indexed by phone number
    $people = array(
        "+17148555283"=>"Quan Luu",
        "+17149022817"=>"Yen Tran",
        "+17142613167"=>"Chi Lieu"
    );

include("MySql.php");

    $digits = empty($_REQUEST['Digits']) ? "" : $_REQUEST['Digits'];

    $from = empty($_REQUEST['From']) ? "" : $_REQUEST['From'];

    $name = $people[$from];

    $json_data = json_encode($_REQUEST);

    $db = new MySql();

    $queryInsert = "INSERT INTO tracking (callid, digits) VALUES ('{$from}', '{$digits}')";
    $insert = $db->insert($queryInsert);

/*
    $query = "SELECT * FROM TABLE WHERE 1";
    $select = $db->select($query);

    //Mostrar o Array gerado pela Class
    echo "<pre>";
    print_r($select);

    //Total de registros
    echo $db->getNumRows($select);

    //Inserindo dados no Banco
    $queryInsert = "INSERT INTO TABLE (COLUMNS_01) VALUES ('VALUE_01')"
    $insert = $db->insert($queryInsert);

    //Ultimo ID inserido
    echo $db->getId();

    //Atualizando uma tabela
    $queryUpdate = "UPDATE TABLE SET COLUMNS_01 = 'VALUE_01 WHERE ID_COLUMNS = $var";
    $update = $db->insert($queryUpdate);

*/

?>