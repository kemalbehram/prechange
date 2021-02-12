@include('email.header')
<tr>
	<td align='left' width="15"></td>
	<td style='text-align:left;font-size: 15px;color:#000;'>
		Hi {{ ucfirst($user->name) }},
	</td>
	<td width="15" align='left'>&nbsp;</td>
</tr>
<tr>
	<td colspan='3' align='center' height='1' style='padding:0px;'></td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'></td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>Your KYC Registration process rejected by admin. Please Login and upload your ID verification</td>
	<td align='left' style='padding-top:0px;'></td>
</tr>
<tr>
	<td colspan='3' align='center'  style='padding:0px;'>&nbsp;</td>
</tr>
@include('email.footer')


