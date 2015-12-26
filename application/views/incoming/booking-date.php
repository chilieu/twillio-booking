
<Response>
    <Gather action="/incoming/index/booking/" method="POST" timeout="10" finishOnKey="*">
        <Say>
        	Please enter date time as 2 digits for the month and 2 digits for the day and ends with star.
        	Example: if you want to book a room on Jun 20, please press 0 6 2 0 and ends with star.
        </Say>
    </Gather>
    <Say>We didn't receive any input. Goodbye!</Say>
</Response>