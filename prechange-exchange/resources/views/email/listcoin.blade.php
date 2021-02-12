@include('email.header')
<tr>
	<td align='left'>Hi Admin,</td><td style='text-align:left;font-size: 15px;color:#000;'></td>&nbsp;<td align='left'>&nbsp;</td>
</tr>
<tr>
	<td colspan='4' align='center' height='1' style='padding:0px;'></td>
</tr>
<tr>
	<td align='left'>Someone require following details,</td><td style='text-align:left;font-size: 15px;color:#000;'></td>&nbsp;<td align='left'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>Coin name : {{ $coinname }}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>Ticker : {{ $ticker }}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>Website : {{ $website }}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>Medialink : {{ $medialink }}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>Etherum address : {{ $etherumaddress }}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>
<tr>
	<td align='left' style='padding-top:0px;'>Extra info : {{ rawurldecode($extrainfo) }}</td>
	<td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>&nbsp;</td>
	<td align='left' style='padding-top:0px;'>&nbsp;</td>
</tr>


