<?php
include("includes/app.php");

	//insert incoming call to db
    $queryInsert = "INSERT INTO incoming (caller, json_data) VALUES ('{$from}', '{$json_data}')";
    $insert = $db->insert($queryInsert);

?>
<Response>
    <Say>Hello <?php echo $name?>, Please press 1 to book a room</Say>
    <Gather numDigits="1" action="booking.php" method="POST" timeout="10" finishOnKey="*">
        <Say>Please enter 3 random digits, press star to finish.</Say>
    </Gather>
</Response>