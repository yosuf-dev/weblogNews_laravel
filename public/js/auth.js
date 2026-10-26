document.addEventListener('click', function (event) {
  const toggle = event.target.closest('[data-toggle-password]');
  if (toggle) {
    const input = document.getElementById(toggle.dataset.togglePassword);
    if (input) {
      input.type = input.type === 'password' ? 'text' : 'password';
      toggle.setAttribute('aria-label', input.type === 'password' ? 'نمایش رمز عبور' : 'پنهان کردن رمز عبور');
    }
  }
  const demo = event.target.closest('[data-demo-notice]');
  if (demo) alert('ورود با Google در این قالب نمایشی است و هنوز پیاده‌سازی نشده است.');
});
