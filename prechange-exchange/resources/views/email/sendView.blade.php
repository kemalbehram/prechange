@include('email.header')

<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Welcome to Prechange</td><td align='left'>&nbsp;</td></tr>
<tr><td colspan='3' align='center' height='1' style='padding:0px;'></td></tr>
<tr><td align='left' style='padding-top:0px;'>&nbsp;</td><td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>Please confirm your email by clicking the button below</td><td align='left' style='padding-top:0px;'>&nbsp;</td></tr>
<tr><td colspan='3' align='center' height='30' style='padding:0px;'></td></tr>
<tr><td align='center'>&nbsp;</td><td align='center'><a href="{{route('sendEmailDone', ['email' => $user->email, 'verifyToken' => $user->verifyToken])}}" style='color:#fff;padding:9px 10px;text-decoration:none;    background:#1b1464;text-transform:uppercase;font-size:13px;background-size: contain;font-weight:600;'>Confirm email address</a></td><td align='center'>&nbsp;</td></tr>
<tr><td colspan='3' align='center' height='30' style='padding:0px;'></td></tr>

@include('email.footer')








	
















