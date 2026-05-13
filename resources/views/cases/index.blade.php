@extends('layouts.app')
@section('title','القضايا')

@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-bold text-slate-800">إدارة القضايا</h1>
        <p class="text-sm text-slate-500 mt-0.5">متابعة جميع القضايا القانونية للمكتب</p>
    </div>
    <button onclick="openModal('addCaseModal')"
            class="flex items-center gap-2 px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-xl transition-colors shadow-sm shadow-amber-500/30">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        إضافة قضية جديدة
    </button>
</div>

{{-- Status strip --}}
@php
$statusStrip = [
    ['جديدة','12','blue'],['تحت الدراسة','8','slate'],['قيد التنفيذ','15','amber'],
    ['بانتظار جلسة','8','purple'],['مغلقة','84','green'],['مؤرشفة','0','gray'],
];
@endphp
<div class="grid grid-cols-3 md:grid-cols-6 gap-3 mb-5">
    @foreach($statusStrip as [$label,$count,$color])
    <div class="bg-white rounded-xl p-3 border border-slate-100 shadow-sm text-center cursor-pointer hover:border-{{ $color }}-300 transition-colors">
        <div class="text-xl font-bold text-slate-800">{{ $count }}</div>
        <div class="text-xs text-slate-500 mt-0.5">{{ $label }}</div>
    </div>
    @endforeach
</div>

