<h2>Login</h2>

@if(session('error'))
    <div style="color: red; margin-bottom: 15px;">
        {{ session('error') }}
    </div>
@endif

<a href="/auth/google">Login with Google</a>
<br>
<a href="/auth/facebook">Login with Facebook</a>