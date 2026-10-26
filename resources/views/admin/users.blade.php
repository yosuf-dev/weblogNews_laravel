@extends('admin.layout')
@section('title', 'مدیریت کاربران')
@section('crumb', 'کاربران')
@section('content')
<div class="page-title-row">
    <div><span class="eyebrow"><span class="live-dot"></span> مدیریت دسترسی‌ها</span>
        <h1>کاربران <span class="title-count">۸</span></h1>
        <p class="muted">اعضای فضای کاری را مدیریت کن و سطح دسترسی آن‌ها را تغییر بده.</p>
    </div>
    <form action="{{ url('/admin/users/create') }}"
        method="POST"
        style="display: inline;">
        @csrf
        @method('PUT')

        <button class="button button-primary">
            <i data-lucide="plus"></i>
             افزودن کاربر
        </button>
    </form>
</div>
<div class="toolbar panel"><label class="table-search"><i data-lucide="search"></i><input type="search" id="userSearch" placeholder="جست‌وجو با نام یا ایمیل..."></label>
    <div class="toolbar-end"><select class="filter-select" id="userRoleFilter" aria-label="فیلتر نقش">
            <option value="">همه نقش‌ها</option>
            <option>مدیر</option>
            <option>ویرایشگر</option>
            <option>کاربر</option>
        </select><select class="filter-select" id="userStatusFilter" aria-label="فیلتر وضعیت">
            <option value="">همه وضعیت‌ها</option>
            <option>فعال</option>
            <option>غیرفعال</option>
        </select><button class="icon-button" data-toast="فیلترهای فعلی اعمال شده‌اند." aria-label="فیلترها"><i data-lucide="sliders-horizontal"></i></button></div>
</div>
<div class="panel table-panel">
    <div class="table-scroll">
        <table class="data-table" id="usersTable">
            <thead>
                <tr>
                    <th><input type="checkbox" class="select-all" aria-label="انتخاب همه"></th>
                    <th>شناسه</th>
                    <th>کاربر</th>
                    <th>نقش</th>
                    <th>تاریخ عضویت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dbUsers as $key)
                <tr data-name="یوسف صالح زاده" data-email="yosuf@example.com" data-role="مدیر" data-status="فعال">
                    <td><input type="checkbox" aria-label="انتخاب کاربر"></td>
                    <td class="id-cell">#{{$key->id}}</td>
                    <td>
                        <div class="user-cell"><span class="avatar avatar-purple">{{mb_substr($key->first_name, 0, 1)[0]}}</span>
                            <div><b>{{$key->first_name}} {{$key->last_name}}</b><small>{{$key->email}}</small></div>
                        </div>
                    </td>
                    @if($key->status == "manager")
                    <td><span class="role-badge role-admin">مدیر</span></td>
                    @elseif($key->status == "editor")
                    <td><span class="role-badge role-editor">ویرایشگر</span></td>
                    @else
                    <td><span class="role-badge role-user">کاربر</span></td>
                    @endif
                    <td>{{$key->created_at}}</td>
                    <td>
                        <div class="row-actions">
                            <a href="{{ url('/admin/users/' . $key->id . '/edit') }}"
                                class="icon-button" aria-label="ویرایش کاربر">
                                <i data-lucide="pencil"></i>
                            </a>

                            <form action="{{ url('/admin/users/' . $key->id . '/delete') }}"
                                method="POST"
                                onsubmit="return confirm('از حذف این کاربر مطمئنی؟')"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="icon-button danger" aria-label="حذف کاربر">
                                    <i data-lucide="trash-2"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="table-footer"><span id="userResultCount">نمایش ۸ کاربر</span>
        <div class="pagination"><button class="icon-button" aria-label="صفحه قبل"><i data-lucide="chevron-right"></i></button><button class="page-number active">۱</button><button class="page-number">۲</button><button class="page-number">۳</button><button class="icon-button" aria-label="صفحه بعد"><i data-lucide="chevron-left"></i></button></div>
    </div>
</div>
@endsection