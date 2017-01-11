@extends('emails.layouts.base')

@section('title')
    Recuperar cuenta
@stop

@section('content')
    <p>Le enviamos este mensaje porque ha solicitado recuperar la cuenta de ProteCMS. <br>Si no es así, por favor, ignore este mensaje.</p>
    <p>Para recuperar la cuenta debe hacer clic en el enlace que viene a continuación:</p>
    <br>
    <!-- Start Button -->
    <table width="200" cellpadding="0" cellspacing="0" align="center" border="0">
        <tr>
            <td width="200" height="36" bgcolor="#25c2e6" align="center" valign="middle"
                style="font-family: Arial,Helvetica,sans-serif; font-size: 16px; color: #ffffff;
        line-height:18px;">
                <a href="{{ route('auth::password', ['token' => $user->remember_token]) }}" target="_blank" alias="" style="text-decoration: none; color: #ffffff;">Recuperar cuenta</a>
            </td>
        </tr>
    </table>
    <!-- End Button -->
    <br><br>
@stop