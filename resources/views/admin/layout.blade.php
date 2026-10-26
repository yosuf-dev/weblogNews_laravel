<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'داشبورد') | AVENIQ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <div class="app-shell">
        <aside class="sidebar" id="sidebar">
            <a class="brand" href="{{ url('/admin') }}">
                <span class="brand-mark"><i data-lucide="orbit"></i></span>
                <span><b>AVENIQ</b><small>پنل مدیریت</small></span>
            </a>
            <div class="side-label">فضای کاری</div>
            <nav class="nav-menu">
                <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ url('/admin') }}"><i data-lucide="layout-dashboard"></i><span>داشبورد</span></a>
                <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ url('/admin/users') }}"><i data-lucide="users"></i><span>مدیریت کاربران</span><span class="nav-count">8</span></a>
                <a class="nav-link {{ request()->is('admin/news*') ? 'active' : '' }}" href="{{ url('/admin/news') }}"><i data-lucide="newspaper"></i><span>مدیریت خبرها</span></a>
            </nav>
            <div class="sidebar-bottom">
                <div class="help-card"><span class="help-icon"><i data-lucide="sparkles"></i></span><b>همه‌چیز مرتب است؟</b>
                    <p>وضعیت محتوای امروزت را بررسی کن.</p><a href="{{ url('/admin/news') }}">بررسی خبرها <i data-lucide="arrow-left"></i></a>
                </div>
                <div class="profile-row">
                    <div class="avatar avatar-me">ی</div>
                    <div class="profile-info"><b>یوسف صالح‌زاده</b><small>مدیر سیستم</small></div><button class="icon-button" aria-label="تنظیمات"><i data-lucide="settings-2"></i></button>
                </div>
            </div>
        </aside>
        <main class="main-area">
            <header class="topbar">
                <button class="icon-button mobile-menu" id="menuToggle" aria-label="باز کردن منو"><i data-lucide="menu"></i></button>
                <div class="breadcrumbs"><span>فضای کاری</span><i data-lucide="chevron-left"></i><b>@yield('crumb', 'داشبورد')</b></div>
                <div class="top-actions">
                    <label class="global-search"><i data-lucide="search"></i><input type="search" placeholder="جست‌وجو در پنل..." aria-label="جست‌وجوی کلی"></label>
                    <button class="icon-button notification-button" aria-label="اعلان‌ها"><i data-lucide="bell"></i><span></span></button>
                    <div class="avatar avatar-me">ی</div>
                </div>
            </header>
            <section class="page-content">
                @yield('content')
                <footer class="footer"><span>© 2026 AVENIQ</span><span>طراحی شده برای مدیریت ساده‌تر <i data-lucide="heart"></i></span></footer>
            </section>
        </main>
    </div>
    <div class="toast-region" id="toastRegion" aria-live="polite"></div>
    <div class="modal-backdrop" id="modalBackdrop" hidden>
        <section class="modal-card" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
            <div class="modal-head">
                <div><span class="eyebrow">AVENIQ STUDIO</span>
                    <h2 id="modalTitle">افزودن کاربر جدید</h2>
                </div><button class="icon-button" data-close-modal="" aria-label="بستن"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="x" aria-hidden="true" class="lucide lucide-x">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg></button>
            </div>
            <form id="itemForm">
                <div id="modalFields" class="form-grid">
                    <div class="field "><label for="field-name">نام و نام خانوادگی</label><input id="field-name" name="name" type="text" placeholder="مثلاً سارا محمدی" value="" required=""></div>
                    <div class="field "><label for="field-email">ایمیل</label><input id="field-email" name="email" type="email" placeholder="name@example.com" value="" required=""></div>
                    <div class="field "><label for="field-role">نقش کاربر</label><select id="field-role" name="role" required="">
                            <option value="manager">مدیر</option>
                            <option value="editor">ویرایشگر</option>
                            <option value="user">کاربر</option>
                        </select></div>
                                    <div class="modal-actions"><button type="button" class="button button-ghost" data-close-modal="">انصراف</button><button type="submit" class="button button-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="check" aria-hidden="true" class="lucide lucide-check">
                            <path d="M20 6 9 17l-5-5"></path>
                        </svg> ذخیره تغییرات</button></div>
            </form>
        </section>
    </div>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts')
</body>

</html>