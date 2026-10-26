@extends('admin.layout')
@section('title', 'داشبورد')
@section('crumb', 'داشبورد')
@section('content')
<div class="welcome-row">
    <div><span class="eyebrow"><span class="live-dot"></span> نمای کلی پلتفرم</span>
        <h1>عصر بخیر، یوسف <span class="wave">✦</span></h1>
        <p class="muted">این خلاصه‌ای از اتفاقات مهم فضای کاری توست.</p>
    </div>
    <div class="date-chip"><i data-lucide="calendar-days"></i><span id="todayDate">امروز</span></div>
</div>
<div class="stats-grid">
    <article class="stat-card stat-violet">
        <div class="stat-top"><span class="stat-icon"><i data-lucide="users"></i></span><span class="trend positive"><i data-lucide="trending-up"></i> ۱۲٪</span></div>
        <p>کل کاربران</p>
        <div class="stat-value" data-count="1248">{{ $dbUserCount }}</div><small>در مقایسه با ماه گذشته</small>
        <div class="sparkline spark-violet"><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>
    </article>
    <article class="stat-card stat-blue">
        <div class="stat-top"><span class="stat-icon"><i data-lucide="newspaper"></i></span><span class="trend positive"><i data-lucide="trending-up"></i> ۸٪</span></div>
        <p>کل خبرها</p>
        <div class="stat-value">{{ $dbNewsCount}}</div><small>در مقایسه با ماه گذشته</small>
        <div class="sparkline spark-blue"><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>
    </article>
    <article class="stat-card stat-teal">
        <div class="stat-top"><span class="stat-icon"><i data-lucide="check-circle-2"></i></span><span class="trend positive"><i data-lucide="trending-up"></i> ۶٪</span></div>
        <p>خبرهای فعال</p>
        <div class="stat-value">{{$dbNewsStatusVisable}}</div><small>منتشر شده و قابل مشاهده</small>
        <div class="sparkline spark-teal"><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>
    </article>
    <article class="stat-card stat-rose">
        <div class="stat-top"><span class="stat-icon"><i data-lucide="eye-off"></i></span><span class="trend negative"><i data-lucide="trending-down"></i> ۳٪</span></div>
        <p>خبرهای غیرفعال</p>
        <div class="stat-value">{{$dbNewsStatusDisable}}</div><small>نیازمند بررسی بیشتر</small>
        <div class="sparkline spark-rose"><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>
    </article>
