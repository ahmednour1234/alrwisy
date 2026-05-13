@extends('layouts.app')
@section('title','أرشيف المستندات')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-bold text-slate-800">أرشيف المستندات</h1>
        <p class="text-sm text-slate-500 mt-0.5">حفظ وإدارة جميع وثائق ومستندات المكتب</p>
    </div>
    <button onclick="openModal('uploadDocModal')"
            class="flex items-center gap-2 px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-xl transition-colors shadow-sm shadow-amber-500/30">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
        رفع مستند جديد
    </button>
</div>

{{-- Stats --}}
<div class="grid grid-cols-4 gap-4 mb-5">
    @foreach([['إجمالي المستندات','248','slate'],['هذا الشهر','18','blue'],['حجم الأرشيف','1.2 GB','amber'],['الأنواع','8','green']] as [$label,$val,$color])
    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm flex items-center gap-4">
        <div class="text-xl font-bold text-slate-800">{{ $val }}</div>
        <div class="text-sm text-slate-500">{{ $label }}</div>
    </div>
    @endforeach
</div>

{{-- Filters --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-5">
    <div class="flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-48">
            <svg class="w-4 h-4 text-slate-400 absolute top-2.5 right-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="search" placeholder="البحث بالاسم أو العميل أو القضية..." class="w-full pr-9 pl-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
        </div>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">نوع المستند</option>
            <option>عقد</option><option>وكالة</option><option>هوية</option><option>مذكرة</option>
            <option>حكم</option><option>إيصال</option><option>مستند قضية</option><option>مستند معاملة</option>
        </select>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">ربط بـ</option>
            <option>قضية</option><option>عميل</option><option>معاملة إنجاز</option>
        </select>
        <input type="month" class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
    </div>
</div>

{{-- Document type filter pills --}}
<div class="flex items-center gap-2 mb-5 flex-wrap">
    <button class="px-4 py-2 rounded-xl text-sm font-medium bg-amber-500 text-white">الكل (248)</button>
    @foreach(['عقد (34)','وكالة (28)','هوية (45)','مذكرة (52)','حكم (18)','إيصال (39)','مستند قضية (22)','مستند معاملة (10)'] as $pill)
    <button class="px-4 py-2 rounded-xl text-sm font-medium bg-white border border-slate-200 text-slate-600 hover:border-amber-300 hover:text-amber-600 transition-colors">{{ $pill }}</button>
    @endforeach
</div>

{{-- Documents Grid --}}
@php
$docs = [
    ['عقد التوريد الأصلي','عقد','شركة البنيان','قضية 2024/1234','2.4 MB','01/03/2024','pdf'],
    ['هوية مدير البنيان','هوية','شركة البنيان','—','0.8 MB','01/03/2024','img'],
    ['مذكرة الدفاع الأولى','مذكرة','شركة البنيان','قضية 2024/1234','1.2 MB','15/03/2024','doc'],
    ['تقرير الخبير المحاسب','مستند قضية','شركة البنيان','قضية 2024/1234','3.1 MB','12/04/2024','pdf'],
    ['وكالة قانونية — العتيبي','وكالة','أحمد العتيبي','قضية 2024/5678','0.5 MB','16/03/2024','pdf'],
    ['هوية أحمد العتيبي','هوية','أحمد العتيبي','—','0.7 MB','16/03/2024','img'],
    ['عقد الإيجار المتنازع عليه','عقد','شركة النخيل','قضية 2024/7890','1.8 MB','10/04/2024','pdf'],
    ['حكم محكمة الأحوال','حكم','فاطمة الزهراني','قضية 2024/9012','0.9 MB','20/04/2024','pdf'],
    ['إيصال تأشيرة العمل','إيصال','شركة البنيان','MU-2024-001','0.2 MB','01/03/2024','img'],
    ['تصريح العمل','مستند معاملة','مجموعة الفارس','MU-2024-003','1.1 MB','10/03/2024','pdf'],
    ['مذكرة الاستئناف','مذكرة','مجموعة الفارس','قضية 2024/2345','2.0 MB','01/05/2024','doc'],
    ['وكالة قانونية — الشمري','وكالة','خالد الشمري','قضية 2024/3456','0.4 MB','05/04/2024','pdf'],
];
$typeColors = ['عقد'=>'blue','وكالة'=>'purple','هوية'=>'green','مذكرة'=>'amber','حكم'=>'red','إيصال'=>'teal','مستند قضية'=>'slate','مستند معاملة'=>'indigo'];
@endphp

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach($docs as [$name,$type,$client,$linked,$size,$date,$format])
    @php $tc = $typeColors[$type] ?? 'slate'; @endphp
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow group">
        {{-- File preview area --}}
        <div class="h-28 bg-slate-50 flex items-center justify-center relative">
            @if($format === 'pdf')
            <div class="w-14 h-16 bg-red-50 border-2 border-red-100 rounded-lg flex flex-col items-center justify-center">
                <div class="text-red-500 font-bold text-xs">PDF</div>
                <svg class="w-6 h-6 text-red-400 mt-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            @elseif($format === 'img')
            <div class="w-14 h-16 bg-blue-50 border-2 border-blue-100 rounded-lg flex flex-col items-center justify-center">
                <div class="text-blue-500 font-bold text-xs">IMG</div>
                <svg class="w-6 h-6 text-blue-400 mt-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            @else
            <div class="w-14 h-16 bg-amber-50 border-2 border-amber-100 rounded-lg flex flex-col items-center justify-center">
                <div class="text-amber-600 font-bold text-xs">DOC</div>
                <svg class="w-6 h-6 text-amber-400 mt-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            @endif
            {{-- Actions overlay --}}
            <div class="absolute inset-0 bg-slate-900/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                <button class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-slate-700 hover:bg-amber-500 hover:text-white transition-colors" title="عرض">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
                <button class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-slate-700 hover:bg-blue-500 hover:text-white transition-colors" title="تحميل">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                </button>
                <button class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-slate-700 hover:bg-red-500 hover:text-white transition-colors" title="حذف">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </div>
        </div>
        {{-- Info --}}
        <div class="p-4">
            <p class="text-sm font-medium text-slate-800 truncate mb-1">{{ $name }}</p>
            <div class="flex items-center gap-2 mb-2">
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-{{ $tc }}-100 text-{{ $tc }}-700">{{ $type }}</span>
            </div>
            <p class="text-xs text-slate-400">{{ $client }}</p>
            <p class="text-xs text-slate-400">{{ $linked }}</p>
            <div class="flex items-center justify-between mt-2">
                <span class="text-xs text-slate-300">{{ $size }}</span>
                <span class="text-xs text-slate-300">{{ $date }}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Pagination --}}
