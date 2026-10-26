<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ورود | AVENIQ')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="auth-body">
    <main class="auth-shell">
        <section class="auth-visual" aria-label="معرفی AVENIQ">
            <a href="{{ url('/admin') }}" class="auth-brand"><span class="brand-mark">A</span><span>AVENIQ</span></a>
            <div class="visual-content">
                <span class="eyebrow"><span class="eyebrow-dot"></span> فضای مدیریت شما</span>
                <h1>همه‌چیز،<br><span>در جای خودش.</span></h1>
                <p>یک فضای ساده و متمرکز برای مدیریت کاربران، محتوا و جریان کار روزانه‌ات.</p>
                <div class="visual-orbit orbit-one"></div><div class="visual-orbit orbit-two"></div>
                <div class="floating-card"><span class="float-icon">✦</span><div><strong>تمرکز روی کار مهم</strong><small>مدیریت، بدون شلوغی</small></div><span class="float-status"></span></div>
            </div>
            <div class="visual-footer"><span>طراحی‌شده برای تمرکز</span><span>© AVENIQ</span></div>
        </section>
        <section class="auth-panel">
            <div class="mobile-brand"><span class="brand-mark">A</span><span>AVENIQ</span></div>
            <div class="auth-card">
                @yield('content')
                <p class="auth-legal">با ادامه‌دادن، با <a href="#">شرایط استفاده</a> و <a href="#">حریم خصوصی</a> موافقت می‌کنی.</p>
            </div>
            <span class="panel-glow"></span>
        </section>
    </main>
    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
