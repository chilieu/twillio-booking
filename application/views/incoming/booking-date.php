
<Response>
    <Gather action="/incoming/index/booking/" method="POST" timeout="10" finishOnKey="*">
        <Say>
        	Please enter date time as 2 digits for month and 2 digits for day and ends with star.
        	Example: if you want to book a room on Dec 24, please press 12 24 and ends with star.
        </Say>
    </Gather>
    <Say>We didn't receive any input. Goodbye!</Say>
</Response>