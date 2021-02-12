<html>
<body style='width:100%;padding:0px;margin:0px;font-family:arial;'>
<table align='center' width='100%' border='0' cellspacing='0' cellpadding='10' style='margin:55px auto; width:100%; background-color:#fff; font-family:Arial, Helvetica, sans-serif; color:#333; border:1px solid #ccc;max-width:550px;'>
<tr>
	<td colspan='3' style='padding:0px;'><img src='{{ url("/images/emailbanner.jpg") }}' style='width:100%;'></td>
</tr>
<tr>
	<td colspan='3' align='center' height='20' style='padding:0px;'></td>
</tr>
<tr>
	<td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Welcome to {{ config('app.name')}}</td><td align='left'>&nbsp;</td>
</tr>
<tr>
	<td colspan='3' align='center' height='1' style='padding:0px;'></td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>&nbsp;</td><td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>Please confirm your email by clicking the button below</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>
<tr>
	<td colspan='3' align='center' height='30' style='padding:0px;'></td>
</tr>
<tr>
	<td align='center'>&nbsp;</td>
	<td align='center'><a href="http://masmint.demozab.com/api/verify/{{$user->email.'/'.$user->verifyToken }}" style='color:#fff;padding:14px 22px;text-decoration:none;background-color:#000000;text-transform:uppercase;font-size:15px;'>Confirm email address</a></td>
	<td align='center'>&nbsp;</td>
</tr>
<tr>
	<td colspan='3' align='center' height='30' style='padding:0px;'></td>
</tr>
<tr>
	<td align='left' style='padding-bottom:0px;'>&nbsp;</td><td style='text-align:left;font-size:15px;color:#000000;padding-bottom:0px;'>Why,we need to be sure this really you.</td>
	<td align='left' style='padding-bottom:0px;'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-bottom:0px;'>&nbsp;</td><td style='text-align:left;font-size:15px;line-height:23px;color:#000000;padding-bottom:0px;'>Thanks, <br/>Regards <br />{{ config('app.name')}} Team</td>
	<td align='left' style='padding-bottom:0px;'>&nbsp;</td>
</tr>
<tr>
	<td colspan='3' align='center' height='3' style='padding:0px;'></td>
</tr>
<tr>
	<td colspan='3' align='center' height='15' style='padding:0px;'></td>
</tr>
<tr>
	<td colspan='3' height='50' style='text-align:center; background-color:#000000;padding:0px;'></td>
</tr>
</table>
</body>
</html>