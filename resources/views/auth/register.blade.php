@extends('auth.layout')
@section('title', 'ساخت حساب | AVENIQ')
@section('content')
<div class="auth-heading"><span class="auth-kicker">شروع یک تجربه تازه</span><h2>حساب بساز</h2><p>چند قدم کوتاه تا فضای مدیریت شخصی خودت.</p></div>
@if ($errors->any())<div class="auth-alert" role="alert">{{ $errors->first() }}</div>@endif
<form class="auth-form" method="POST" action="{{ url('/register') }}">
    @csrf
    <label for="name">نام کامل</label>
    <div class="field-wrap"><span class="field-icon">♙</span><input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="مثلاً یوسف صالح‌زاده" autocomplete="name" required></div>
    <label for="email">ایمیل</label>
    <div class="field-wrap"><span class="field-icon">✉</span><input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="name@example.com" autocomplete="email" required></div>
    <label for="password">رمز عبور</label>
    <div class="field-wrap"><span class="field-icon">⌑</span><input id="password" name="password" type="password" placeholder="حداقل ۸ کاراکتر" autocomplete="new-password" minlength="8" required><button class="password-toggle" type="button" data-toggle-password="password" aria-label="نمایش رمز عبور">◉</button></div>
    <label for="password_confirmation">تکرار رمز عبور</label>
    <div class="field-wrap"><span class="field-icon">✓</span><input id="password_confirmation" name="password_confirmation" type="password" placeholder="رمز عبور رو دوباره وارد کن" autocomplete="new-password" minlength="8" required><button class="password-toggle" type="button" data-toggle-password="password_confirmation" aria-label="نمایش رمز عبور">◉</button></div>
    <label class="remember-row terms-row"><input type="checkbox" name="terms" required><span class="custom-check"></span><span>شرایط استفاده و حریم خصوصی رو می‌پذیرم.</span></label>
    <button class="auth-submit" type="submit"><span>ایجاد حساب کاربری</span><span class="submit-arrow">←</span></button>
</form>
<div class="auth-switch">از قبل حساب داری؟ <a href="{{ url('/login') }}">وارد شو <span>←</span></a></div>
@endsection
