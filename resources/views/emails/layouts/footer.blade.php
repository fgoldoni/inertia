<hr style="background: #e7e7e7;border: none;height: 1px;margin-top: 30px;">
<p style="
            line-height: 24px;
            font-size: 12px;
            color: #000;
            width:100%;">
<p>
    Best regards
    <br/>
    Your team from {{ env('APP_NAME', 'SellFirst Portal') }}
    <br/><br/>
    {{ env('APP_NAME', 'SellFirst Portal') }} GROUP
    <br/><br/>
    {{ env('APP_NAME', 'SellFirst Portal') }} Deutschland GmbH
    <br/>
    Niendorfer Straße 43 | D-22529 Hamburg | Deutschland
    <br/><br/>
    Chairman of the Supervisory Board: Goldoni Fouotsa<br/>
    Administration: Goldoni Fouotsa (Chairman)
    <br/>
    Domicile of the company: Hamburg
    <br/>
    Commercial register: Amtsgericht Hamburg HRB 66666
</p>
<hr style="background: #e7e7e7;border: none;height: 1px;">
<?php echo app('translator')->get(
    "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    "into your web browser:\n",
    [
        'actionText' => 'Login Link'
    ]
); ?>
<br>
<a href="{{ $url }}">{{ $url }}</a>
