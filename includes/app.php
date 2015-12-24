<?php

    // now greet the caller
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

    // make an associative array of callers we know, indexed by phone number
    $people = array(
        "+17148555283"=>"Quan Luu",
        "+17142613167"=>"Chi Lieu"
    );

    $digits = empty($_REQUEST['Digits']) : "" : $_REQUEST['Digits'];

    $from = empty($_REQUEST['From']) : "" : $_REQUEST['From'];

    $name = $people[$from];

?>