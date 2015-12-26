
<Response>
    <Gather action="/incoming/index/booking/" method="POST" timeout="10" finishOnKey="*">
        <Say>
        	Please enter room number ends with star.
        </Say>
    </Gather>
    <Say>We didn't receive any input. Goodbye!</Say>
</Response>