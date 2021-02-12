@include('email.header')

<tr>
	<td align='left'>Hi Admin,</td><td style='text-align:left;font-size: 15px;color:#000;'></td>&nbsp;<td align='left'>&nbsp;</td>
</tr>
<tr>
	<td colspan='4' align='center' height='1' style='padding:0px;'></td>
</tr>
<tr>
	<td align='left'>You have received ticket from following user,</td><td style='text-align:left;font-size: 15px;color:#000;'></td>&nbsp;<td align='left'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>User name : {{ $username }}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>User email : {{ $userEmail }}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>Ticket Id : {{ $reference_no }}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>Message : {{ $message }}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>

<tr>
	<td align='left' style='padding-top:0px;'>Thanks & Regards</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>

<tr>
	<td align='left' style='padding-top:0px;'>{{ ucfirst($username) }}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>