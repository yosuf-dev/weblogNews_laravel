@extends('auth.layout')
@section('title', 'ورود به حساب | AVENIQ')
@section('content')
<div class="auth-heading"><span class="auth-kicker">خوش برگشتی</span><h2>ورود به حساب</h2><p>اطلاعاتت رو وارد کن تا وارد پنل مدیریت بشی.</p></div>
@if ($errors->any())<div class="auth-alert" role="alert">{{ $errors->first() }}</div>@endif
<form class="auth-form" method="POST" action="{{ url('/login') }}">
    @csrf
    <label for="email">ایمیل</label>
    <div class="field-wrap"><span class="field-icon">✉</span><input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="name@example.com" autocomplete="email" required autofocus></div>
    <div class="label-row"><label for="password">رمز عبور</label><a href="{{ url('/forgot-password') }}">فراموشی رمز؟</a></div>
    <div class="field-wrap"><span class="field-icon">⌑</span><input id="password" name="password" type="password" placeholder="رمز عبورت رو وارد کن" autocomplete="current-password" required><button class="password-toggle" type="button" data-toggle-password="password" aria-label="نمایش رمز عبور">◉</button></div>
    <label class="remember-row"><input type="checkbox" name="remember" value="1"><span class="custom-check"></span><span>من رو به خاطر بسپار</span></label>
    <button class="auth-submit" type="submit"><span>ورود به پنل</span><span class="submit-arrow">←</span></button>
</form>
<div class="auth-switch">هنوز حساب نداری؟ <a href="{{ url('/register') }}">ایجاد حساب <span>←</span></a></div>
<div class="auth-divider"><span>یا</span></div>
<button class="social-button" type="button" data-demo-notice><span class="google-g">G</span> ادامه با Google <span class="social-soon">نمونه</span></button>
@endsection
