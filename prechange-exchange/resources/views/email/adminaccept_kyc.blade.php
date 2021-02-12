@include('email.header')
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Hi {{ ucfirst($user->name) }},</td><td align='left'>&nbsp;</td></tr>
<tr><td colspan='3' align='center' height='1' style='padding:0px;'></td></tr>
<tr><td align='left' style='padding-top:0px;'>&nbsp;</td><td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>Your KYC Registration process completed successfully. Please Login and continue to trade</td><td align='left' style='padding-top:0px;'>&nbsp;</td></tr>

@include('email.footer')

