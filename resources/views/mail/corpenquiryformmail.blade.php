<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Corporate Enquire Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <style type="text/css">
    a[x-apple-data-detectors] {color: inherit !important;}
  </style>

</head>
<body style="margin: 0; padding: 0;">
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td style="padding: 20px 0 30px 0;">

<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
  <tr>
    <td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0;">
      <img src="{{asset('img/l1.jpg')}}"  width="220" height="100" style="display: block;" />
    </td>
  </tr>
  <!-----------------content----------------------->
          <tr>
    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
          <td style="color: #153643; font-family: Arial, sans-serif;">
            <h1 style="font-size: 24px; margin: 0;">Welcome To Customwish
</h1>
          </td>
        </tr>
        <tr>
          <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
            <p style="margin: 0;">
                @if($user=='user')
              Hi,{{$name}}
</p>
<p>Thank you for your enquiry.</p>
<p>
In response to your enquiry, we will get back to you with the relevant information at the earliest</p>
<br>
<p>
Thank you</p>
<p>Customwish</p>
@endif
@if($user=='admin')
<table border="1" cellspacing="1" cellpadding="5">
    <tr>
    <td> product Name</td><td>:</td><td>{{$corp_name}}</td>
    </tr>
    <tr>
    <td> Name</td><td>:</td><td>{{$name}}</td>
    </tr>
    <tr>
    <td> Email</td><td>:</td><td>{{$email}}</td>
    </tr>
    <tr>
    <td> Phone Number</td><td>:</td><td>{{$phone}}</td>
    </tr>
    <tr>
    <td> Quantity</td><td>:</td><td>{{$quantity}}</td>
    </tr>
    <tr>
    <td> Message</td><td>:</td><td>{{$message1}}</td>
    </tr>
 </table>
@endif

</td>
</tr>
</table>
</td>
</tr>

  <!-------------------footer------------------>

</table>

      </td>
    </tr>
  </table>
</body>
</html>

