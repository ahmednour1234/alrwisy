@extends('layouts.app')
@section('title','الإعدادات')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-bold text-slate-800">إعدادات المكتب</h1>
        <p class="text-sm text-slate-500 mt-0.5">إدارة بيانات المكتب والمستخدمين والتخصيصات</p>
    </div>
</div>

<div class="flex gap-6">
    {{-- Sidebar tabs --}}
    <div class="w-56 shrink-0">
        <nav class="bg-white rounded-2xl border border-slate-100 shadow-sm p-2 space-y-0.5">
            @foreach([
                ['office','بيانات المكتب','M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                ['users','المستخدمون والصلاحيات','M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                ['casetypes','أنواع القضايا','M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['services','أنواع الخدمات الحكومية','M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9'],
                ['notifications','إعدادات الإشعارات','M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9'],
            ] as [$id,$label,$icon])
            <button onclick="switchSettingsTab('{{ $id }}')"
                id="stab-{{ $id }}"
                class="settings-tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-right transition-colors {{ $id==='office'?'bg-amber-50 text-amber-700 font-medium':'text-slate-600 hover:bg-slate-50' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/></svg>
                <span>{{ $label }}</span>
            </button>
            @endforeach
        </nav>
    </div>

    {{-- Content panels --}}
    <div class="flex-1 min-w-0">

        {{-- Office info --}}
        <div id="spanel-office" class="settings-panel">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h2 class="text-base font-bold text-slate-800">بيانات المكتب</h2>
                </div>
                <div class="p-6">
                    {{-- Logo upload --}}
                    <div class="flex items-center gap-6 mb-8 pb-8 border-b border-slate-100">
                        <div class="w-20 h-20 rounded-2xl bg-slate-900 flex items-center justify-center shrink-0">
                            <span class="text-amber-400 font-bold text-xl" style="font-family: serif;">م</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-700 mb-1">شعار المكتب</p>
                            <p class="text-xs text-slate-400 mb-3">PNG أو SVG — موصى به 256×256 بكسل</p>
                            <div class="flex items-center gap-3">
                                <button class="px-4 py-2 text-sm border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 transition-colors">تغيير الشعار</button>
                                <button class="px-4 py-2 text-sm text-red-400 hover:text-red-500 transition-colors">حذف</button>
                            </div>
                        </div>
                    </div>
                    {{-- Form --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">اسم المكتب بالعربية <span class="text-red-400">*</span></label>
                            <input type="text" value="مكتب الرويسي للمحاماة والاستشارات القانونية" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">اسم المكتب بالإنجليزية</label>
                            <input type="text" value="Al-Ruwaysi Law Firm" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">رقم الترخيص</label>
                            <input type="text" value="LAW-2018-001247" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">رقم الجوال</label>
                            <input type="tel" value="+966 55 123 4567" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50" dir="ltr">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">البريد الإلكتروني</label>
                            <input type="email" value="info@alruwaysi-law.sa" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50" dir="ltr">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">المدينة</label>
                            <input type="text" value="الرياض" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">الموقع الإلكتروني</label>
                            <input type="url" value="https://alruwaysi-law.sa" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50" dir="ltr">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">العنوان التفصيلي</label>
                            <textarea rows="2" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 resize-none">طريق الملك فهد، برج المملكة، الدور 18، الرياض 12214</textarea>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-xl shadow-sm shadow-amber-500/30 transition-colors">حفظ التغييرات</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Users & roles --}}
        <div id="spanel-users" class="settings-panel hidden">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                    <h2 class="text-base font-bold text-slate-800">المستخدمون والصلاحيات</h2>
                    <button class="flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm rounded-xl font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        إضافة مستخدم
                    </button>
                </div>
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">المستخدم</th>
                            <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">البريد</th>
                            <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">الصلاحية</th>
                            <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">الحالة</th>
                            <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach([
                            ['عبدالله الرويسي','admin@alruwaysi-law.sa','مدير النظام','active'],
                            ['سارة الحربي','sara@alruwaysi-law.sa','محامية','active'],
                            ['محمد الغامدي','m.ghamdi@alruwaysi-law.sa','محامي','active'],
                            ['ريم السلمي','reem@alruwaysi-law.sa','موظف إداري','active'],
                            ['نورة الزهراني','noura@alruwaysi-law.sa','موظف إداري','inactive'],
                        ] as [$name,$email,$role,$status])
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">
                                        {{ mb_substr($name,0,1) }}
                                    </div>
                                    <span class="text-sm font-medium text-slate-700">{{ $name }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-xs text-slate-400" dir="ltr">{{ $email }}</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $role==='مدير النظام'?'bg-amber-100 text-amber-700':'bg-slate-100 text-slate-600' }}">{{ $role }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $status==='active'?'bg-green-400':'bg-slate-300' }}"></span>
                                    <span class="text-xs text-slate-500">{{ $status==='active'?'نشط':'غير نشط' }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-1">
                                    <button class="p-1.5 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Case types --}}
        <div id="spanel-casetypes" class="settings-panel hidden">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                    <h2 class="text-base font-bold text-slate-800">أنواع القضايا</h2>
                    <button onclick="openModal('addCaseTypeModal')" class="flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm rounded-xl font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        إضافة نوع
                    </button>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach(['تجاري','عمالي','أحوال شخصية','عقاري','جنائي','إداري','مدني','فكري','تحكيم','استشاري'] as $type)
                        <div class="flex items-center justify-between px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 hover:border-amber-300 transition-colors group">
                            <span class="text-sm text-slate-700">{{ $type }}</span>
                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1 text-slate-400 hover:text-amber-500 rounded"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                <button class="p-1 text-slate-400 hover:text-red-500 rounded"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Service types --}}
        <div id="spanel-services" class="settings-panel hidden">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                    <h2 class="text-base font-bold text-slate-800">أنواع الخدمات الحكومية</h2>
                    <button class="flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm rounded-xl font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        إضافة خدمة
                    </button>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach(['تأشيرات','تفويض','تصديق','طلب زيارة','خدمات مقيم','خدمات وزارة العدل','خدمات ناجز','خدمات قوى','خدمات أبشر أعمال'] as $svc)
                        <div class="flex items-center justify-between px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 hover:border-amber-300 transition-colors group">
                            <span class="text-sm text-slate-700">{{ $svc }}</span>
                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1 text-slate-400 hover:text-amber-500 rounded"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                <button class="p-1 text-slate-400 hover:text-red-500 rounded"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Notifications --}}
        <div id="spanel-notifications" class="settings-panel hidden">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h2 class="text-base font-bold text-slate-800">إعدادات الإشعارات</h2>
                </div>
                <div class="p-6 space-y-6">
                    @foreach([
                        ['الجلسات القادمة','تلقّي إشعار عند اقتراب موعد جلسة'],
                        ['المهام المتأخرة','تنبيه عند تجاوز موعد انتهاء مهمة'],
                        ['معاملات إنجاز','إشعار عند تحديث حالة معاملة'],
                        ['عملاء جدد','تنبيه عند إضافة عميل جديد'],
                        ['القضايا المستحقة','تذكير بالقضايا التي اقتربت مواعيدها'],
                    ] as [$label,$desc])
                    <div class="flex items-center justify-between py-4 border-b border-slate-50 last:border-0">
                        <div>
                            <p class="text-sm font-medium text-slate-700">{{ $label }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $desc }}</p>
                        </div>
                        <button onclick="this.classList.toggle('bg-amber-500');this.classList.toggle('bg-slate-200');this.querySelector('span').classList.toggle('translate-x-5');this.querySelector('span').classList.toggle('-translate-x-0')"
                            class="relative inline-flex w-11 h-6 rounded-full transition-colors duration-200 bg-amber-500 focus:outline-none shrink-0">
                            <span class="inline-block w-5 h-5 bg-white rounded-full shadow transform transition-transform duration-200 translate-x-5 mt-0.5"></span>
                        </button>
                    </div>
                    @endforeach
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">التذكير المسبق بالجلسات</label>
                        <select class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
                            <option>قبل يوم كامل</option><option>قبل ساعتين</option><option>قبل ساعة</option><option>قبل 30 دقيقة</option>
                        </select>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-xl shadow-sm shadow-amber-500/30 transition-colors">حفظ التغييرات</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Add Case Type Modal --}}
<div id="addCaseTypeModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('addCaseTypeModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">إضافة نوع قضية</h2>
            <button onclick="closeModal('addCaseTypeModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6">
            <label class="block text-sm font-medium text-slate-700 mb-1.5">اسم النوع <span class="text-red-400">*</span></label>
            <input type="text" placeholder="مثال: بيئي" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
        </div>
        <div class="flex justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('addCaseTypeModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl font-medium">إضافة</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function switchSettingsTab(id) {
    document.querySelectorAll('.settings-panel').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.settings-tab-btn').forEach(b => {
        b.classList.remove('bg-amber-50','text-amber-700','font-medium');
        b.classList.add('text-slate-600','hover:bg-slate-50');
    });
    document.getElementById('spanel-'+id).classList.remove('hidden');
    const activeBtn = document.getElementById('stab-'+id);
    activeBtn.classList.add('bg-amber-50','text-amber-700','font-medium');
    activeBtn.classList.remove('text-slate-600','hover:bg-slate-50');
}
</script>
@endpush
