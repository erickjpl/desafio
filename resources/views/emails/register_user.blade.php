@component('mail::message')
{{ __("Hola **:name :lastname**, bienvenido!", ['name' => $user->name, 'lastname' => $user->lastname]) }}<br />
{{ __("Su registro ha sido satisfactorio..!") }}<br />

{{ __("Sus datos:") }}<br />
...{{ __("**email:** :email", ['email' => $user->email]) }}<br />
...{{ __("**usuario:** :user", ['user' =>$user->name]) }}<br />

{{ __("Gracias por registrarse") }}<br />
{{ __("app.name") }}
@endcomponent
