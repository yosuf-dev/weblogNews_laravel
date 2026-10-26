document.addEventListener('DOMContentLoaded', () => {
    const refreshIcons = () => { if (window.lucide) lucide.createIcons(); };
    refreshIcons();

    const today = document.getElementById('todayDate');
    if (today) {
        try { today.textContent = new Intl.DateTimeFormat('fa-IR', { weekday: 'long', day: 'numeric', month: 'long' }).format(new Date()); }
        catch (_) { today.textContent = 'امروز'; }
    }

    const sidebar = document.getElementById('sidebar');
    document.getElementById('menuToggle')?.addEventListener('click', () => sidebar?.classList.toggle('open'));
    document.addEventListener('click', e => {
        if (sidebar?.classList.contains('open') && !sidebar.contains(e.target) && !e.target.closest('#menuToggle')) sidebar.classList.remove('open');
    });

    const toastRegion = document.getElementById('toastRegion');
    function toast(message, icon = 'check-circle-2') {
        if (!toastRegion) return;
        const item = document.createElement('div');
        item.className = 'toast';
        const iconEl = document.createElement('i');
        iconEl.setAttribute('data-lucide', icon);
        const text = document.createElement('span');
        text.textContent = message;
        item.append(iconEl, text);
        toastRegion.appendChild(item);
        refreshIcons();
        window.setTimeout(() => { item.classList.add('removing'); window.setTimeout(() => item.remove(), 250); }, 2800);
    }
    document.querySelectorAll('[data-toast]').forEach(btn => btn.addEventListener('click', () => toast(btn.dataset.toast)));
    document.querySelectorAll('.page-number').forEach(btn => btn.addEventListener('click', () => {
        btn.parentElement?.querySelectorAll('.page-number').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        toast('این صفحه‌بندی نمایشی است؛ برای داده‌های واقعی به بک‌اند متصلش کن.', 'info');
    }));
    document.querySelectorAll('.select-all').forEach(master => master.addEventListener('change', () => {
        master.closest('table')?.querySelectorAll('tbody input[type="checkbox"]').forEach(cb => cb.checked = master.checked);
    }));

    const backdrop = document.getElementById('modalBackdrop');
    const modalTitle = document.getElementById('modalTitle');
    const modalFields = document.getElementById('modalFields');
    const form = document.getElementById('itemForm');
    let currentMode = 'user';
    let editingRow = null;

    const userFields = [
        {name:'name',label:'نام و نام خانوادگی',placeholder:'مثلاً سارا محمدی',required:true},
        {name:'email',label:'ایمیل',placeholder:'name@example.com',type:'email',required:true},
        {name:'role',label:'نقش کاربر',type:'select',options:['مدیر','ویرایشگر','کاربر'],required:true},
        {name:'status',label:'وضعیت',type:'select',options:['فعال','غیرفعال'],required:true}
    ];
    const newsFields = [
        {name:'title',label:'عنوان خبر',placeholder:'عنوان جذاب خبر را بنویس...',required:true,full:true},
        {name:'category',label:'دسته‌بندی',placeholder:'مثلاً فناوری',required:true},
        {name:'status',label:'وضعیت انتشار',type:'select',options:['منتشرشده','غیرفعال'],required:true},
        {name:'visibility',label:'قابلیت نمایش',type:'select',options:['عمومی','مخفی'],required:true},
        {name:'description',label:'خلاصه خبر',placeholder:'یک توضیح کوتاه (اختیاری)',type:'textarea',full:true}
    ];
    function fieldMarkup(field, value = '') {
        const id = `field-${field.name}`;
        let control = '';
        if (field.type === 'select') {
            control = `<select id="${id}" name="${field.name}" ${field.required ? 'required' : ''}>${field.options.map(opt => `<option ${String(value) === opt ? 'selected' : ''}>${opt}</option>`).join('')}</select>`;
        } else if (field.type === 'textarea') {
            control = `<textarea id="${id}" name="${field.name}" placeholder="${field.placeholder || ''}">${escapeHTML(value)}</textarea>`;
        } else {
            control = `<input id="${id}" name="${field.name}" type="${field.type || 'text'}" placeholder="${field.placeholder || ''}" value="${escapeHTML(value)}" ${field.required ? 'required' : ''}>`;
        }
        return `<div class="field ${field.full ? 'full' : ''}"><label for="${id}">${field.label}</label>${control}</div>`;
    }
    function escapeHTML(value) {
        return String(value ?? '').replace(/[&<>"']/g, ch => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[ch]));
    }
    function openModal(mode, row = null) {
        currentMode = mode; editingRow = row;
        const fields = mode === 'user' ? userFields : newsFields;
        modalTitle.textContent = row ? (mode === 'user' ? 'ویرایش کاربر' : 'ویرایش خبر') : (mode === 'user' ? 'افزودن کاربر جدید' : 'ایجاد خبر جدید');
        const data = row ? (mode === 'user' ? {
            name: row.dataset.name, email: row.dataset.email, role: row.dataset.role, status: row.dataset.status
        } : {
            title: row.dataset.title, category: row.dataset.category,
            status: row.dataset.status === 'disabled' ? 'غیرفعال' : 'منتشرشده',
            visibility: row.dataset.visibility === 'hidden' ? 'مخفی' : 'عمومی', description: ''
        }) : {};
        modalFields.innerHTML = fields.map(field => fieldMarkup(field, data[field.name] || '')).join('');
        backdrop.hidden = false;
        document.body.style.overflow = 'hidden';
        window.setTimeout(() => modalFields.querySelector('input,select,textarea')?.focus(), 50);
        refreshIcons();
    }
    function closeModal() { if (backdrop) backdrop.hidden = true; document.body.style.overflow = ''; }
    document.querySelectorAll('[data-close-modal]').forEach(btn => btn.addEventListener('click', closeModal));
    backdrop?.addEventListener('click', e => { if (e.target === backdrop) closeModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && backdrop && !backdrop.hidden) closeModal(); });
    document.getElementById('createUser')?.addEventListener('click', () => openModal('user'));
    document.getElementById('createNews')?.addEventListener('click', () => openModal('news'));
    document.querySelectorAll('.edit-user').forEach(btn => btn.addEventListener('click', () => openModal('user', btn.closest('tr'))));
    document.querySelectorAll('.edit-news').forEach(btn => btn.addEventListener('click', () => openModal('news', btn.closest('tr'))));

    function statusMarkup(status) {
        const active = status === 'فعال' || status === 'منتشرشده';
        return `<span class="status-badge ${active ? 'status-active' : 'status-disabled'}"><i></i>${escapeHTML(status)}</span>`;
    }
    function roleMarkup(role) {
        const cls = role === 'مدیر' ? 'role-admin' : role === 'ویرایشگر' ? 'role-editor' : 'role-user';
        return `<span class="role-badge ${cls}">${escapeHTML(role)}</span>`;
    }
    function avatarClass(name) {
        const classes = ['avatar-purple','avatar-blue','avatar-pink','avatar-teal','avatar-amber'];
        return classes[(String(name).charCodeAt(0) || 0) % classes.length];
    }
    function newUserRow(data) {
        const tr = document.createElement('tr');
        tr.dataset.name = data.name; tr.dataset.email = data.email; tr.dataset.role = data.role; tr.dataset.status = data.status;
        tr.innerHTML = `<td><input type="checkbox" aria-label="انتخاب کاربر"></td><td class="id-cell">#NEW</td><td><div class="user-cell"><span class="avatar ${avatarClass(data.name)}">${escapeHTML(data.name.trim().charAt(0))}</span><div><b>${escapeHTML(data.name)}</b><small>${escapeHTML(data.email)}</small></div></div></td><td>${roleMarkup(data.role)}</td><td>${statusMarkup(data.status)}</td><td>امروز</td><td><div class="row-actions"><button class="icon-button edit-user" aria-label="ویرایش کاربر"><i data-lucide="pencil"></i></button><button class="icon-button danger delete-row" aria-label="حذف کاربر"><i data-lucide="trash-2"></i></button></div></td>`;
        return tr;
    }
    function categoryClass(category) {
        if (/طراحی/.test(category)) return 'category-pink';
        if (/هوش|برنامه/.test(category)) return 'category-violet';
        if (/امنیت/.test(category)) return 'category-cyan';
        return 'category-blue';
    }
    function newNewsRow(data) {
        const tr = document.createElement('tr');
        const status = data.status === 'غیرفعال' ? 'disabled' : 'published';
        const visibility = data.visibility === 'مخفی' ? 'hidden' : 'public';
        tr.dataset.title = data.title; tr.dataset.category = data.category; tr.dataset.status = status; tr.dataset.visibility = visibility;
        tr.innerHTML = `<td><input type="checkbox" aria-label="انتخاب خبر"></td><td><div class="news-cell"><span class="news-thumb thumb-two"><i data-lucide="file-text"></i></span><div><b>${escapeHTML(data.title)}</b><small>شناسه #N-NEW · خبر جدید</small></div></div></td><td><span class="category-badge ${categoryClass(data.category)}">${escapeHTML(data.category)}</span></td><td>${statusMarkup(data.status)}</td><td><span class="visibility-badge ${visibility}">${escapeHTML(data.visibility)}</span></td><td>امروز</td><td><div class="row-actions"><button class="icon-button edit-news" aria-label="ویرایش خبر"><i data-lucide="pencil"></i></button><button class="icon-button toggle-visibility" aria-label="تغییر نمایش"><i data-lucide="${visibility === 'hidden' ? 'eye' : 'eye-off'}"></i></button><button class="icon-button danger delete-row" aria-label="حذف خبر"><i data-lucide="trash-2"></i></button></div></td>`;
        if (status === 'disabled') tr.classList.add('is-disabled');
        if (visibility === 'hidden') tr.classList.add('is-hidden');
        return tr;
    }
    form?.addEventListener('submit', e => {
        e.preventDefault();
        const data = Object.fromEntries(new FormData(form).entries());
        if (currentMode === 'user') {
            const table = document.querySelector('#usersTable tbody');
            if (editingRow) {
                editingRow.dataset.name = data.name; editingRow.dataset.email = data.email; editingRow.dataset.role = data.role; editingRow.dataset.status = data.status;
                editingRow.cells[2].querySelector('b').textContent = data.name;
                editingRow.cells[2].querySelector('small').textContent = data.email;
                editingRow.cells[2].querySelector('.avatar').textContent = data.name.trim().charAt(0);
                editingRow.cells[2].querySelector('.avatar').className = `avatar ${avatarClass(data.name)}`;
                editingRow.cells[3].innerHTML = roleMarkup(data.role);
                editingRow.cells[4].innerHTML = statusMarkup(data.status);
                toast('اطلاعات کاربر در همین صفحه به‌روزرسانی شد.');
            } else if (table) {
                table.prepend(newUserRow(data));
                toast('کاربر نمونه ایجاد شد. برای ذخیره دائمی باید API لاراول متصل شود.');
            }
            bindRowActions();
            applyUserFilters();
        } else {
            if (editingRow) {
                editingRow.dataset.title = data.title; editingRow.dataset.category = data.category;
                editingRow.dataset.status = data.status === 'غیرفعال' ? 'disabled' : 'published';
                editingRow.dataset.visibility = data.visibility === 'مخفی' ? 'hidden' : 'public';
                editingRow.cells[1].querySelector('b').textContent = data.title;
                editingRow.cells[2].innerHTML = `<span class="category-badge ${categoryClass(data.category)}">${escapeHTML(data.category)}</span>`;
                editingRow.cells[3].innerHTML = statusMarkup(data.status);
                editingRow.cells[4].innerHTML = `<span class="visibility-badge ${editingRow.dataset.visibility}">${escapeHTML(data.visibility)}</span>`;
                editingRow.classList.toggle('is-disabled', editingRow.dataset.status === 'disabled');
                editingRow.classList.toggle('is-hidden', editingRow.dataset.visibility === 'hidden');
                toast('خبر در همین صفحه به‌روزرسانی شد.');
            } else {
                document.querySelector('#newsTable tbody')?.prepend(newNewsRow(data));
                toast('خبر نمونه ایجاد شد. برای ذخیره دائمی باید API لاراول متصل شود.');
            }
            bindRowActions(); applyNewsFilters(); updateNewsCounts();
        }
        closeModal(); refreshIcons();
    });

    function bindRowActions() {
        document.querySelectorAll('.delete-row').forEach(btn => {
            if (btn.dataset.bound) return;
            btn.dataset.bound = '1';
            btn.addEventListener('click', () => {
                const row = btn.closest('tr');
                const label = row?.dataset.name || row?.dataset.title || 'این مورد';
                if (!row || !window.confirm(`از حذف «${label}» مطمئنی؟`)) return;
                row.remove();
                toast('مورد انتخاب‌شده از فهرست نمایشی حذف شد.', 'trash-2');
                applyUserFilters(); applyNewsFilters(); updateNewsCounts();
            });
        });
        document.querySelectorAll('.edit-user').forEach(btn => {
            if (btn.dataset.bound) return; btn.dataset.bound = '1';
            btn.addEventListener('click', () => openModal('user', btn.closest('tr')));
        });
        document.querySelectorAll('.edit-news').forEach(btn => {
            if (btn.dataset.bound) return; btn.dataset.bound = '1';
            btn.addEventListener('click', () => openModal('news', btn.closest('tr')));
        });
        document.querySelectorAll('.toggle-visibility').forEach(btn => {
            if (btn.dataset.bound) return; btn.dataset.bound = '1';
            btn.addEventListener('click', () => {
                const row = btn.closest('tr');
                if (!row) return;
                const hidden = row.dataset.visibility !== 'hidden';
                row.dataset.visibility = hidden ? 'hidden' : 'public';
                row.cells[4].innerHTML = `<span class="visibility-badge ${hidden ? 'hidden' : 'public'}">${hidden ? 'مخفی' : 'عمومی'}</span>`;
                btn.innerHTML = `<i data-lucide="${hidden ? 'eye' : 'eye-off'}"></i>`;
                btn.setAttribute('aria-label', hidden ? 'نمایش خبر' : 'مخفی کردن خبر');
                row.classList.toggle('is-hidden', hidden);
                toast(hidden ? 'خبر از دید کاربران مخفی شد (نمایشی).' : 'نمایش خبر فعال شد (نمایشی).', hidden ? 'eye-off' : 'eye');
                refreshIcons(); applyNewsFilters(); updateNewsCounts();
            });
        });
    }
    bindRowActions();

    const userSearch = document.getElementById('userSearch');
    const userRoleFilter = document.getElementById('userRoleFilter');
    const userStatusFilter = document.getElementById('userStatusFilter');
    function applyUserFilters() {
        const table = document.getElementById('usersTable'); if (!table) return;
        const q = (userSearch?.value || '').trim().toLocaleLowerCase('fa');
        let shown = 0;
        table.querySelectorAll('tbody tr').forEach(row => {
            const matches = `${row.dataset.name || ''} ${row.dataset.email || ''}`.toLocaleLowerCase('fa').includes(q)
                && (!userRoleFilter?.value || row.dataset.role === userRoleFilter.value)
                && (!userStatusFilter?.value || row.dataset.status === userStatusFilter.value);
            row.hidden = !matches; if (matches) shown++;
        });
        const count = document.getElementById('userResultCount');
        if (count) count.textContent = `نمایش ${shown} کاربر`;
    }
    [userSearch,userRoleFilter,userStatusFilter].forEach(el => el?.addEventListener('input', applyUserFilters));

    let activeNewsFilter = 'all';
    const newsSearch = document.getElementById('newsSearch');
    function applyNewsFilters() {
        const table = document.getElementById('newsTable'); if (!table) return;
        const q = (newsSearch?.value || '').trim().toLocaleLowerCase('fa');
        let shown = 0;
        table.querySelectorAll('tbody tr').forEach(row => {
            const matchesSearch = (row.dataset.title || '').toLocaleLowerCase('fa').includes(q);
            const matchesFilter = activeNewsFilter === 'all'
                || (activeNewsFilter === 'published' && row.dataset.status === 'published')
                || (activeNewsFilter === 'hidden' && row.dataset.visibility === 'hidden')
                || (activeNewsFilter === 'disabled' && row.dataset.status === 'disabled');
            row.hidden = !(matchesSearch && matchesFilter);
            if (!row.hidden) shown++;
        });
        const count = document.getElementById('newsResultCount');
        if (count) count.textContent = `نمایش ${shown} خبر نمونه از ۸۶ خبر`;
    }
    newsSearch?.addEventListener('input', applyNewsFilters);
    document.querySelectorAll('#newsFilters .filter-tab').forEach(btn => btn.addEventListener('click', () => {
        activeNewsFilter = btn.dataset.filter;
        document.querySelectorAll('#newsFilters .filter-tab').forEach(tab => tab.classList.toggle('active', tab === btn));
        applyNewsFilters();
    }));
    function updateNewsCounts() {
        const rows = [...(document.querySelectorAll('#newsTable tbody tr'))];
        const hidden = rows.filter(r => r.dataset.visibility === 'hidden').length;
        const disabled = rows.filter(r => r.dataset.status === 'disabled').length;
        const h = document.getElementById('hiddenCount'), d = document.getElementById('disabledCount'), t = document.getElementById('newsTotal');
        if (h) h.textContent = String(hidden).toLocaleString('fa-IR');
        if (d) d.textContent = String(disabled).toLocaleString('fa-IR');
        if (t) t.textContent = String(rows.length).toLocaleString('fa-IR');
    }
    applyUserFilters(); applyNewsFilters();
});
