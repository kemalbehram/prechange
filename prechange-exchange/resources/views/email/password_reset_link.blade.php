@include('email.header')
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Hi {{ ucfirst($username) }},</td><td align='left'>&nbsp;</td></tr>

<tr><td colspan='3' align='center' height='1' style='padding:0px;'></td></tr>
<tr><td align='left' style='padding-top:0px;'>&nbsp;</td><td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>You are receiving this email because we received a password reset request for your account.</td><td align='left' style='padding-top:0px;'>&nbsp;</td></tr>


<tr><td colspan='3' align='center' height='30' style='padding:0px;'></td></tr>

<tr><td align='center'>&nbsp;</td><td align='center'><a href="{{ url('/password/reset/'.$token) }}" style='color:#fff;padding:9px 10px;text-decoration:none;    background:#2f4982;text-transform:uppercase;font-size:13px;background-size: contain;font-weight:600;' target="_blank">Reset Password</a></td><td align='center'>&nbsp;</td></tr>

<tr><td colspan='3' align='center' height='30' style='padding:0px;'></td></tr>

@include('email.footer')


