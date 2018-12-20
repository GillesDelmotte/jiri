<h1>
    bien le bonjour {{$user->name}}
</h1>
<div>
    <a href="{{config('app.url')}}/token/{{$user->token}}">
        cliquez sur ce lien pour vous connecter au jury&nbsp;: {{$jiri->name}}!
    </a>
</div>
