@include('email.header')
<tr>
	<td align='left' width="70%"><b style="font-size: 18px;">Hi Admin,</b></td>
	<td style='text-align:left;font-size: 15px;color:#000;'></td>
	<td align='left'>&nbsp;</td>
</tr>
<tr>
	<td colspan='3' align='center' height='1' style='padding:0px;'></td>
</tr>
<tr>
	<td align='left'>Someone user contact following details,</td>
	<td style='text-align:left;font-size: 15px;color:#000;'></td>
	<td align='left'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>User name : {{$name}}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>Email : {{ $email }}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>Skype / Phone : {{ $mobile }}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>
<!-- <tr>
	<td align='left' style='padding-top:0px;'>Message : </td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr> -->

<tr>
	<td colspan='3' align='center' height='3' style='padding:0px;'></td>
</tr>

@include('email.footer')

