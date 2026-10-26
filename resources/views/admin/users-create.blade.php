@extends('admin.layout')

@section('title', 'ویرایش کاربر')
@section('crumb', 'ویرایش کاربر')

@section('content')
<div class="page-title-row">
    <div>
        <h1>ساخت کاربر</h1>
        <p class="muted">یه حساب جدید بسازید.</p>
    </div>
</div>

<div class="panel" style="padding: 24px;">
    <form action="{{ url('/admin/users/create/true') }}" method="POST">
        @csrf
        @method('put')

        <div class="form-grid">
            <label>
                نام
                <input name="first_name" required>
            </label>

            <label>
                نام خانوادگی
                <input name="last_name" required>
            </label>

            <label>
                ایمیل
                <input type="email" name="email" required>
            </label>
            <label>
                نقش
                <select name="status">
                    <option value="manager">مدیر</option>
                    <option value="editor">ویرایشگر</option>
                    <option value="user">کاربر</option>
                </select>
            </label>
        </div>

        @if ($errors->any())
        <div class="muted">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <div style="margin-top: 24px; display: flex; gap: 12px;">
            <button type="submit" class="button button-primary">ذخیره تغییرات</button>
            <a href="{{ url('/admin/users') }}" class="button button-ghost">بازگشت</a>
        </div>
    </form>
</div>
@endsection