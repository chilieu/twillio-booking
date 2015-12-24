<?php

    // if the caller pressed anything but 1 send them back
    if(strlen($_REQUEST['Digits']) != '3') {
        header("Location: incoming.php");
        die;
    }

    $numbers = $_REQUEST['Digits'];
    $sum = array_sum(str_split($numbers));

$file = 'incoming.log';
// Open the file to get existing content
$current = file_get_contents($file);
// Append a new person to the file
$current .= "Digits: {$numbers} - Total: {$sum}\n";
$current .= print_r($_REQUEST, true) . "\n";
// Write the contents back to the file
file_put_contents($file, $current, FILE_APPEND);

    // the user pressed 1, connect the call to 310-555-1212
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Say>Total of your 3 random digits is  <?=$sum?>.</Say>
</Response>