</div>
<div class="dashboard-grid">
    <article class="panel activity-panel">
        <div class="panel-heading">
            <div>
                <h2>فعالیت پلتفرم</h2>
                <p class="muted">نمایی از رشد کاربران و خبرها در هفت روز گذشته</p>
            </div><button class="select-chip" id="chartRange">۷ روز اخیر <i data-lucide="chevron-down"></i></button>
        </div>
        <div class="chart-legend"><span><i class="legend-dot violet"></i> کاربران جدید</span><span><i class="legend-dot teal"></i> خبرهای جدید</span></div>
        <div class="chart-wrap">
            <div class="chart-y-labels"><span>۱۲۰</span><span>۹۰</span><span>۶۰</span><span>۳۰</span><span>۰</span></div>
            <svg class="activity-chart" viewBox="0 0 700 220" role="img" aria-label="نمودار فعالیت هفت روز گذشته">
                <defs>
                    <linearGradient id="violetFill" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0" stop-color="#8275ff" stop-opacity=".24" />
                        <stop offset="1" stop-color="#8275ff" stop-opacity="0" />
                    </linearGradient>
                    <linearGradient id="tealFill" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0" stop-color="#27d6c4" stop-opacity=".16" />
                        <stop offset="1" stop-color="#27d6c4" stop-opacity="0" />
                    </linearGradient>
                </defs>
                <g class="chart-grid">
                    <path d="M0 20H700 M0 62H700 M0 104H700 M0 146H700 M0 188H700" />
                    <path d="M0 20V188 M116 20V188 M233 20V188 M350 20V188 M466 20V188 M583 20V188 M700 20V188" />
                </g>
                <path class="area-violet" d="M0 135 C45 122 65 72 116 80 S190 120 233 105 S300 67 350 74 S420 90 466 69 S540 25 583 40 S650 76 700 55 L700 188 L0 188Z" />
                <path class="line-violet" d="M0 135 C45 122 65 72 116 80 S190 120 233 105 S300 67 350 74 S420 90 466 69 S540 25 583 40 S650 76 700 55" />
                <path class="area-teal" d="M0 176 C55 167 70 142 116 148 S190 172 233 160 S300 142 350 151 S420 177 466 158 S540 126 583 137 S650 158 700 146 L700 188 L0 188Z" />
                <path class="line-teal" d="M0 176 C55 167 70 142 116 148 S190 172 233 160 S300 142 350 151 S420 177 466 158 S540 126 583 137 S650 158 700 146" />
                <g class="chart-points violet-points">
                    <circle cx="0" cy="135" r="4" />
                    <circle cx="116" cy="80" r="4" />
                    <circle cx="233" cy="105" r="4" />
                    <circle cx="350" cy="74" r="4" />
                    <circle cx="466" cy="69" r="4" />
                    <circle cx="583" cy="40" r="4" />
                    <circle cx="700" cy="55" r="4" />
                </g>
                <g class="chart-points teal-points">
                    <circle cx="0" cy="176" r="3.5" />
                    <circle cx="116" cy="148" r="3.5" />
                    <circle cx="233" cy="160" r="3.5" />
                    <circle cx="350" cy="151" r="3.5" />
                    <circle cx="466" cy="158" r="3.5" />
                    <circle cx="583" cy="137" r="3.5" />
                    <circle cx="700" cy="146" r="3.5" />
                </g>
            </svg>
            <div class="chart-x-labels"><span>۱۴ مهر</span><span>۱۵ مهر</span><span>۱۶ مهر</span><span>۱۷ مهر</span><span>۱۸ مهر</span><span>۱۹ مهر</span><span>۲۰ مهر</span></div>
        </div>
    </article>
    <article class="panel recent-panel">
        <div class="panel-heading">
            <div>
                <h2>فعالیت‌های اخیر</h2>
                <p class="muted">آخرین تغییرات پنل</p>
            </div><button class="text-button" data-toast="همه فعالیت‌ها در نسخه بک‌اند نمایش داده می‌شوند.">مشاهده همه <i data-lucide="arrow-left"></i></button>
        </div>
        <div class="activity-list">
            <div class="activity-item"><span class="activity-icon violet-bg"><i data-lucide="user-plus"></i></span>
                <div><b>کاربر جدید ثبت شد</b><small>علی رضایی</small></div><time>۲ ساعت پیش</time>
            </div>
            <div class="activity-item"><span class="activity-icon blue-bg"><i data-lucide="file-plus-2"></i></span>
                <div><b>خبر جدید ایجاد شد</b><small>ترندهای فناوری ۲۰۲۶</small></div><time>۴ ساعت پیش</time>
            </div>
            <div class="activity-item"><span class="activity-icon teal-bg"><i data-lucide="user-round-pen"></i></span>
                <div><b>اطلاعات کاربر ویرایش شد</b><small>سارا محمدی</small></div><time>۵ ساعت پیش</time>
            </div>
            <div class="activity-item"><span class="activity-icon rose-bg"><i data-lucide="eye-off"></i></span>
                <div><b>خبر غیرفعال شد</b><small>اطلاعیه قدیمی</small></div><time>۶ ساعت پیش</time>
            </div>
            <div class="activity-item"><span class="activity-icon violet-bg"><i data-lucide="user-plus"></i></span>
                <div><b>کاربر جدید ثبت شد</b><small>مهرداد احمدی</small></div><time>۸ ساعت پیش</time>
            </div>
        </div>
    </article>
    <article class="feature-card">
        <div class="feature-glow"></div>
        <div class="feature-content"><span class="feature-tag"><i data-lucide="sparkles"></i> فضای بهتر، کار بهتر</span>
            <h2>مدیریت حرفه‌ای،<br>با تمرکز روی جزئیات.</h2>
            <p>ابزارهای ساده برای تصمیم‌های بهتر و سریع‌تر.</p><a href="{{ url('/admin/news') }}" class="feature-link">مدیریت محتوا <i data-lucide="arrow-left"></i></a>
        </div>
        <div class="feature-orbit orbit-one"></div>
        <div class="feature-orbit orbit-two"></div>
    </article>
</div>
@endsection