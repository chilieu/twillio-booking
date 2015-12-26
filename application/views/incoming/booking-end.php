<Response>
    <Say>Thank you for calling Orange Church booking system.
    	Your booking detail on:
    	date: <?=date("F j, Y", strtotime($booking['day']))?>,
    	time: <?=date("g:i a", strtotime($booking['time']))?>,
    	we will call you to confirm your booking date.</Say>
</Response>