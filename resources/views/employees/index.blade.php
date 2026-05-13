@extends('layouts.app')
@section('title','الموظفين')

@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-bold text-slate-800">إدارة الموظفين</h1>
        <p class="text-sm text-slate-500 mt-0.5">إدارة بيانات موظفي المكتب وصلاحياتهم</p>
    </div>
    <button onclick="openModal('addEmployeeModal')"
            class="flex items-center gap-2 px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-xl transition-colors shadow-sm shadow-amber-500/30">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        إضافة موظف جديد
    </button>
</div>

{{-- Filters --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-5">
    <div class="flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-48">
            <svg class="w-4 h-4 text-slate-400 absolute top-2.5 right-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="search" placeholder="البحث بالاسم أو البريد..."
                   class="w-full pr-9 pl-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
        </div>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">جميع الأدوار</option>
            <option>مدير المكتب</option>
            <option>محامي</option>
            <option>موظف إداري</option>
            <option>محاسب</option>
            <option>موظف إنجاز</option>
        </select>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">جميع الحالات</option>
            <option>نشط</option>
            <option>معطّل</option>
        </select>
        <button class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 hover:bg-slate-100 transition-colors flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
            فلترة
        </button>
    </div>
</div>

{{-- Table --}}
@php
$employees = [
    ['عبدالله الرويسي',   '0501234567', 'admin@alruwaysi.sa',   'مدير المكتب',    'مدير',      'نشط',   'ع'],
    ['سارة الحربي',       '0551234567', 'sara@alruwaysi.sa',    'محامية أولى',    'محامي',     'نشط',   'س'],
    ['محمد الغامدي',      '0561234567', 'mghamdi@alruwaysi.sa', 'محامي',          'محامي',     'نشط',   'م'],
    ['نورة الزهراني',     '0571234567', 'nora@alruwaysi.sa',    'مدير إداري',     'إداري',     'نشط',   'ن'],
    ['فيصل العنزي',       '0581234567', 'faisal@alruwaysi.sa',  'محاسب',          'محاسب',     'نشط',   'ف'],
    ['ريم السلمي',        '0591234567', 'reem@alruwaysi.sa',    'موظفة إنجاز',    'إنجاز',     'نشط',   'ر'],
    ['خالد المطيري',      '0501111222', 'khalid@alruwaysi.sa',  'محامي',          'محامي',     'معطّل', 'خ'],
    ['هند القحطاني',      '0502222333', 'hind@alruwaysi.sa',    'موظفة إدارية',   'إداري',     'نشط',   'ه'],
];
$roleColors = ['مدير'=>'purple','محامي'=>'blue','إداري'=>'slate','محاسب'=>'green','إنجاز'=>'amber'];
@endphp

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
        <span class="text-sm text-slate-500 font-medium">{{ count($employees) }} موظف</span>
        <button class="flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            تصدير
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">الموظف</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">رقم الجوال</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">البريد الإلكتروني</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">المسمى الوظيفي</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">الصلاحية</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">الحالة</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($employees as [$name,$phone,$email,$title,$role,$status,$initials])
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-amber-500 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">{{ $initials }}</div>
                            <span class="font-medium text-slate-800 text-sm">{{ $name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-4 text-sm text-slate-600 font-mono">{{ $phone }}</td>
                    <td class="px-5 py-4 text-sm text-slate-500">{{ $email }}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">{{ $title }}</td>
                    <td class="px-5 py-4">
                        @php $rc = $roleColors[$role] ?? 'slate'; @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $rc }}-100 text-{{ $rc }}-700">{{ $role }}</span>
                    </td>
                    <td class="px-5 py-4">
                        @if($status==='نشط')
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>{{ $status }}
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>{{ $status }}
                        </span>
                        @endif
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-1">
                            <button class="p-1.5 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="عرض">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                            <button onclick="openModal('editEmployeeModal')" class="p-1.5 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="تعديل">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                            <button class="p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors" title="تعطيل">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                            </button>
                            <button class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="حذف">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- Pagination --}}
    <div class="flex items-center justify-between px-5 py-4 border-t border-slate-100">
        <span class="text-xs text-slate-400">عرض 1–8 من 8 نتائج</span>
        <div class="flex items-center gap-1">
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-400 text-sm hover:bg-slate-50 flex items-center justify-center">‹</button>
            <button class="w-8 h-8 rounded-lg bg-amber-500 text-white text-sm font-medium flex items-center justify-center">1</button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-400 text-sm hover:bg-slate-50 flex items-center justify-center">›</button>
        </div>
    </div>
</div>

{{-- ═══════ ADD EMPLOYEE MODAL ═══════ --}}
<div id="addEmployeeModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('addEmployeeModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">إضافة موظف جديد</h2>
            <button onclick="closeModal('addEmployeeModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الاسم الكامل <span class="text-red-400">*</span></label>
                    <input type="text" placeholder="أدخل الاسم الكامل" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">رقم الجوال <span class="text-red-400">*</span></label>
                    <input type="tel" placeholder="05XXXXXXXX" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">البريد الإلكتروني <span class="text-red-400">*</span></label>
                    <input type="email" placeholder="example@alruwaysi.sa" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">المسمى الوظيفي</label>
                    <input type="text" placeholder="المسمى الوظيفي" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الصلاحية <span class="text-red-400">*</span></label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option value="">اختر الصلاحية</option>
                        <option>مدير المكتب</option>
                        <option>محامي</option>
                        <option>موظف إداري</option>
                        <option>محاسب</option>
                        <option>موظف إنجاز</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الحالة</label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option>نشط</option>
                        <option>معطّل</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">كلمة المرور <span class="text-red-400">*</span></label>
                    <input type="password" placeholder="كلمة مرور قوية" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 focus:bg-white transition-all">
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('addEmployeeModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100 transition-colors">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-colors font-medium shadow-sm shadow-amber-500/30">حفظ الموظف</button>
        </div>
    </div>
</div>

{{-- Edit modal (same structure, reused) --}}
<div id="editEmployeeModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('editEmployeeModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">تعديل بيانات الموظف</h2>
            <button onclick="closeModal('editEmployeeModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الاسم الكامل</label>
                    <input type="text" value="سارة الحربي" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">رقم الجوال</label>
                    <input type="tel" value="0551234567" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">البريد الإلكتروني</label>
                    <input type="email" value="sara@alruwaysi.sa" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الصلاحية</label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                        <option>محامي</option>
                        <option>مدير المكتب</option>
                        <option>موظف إداري</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('editEmployeeModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100 transition-colors">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-colors font-medium">حفظ التعديلات</button>
        </div>
    </div>
</div>

@endsection
