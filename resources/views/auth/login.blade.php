@extends('layouts.layout')

@section('content')
<main id="kv-login-page" class="kv-login-page">
    <div class="kv-login-shell">
        <section class="kv-login-story" aria-label="KV Management sign-in information">
            <a class="kv-login-brand" href="{{ url('/') }}" aria-label="KV Management home">
                <span class="kv-login-brand-mark"><b>KV</b></span>
                <span class="kv-login-brand-name">KV MANAGEMENT <small>LLC</small><i></i></span>
            </a>

            <div class="kv-login-story-copy">
                <h1>Welcome Back!</h1>
                <p>Sign in to access store operations<br>and analytics.</p>
                <ul class="kv-login-features">
                    <li><i class="fa fa-bar-chart"></i><span>Track Sales &amp; Performance</span></li>
                    <li><i class="fa fa-building-o"></i><span>Manage Stores</span></li>
                    <li><i class="fa fa-users"></i><span>Access Reports</span></li>
                    <li><i class="fa fa-shield"></i><span>Secure &amp; Reliable</span></li>
                </ul>
            </div>

            <div class="kv-login-laptop" aria-hidden="true">
                <div class="kv-laptop-screen">
                    <div class="kv-laptop-toolbar"><span>KV</span><i></i><i></i><i></i></div>
                    <div class="kv-laptop-kpis"><b></b><b></b><b></b></div>
                    <div class="kv-laptop-chart"><span style="height:40%"></span><span style="height:62%"></span><span style="height:48%"></span><span style="height:76%"></span><span style="height:57%"></span><span style="height:88%"></span></div>
                    <div class="kv-laptop-panels"><i></i><i></i><i></i></div>
                </div>
                <div class="kv-laptop-base"></div>
            </div>
            <p class="kv-login-tagline">Your Business<br>Our Priority<span></span></p>
        </section>

        <section class="kv-login-panel" aria-labelledby="kv-login-title">
            <div class="kv-login-decoration" aria-hidden="true"></div>
            <div class="kv-login-panel-content">
                <h2 id="kv-login-title">KV Management</h2>
                <p class="kv-login-subtitle">Sign in to your account</p>

                @if (count($errors) > 0)
                    <div class="alert alert-danger kv-login-errors" role="alert">
                        <strong>We couldn’t sign you in.</strong>
                        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <form class="kv-login-form" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email">Email or Username</label>
                        <div class="kv-login-input"><i class="fa fa-envelope-o" aria-hidden="true"></i><input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your email or username" autocomplete="username" required autofocus></div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="kv-login-input kv-password-input"><i class="fa fa-lock" aria-hidden="true"></i><input id="password" type="password" class="form-control" name="password" placeholder="Enter your password" autocomplete="current-password" required><button type="button" class="kv-password-toggle" aria-label="Show password" aria-pressed="false"><i class="fa fa-eye" aria-hidden="true"></i></button></div>
                    </div>
                    <div class="kv-login-options">
                        <label class="kv-remember"><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <span class = "remember_me">Remember me</span></label>
                        <a href="{{ url('/password/reset') }}">Forgot password?</a>
                    </div>
                    <button type="submit" class="kv-login-submit">Sign In <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                </form>
            </div>
        </section>
    </div>
</main>
<script>
(function () {
    var toggle = document.querySelector('.kv-password-toggle');
    var password = document.getElementById('password');
    if (!toggle || !password) return;
    toggle.addEventListener('click', function () {
        var show = password.type === 'password';
        password.type = show ? 'text' : 'password';
        toggle.setAttribute('aria-pressed', show ? 'true' : 'false');
        toggle.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
        toggle.innerHTML = '<i class="fa ' + (show ? 'fa-eye-slash' : 'fa-eye') + '" aria-hidden="true"></i>';
    });
}());
</script>
@endsection