{{-- Filters --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-5">
    <div class="flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-48">
            <svg class="w-4 h-4 text-slate-400 absolute top-2.5 right-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="search" placeholder="البحث برقم القضية أو اسم العميل..."
                   class="w-full pr-9 pl-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
        </div>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">نوع القضية</option>
            <option>تجارية</option><option>عمالية</option><option>جنائية</option>
            <option>أحوال شخصية</option><option>إدارية</option><option>عقارية</option>
        </select>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">حالة القضية</option>
            <option>جديدة</option><option>تحت الدراسة</option><option>قيد التنفيذ</option>
            <option>بانتظار جلسة</option><option>مغلقة</option><option>مؤرشفة</option>
        </select>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">المحامي المسؤول</option>
            <option>عبدالله الرويسي</option><option>سارة الحربي</option><option>محمد الغامدي</option>
        </select>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">المدينة</option>
            <option>الرياض</option><option>جدة</option><option>الدمام</option>
        </select>
    </div>
</div>

{{-- Table --}}
@php
$cases = [
    ['2024/1234','نزاع عقد توريد','شركة البنيان','تجارية','المحكمة التجارية','الرياض','عبدالله الرويسي','01/03/2024','قيد التنفيذ','amber'],
    ['2024/5678','مطالبة بعلاوة عمالية','أحمد العتيبي','عمالية','المحكمة العمالية','الرياض','محمد الغامدي','15/03/2024','بانتظار جلسة','purple'],
    ['2024/9012','طلاق وحضانة','فاطمة الزهراني','أحوال شخصية','محكمة الأحوال الشخصية','جدة','سارة الحربي','20/03/2024','تحت الدراسة','slate'],
    ['2024/3456','طعن في قرار إداري','خالد الشمري','إدارية','ديوان المظالم','الرياض','عبدالله الرويسي','05/04/2024','جديدة','blue'],
    ['2024/7890','نزاع عقاري','شركة النخيل','عقارية','المحكمة التجارية','الدمام','سارة الحربي','10/04/2024','مغلقة','green'],
    ['2024/2345','تسوية تجارية','مجموعة الفارس','تجارية','المحكمة التجارية','الرياض','محمد الغامدي','12/04/2024','قيد التنفيذ','amber'],
    ['2024/6789','جريمة احتيال','عمر القحطاني','جنائية','المحكمة الجزائية','جدة','عبدالله الرويسي','18/04/2024','بانتظار جلسة','purple'],
    ['2024/0123','فسخ عقد إيجار','هند القحطاني','عقارية','المحكمة العامة','الرياض','سارة الحربي','22/04/2024','جديدة','blue'],
];
$statusColors = ['قيد التنفيذ'=>'amber','بانتظار جلسة'=>'purple','تحت الدراسة'=>'slate','جديدة'=>'blue','مغلقة'=>'green','مؤرشفة'=>'gray'];
$typeColors   = ['تجارية'=>'blue','عمالية'=>'orange','جنائية'=>'red','أحوال شخصية'=>'pink','إدارية'=>'indigo','عقارية'=>'teal'];
@endphp

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
        <span class="text-sm text-slate-500 font-medium">127 قضية</span>
        <div class="flex items-center gap-2">
            <button class="flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-700 transition-colors px-3 py-1.5 rounded-lg border border-slate-200 hover:bg-slate-50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                تصدير
            </button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">رقم القضية</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">اسم القضية</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">العميل</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">النوع</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">المحكمة</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">المدينة</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">المحامي</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">تاريخ البداية</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">الحالة</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($cases as [$num,$name,$client,$type,$court,$city,$lawyer,$date,$status,$color])
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-4 text-xs font-mono text-slate-500">{{ $num }}</td>
                    <td class="px-4 py-4">
                        <a href="/cases/1" class="font-medium text-slate-800 text-sm hover:text-amber-600 transition-colors">{{ $name }}</a>
                    </td>
                    <td class="px-4 py-4 text-sm text-slate-600">{{ $client }}</td>
                    <td class="px-4 py-4">
                        <span class="text-xs text-slate-600 bg-slate-100 px-2 py-0.5 rounded-full">{{ $type }}</span>
                    </td>
                    <td class="px-4 py-4 text-xs text-slate-500">{{ $court }}</td>
                    <td class="px-4 py-4 text-xs text-slate-500">{{ $city }}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">{{ $lawyer }}</td>
                    <td class="px-4 py-4 text-xs text-slate-400">{{ $date }}</td>
                    <td class="px-4 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-700">{{ $status }}</span>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-1">
                            <a href="/cases/1" class="p-1.5 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="عرض">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <button onclick="openModal('editCaseModal')" class="p-1.5 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="تعديل">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
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
    <div class="flex items-center justify-between px-5 py-4 border-t border-slate-100">
        <span class="text-xs text-slate-400">عرض 1–8 من 127 نتيجة</span>
        <div class="flex items-center gap-1">
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-400 text-sm hover:bg-slate-50 flex items-center justify-center">‹</button>
            <button class="w-8 h-8 rounded-lg bg-amber-500 text-white text-sm font-medium flex items-center justify-center">1</button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-500 text-sm hover:bg-slate-50 flex items-center justify-center">2</button>
            <span class="text-slate-400 text-sm px-1">...</span>
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-500 text-sm hover:bg-slate-50 flex items-center justify-center">16</button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-400 text-sm hover:bg-slate-50 flex items-center justify-center">›</button>
        </div>
    </div>
</div>

{{-- ADD CASE MODAL --}}
<div id="addCaseModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('addCaseModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">إضافة قضية جديدة</h2>
            <button onclick="closeModal('addCaseModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">اسم القضية <span class="text-red-400">*</span></label>
                    <input type="text" placeholder="وصف موجز للقضية" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">العميل <span class="text-red-400">*</span></label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option value="">اختر العميل</option>
                        <option>شركة البنيان للتطوير العقاري</option>
                        <option>أحمد بن سالم العتيبي</option>
                        <option>مجموعة الفارس التجارية</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">نوع القضية <span class="text-red-400">*</span></label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option value="">اختر النوع</option>
                        <option>تجارية</option><option>عمالية</option><option>جنائية</option>
                        <option>أحوال شخصية</option><option>إدارية</option><option>عقارية</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">المحامي المسؤول <span class="text-red-400">*</span></label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option value="">اختر المحامي</option>
                        <option>عبدالله الرويسي</option><option>سارة الحربي</option><option>محمد الغامدي</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">المحكمة</label>
                    <input type="text" placeholder="اسم المحكمة" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">المدينة</label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option value="">اختر المدينة</option>
                        <option>الرياض</option><option>جدة</option><option>الدمام</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">تاريخ بداية القضية</label>
                    <input type="date" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">حالة القضية</label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option>جديدة</option><option>تحت الدراسة</option><option>قيد التنفيذ</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">وصف القضية</label>
                    <textarea rows="3" placeholder="تفاصيل ووصف القضية..." class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 resize-none"></textarea>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('addCaseModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100 transition-colors">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-colors font-medium shadow-sm shadow-amber-500/30">حفظ القضية</button>
        </div>
    </div>
</div>

<div id="editCaseModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('editCaseModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">تعديل القضية</h2>
            <button onclick="closeModal('editCaseModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">حالة القضية</label>
                <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                    <option>قيد التنفيذ</option><option>جديدة</option><option>تحت الدراسة</option>
                    <option>بانتظار جلسة</option><option>مغلقة</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">المحامي المسؤول</label>
                <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                    <option>عبدالله الرويسي</option><option>سارة الحربي</option><option>محمد الغامدي</option>
                </select>
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('editCaseModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100 transition-colors">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-colors font-medium">حفظ</button>
        </div>
    </div>
</div>

@endsection
