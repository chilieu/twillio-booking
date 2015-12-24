<?php
include("includes/app.php");

?>
<Response>
    <Say>Hello <?php echo $name?>, Please press 1 to book a room</Say>
    <Gather numDigits="1" action="booking.php" method="POST" timeout="10" finishOnKey="*">
        <Say>Please enter 3 random digits, press star to finish.</Say>
    </Gather>
</Response>