<Response>
    <Say>Thank you for calling Orange Church booking system.</Say>
    <Gather numDigits="1" action="/incoming/index/booking/" method="POST" timeout="10">
        <Say>
        	Press one to make a new booking.
        	Press two to listen the booking confirmation.
        	Press star to repeat.
        </Say>
    </Gather>
</Response>