<div class="flex items-center justify-between mt-5 pt-4">
    <span class="text-xs text-slate-400">عرض 1–12 من 248 مستند</span>
    <div class="flex items-center gap-1">
        <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-400 text-sm hover:bg-slate-50 flex items-center justify-center">‹</button>
        <button class="w-8 h-8 rounded-lg bg-amber-500 text-white text-sm font-medium flex items-center justify-center">1</button>
        <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-500 text-sm hover:bg-slate-50 flex items-center justify-center">2</button>
        <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-400 text-sm hover:bg-slate-50 flex items-center justify-center">›</button>
    </div>
</div>

{{-- Upload Modal --}}
<div id="uploadDocModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('uploadDocModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">رفع مستند جديد</h2>
            <button onclick="closeModal('uploadDocModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6 space-y-4">
            {{-- Drop zone --}}
            <div class="border-2 border-dashed border-slate-200 rounded-2xl p-10 text-center hover:border-amber-400 transition-colors cursor-pointer">
                <svg class="w-12 h-12 text-slate-200 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                <p class="text-sm font-medium text-slate-600">اسحب الملفات وأفلتها هنا</p>
                <p class="text-xs text-amber-500 font-medium mt-1">أو انقر للاختيار</p>
                <p class="text-xs text-slate-400 mt-2">PDF, DOC, DOCX, JPG, PNG — الحد الأقصى 20 MB</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">نوع المستند <span class="text-red-400">*</span></label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option value="">اختر النوع</option>
                        <option>عقد</option><option>وكالة</option><option>هوية</option><option>مذكرة</option>
                        <option>حكم</option><option>إيصال</option><option>مستند قضية</option><option>مستند معاملة</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">ربط بـ</label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option value="">اختر الارتباط</option>
                        <option>قضية</option><option>عميل</option><option>معاملة إنجاز</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">ملاحظات</label>
                <input type="text" placeholder="وصف مختصر للمستند..." class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
            </div>
        </div>
        <div class="flex justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('uploadDocModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl font-medium shadow-sm shadow-amber-500/30">رفع المستند</button>
        </div>
    </div>
</div>

@endsection
