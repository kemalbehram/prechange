@include('email.header')

<tr>
	<td align='left'>Hi {{ ucfirst($username) }},</td><td style='text-align:left;font-size: 15px;color:#000;'></td>&nbsp;<td align='left'>&nbsp;</td>
</tr>
<tr>
	<td colspan='4' align='center' height='1' style='padding:0px;'></td>
</tr>
<tr>
	<td align='left'>Thank you for Support Ticket! Your Ticket ID is {{ $referenceNo }} ,</td><td style='text-align:left;font-size: 15px;color:#000;'></td>&nbsp;<td align='left'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>Reply Message : {{ $message }}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>

@include('email.footer')

