@extends('admin.layout')

@section('title', 'ویرایش کاربر')
@section('crumb', 'ویرایش کاربر')

@section('content')
<div class="page-title-row">
    <div>
        <h1>ویرایش کاربر</h1>
        <p class="muted">اطلاعات کاربر را ویرایش کن.</p>
    </div>
</div>

<div class="panel" style="padding: 24px;">
    <form action="{{ url('/admin/users/' . $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <label>
                نام
                <input name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
            </label>

            <label>
                نام خانوادگی
                <input name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
            </label>

            <label>
                ایمیل
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
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