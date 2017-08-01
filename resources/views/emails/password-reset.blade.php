
<p style="text-align: left;font-size:16px;">Ahoj {{ $first_name }},</p>
{{-- <p style="text-align: left;font-size:16px;">Hi {{ $first_name }},</p> --}}

<p style="text-align: left;font-size:16px;">nedávno jste požádal odkaz pro obnovu hesla pro Váš účet pro registraci do závodu 3 jezy. Pokud jste tento požadavek nevyvolal, tak prosím tento e-mail ignorujte.</p>
{{-- <p style="text-align: left;font-size:16px;">Recently you requested password reset link for your Codingo Tuts account. If you did not request password reset, then please ignore this email.</p> --}}

<p style="text-align: left;font-size:16px;">Klikněte prosím na následující odkaz <a target="_blank" href="{{ route('auth.reset', ['token' => $token]) }}">Obnovit heslo</a>.</p>
{{-- <p style="text-align: left;font-size:16px;">Please click on following link <a target="_blank" href="{{ route('auth.reset', ['token' => $token]) }}">Reset Password</a>.</p> --}}

<p style="text-align: left;font-size:15px;">S pozdravem,</p>
{{-- <p style="text-align: left;font-size:15px;">Sincerely,</p> --}}

<p style="text-align: left;font-size:15px;">Organizační tým závodu 3 jezy</p>
{{-- <p style="text-align: left;font-size:15px;">Codingo Support</p> --}}
