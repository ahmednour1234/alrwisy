@extends('layouts.app')
@section('title','العملاء')

@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-bold text-slate-800">إدارة العملاء</h1>
        <p class="text-sm text-slate-500 mt-0.5">قائمة جميع عملاء المكتب وبياناتهم</p>
    </div>
    <button onclick="openModal('addClientModal')"
            class="flex items-center gap-2 px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-xl transition-colors shadow-sm shadow-amber-500/30">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        إضافة عميل جديد
    </button>
</div>

{{-- Stats strip --}}
<div class="grid grid-cols-3 gap-4 mb-5">
    @foreach([['إجمالي العملاء','96','blue'],['عملاء أفراد','58','slate'],['عملاء شركات','38','amber']] as [$label,$val,$c])
    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm flex items-center gap-4">
        <div class="text-2xl font-bold text-slate-800">{{ $val }}</div>
        <div class="text-sm text-slate-500">{{ $label }}</div>
    </div>
    @endforeach
</div>

{{-- Filters --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-5">
    <div class="flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-48">
            <svg class="w-4 h-4 text-slate-400 absolute top-2.5 right-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="search" placeholder="البحث بالاسم أو رقم الهوية..."
                   class="w-full pr-9 pl-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
        </div>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">جميع الأنواع</option>
            <option>فرد</option>
            <option>شركة</option>
        </select>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">جميع الحالات</option>
            <option>نشط</option>
            <option>غير نشط</option>
        </select>
    </div>
</div>

{{-- Table --}}
@php
$clients = [
    ['شركة البنيان للتطوير العقاري', 'شركة', '0501112233', '7001234567', 'info@bonian.sa',   4, 'نشط',    'ب'],
    ['أحمد بن سالم العتيبي',          'فرد',   '0551113344', '1001234567', 'ahmed@mail.sa',   2, 'نشط',    'أ'],
    ['مجموعة الفارس التجارية',        'شركة', '0561114455', '7009876543', 'info@alfares.sa',  6, 'نشط',    'م'],
    ['خالد ناصر الشمري',              'فرد',   '0571115566', '1009876543', 'khalid@mail.sa',  1, 'نشط',    'خ'],
    ['شركة النخيل للاستثمار',         'شركة', '0581116677', '7004567890', 'info@nakhl.sa',    3, 'نشط',    'ن'],
    ['فاطمة علي الزهراني',            'فرد',   '0591117788', '2001234567', 'fatima@mail.sa',  1, 'نشط',    'ف'],
    ['مؤسسة السمو التجارية',           'شركة', '0501118899', '7001112233', 'info@sumo.sa',    2, 'غير نشط','س'],
    ['عمر محمد القحطاني',             'فرد',   '0551119900', '1008765432', 'omar@mail.sa',    3, 'نشط',    'ع'],
];
@endphp

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
        <span class="text-sm text-slate-500 font-medium">{{ count($clients) }} عميل</span>
        <button class="flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            تصدير
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">اسم العميل</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">نوع العميل</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">رقم الجوال</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">رقم الهوية / السجل</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">البريد الإلكتروني</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">عدد القضايا</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">الحالة</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($clients as [$name,$type,$phone,$id,$email,$cases,$status,$initial])
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl {{ $type==='شركة' ? 'bg-blue-500' : 'bg-slate-500' }} flex items-center justify-center text-white font-bold text-sm flex-shrink-0">{{ $initial }}</div>
                            <div>
                                <div class="font-medium text-slate-800 text-sm">{{ $name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $type==='شركة' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-700' }}">{{ $type }}</span>
                    </td>
                    <td class="px-5 py-4 text-sm text-slate-600 font-mono">{{ $phone }}</td>
                    <td class="px-5 py-4 text-sm text-slate-500 font-mono">{{ $id }}</td>
                    <td class="px-5 py-4 text-sm text-slate-500">{{ $email }}</td>
                    <td class="px-5 py-4">
                        <span class="font-semibold text-slate-800 text-sm">{{ $cases }}</span>
                        <span class="text-slate-400 text-xs mr-1">قضية</span>
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
                            <button onclick="openModal('editClientModal')" class="p-1.5 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="تعديل">
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
        <span class="text-xs text-slate-400">عرض 1–8 من 96 نتيجة</span>
        <div class="flex items-center gap-1">
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-400 text-sm hover:bg-slate-50 flex items-center justify-center">‹</button>
            <button class="w-8 h-8 rounded-lg bg-amber-500 text-white text-sm font-medium flex items-center justify-center">1</button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-500 text-sm hover:bg-slate-50 flex items-center justify-center">2</button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-500 text-sm hover:bg-slate-50 flex items-center justify-center">3</button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-400 text-sm hover:bg-slate-50 flex items-center justify-center">›</button>
        </div>
    </div>
</div>

{{-- ADD CLIENT MODAL --}}
<div id="addClientModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('addClientModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">إضافة عميل جديد</h2>
            <button onclick="closeModal('addClientModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">اسم العميل <span class="text-red-400">*</span></label>
                    <input type="text" placeholder="الاسم الكامل أو اسم الشركة" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">نوع العميل <span class="text-red-400">*</span></label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option value="">اختر النوع</option>
                        <option>فرد</option>
                        <option>شركة</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">رقم الجوال <span class="text-red-400">*</span></label>
                    <input type="tel" placeholder="05XXXXXXXX" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">رقم الهوية / السجل التجاري <span class="text-red-400">*</span></label>
                    <input type="text" placeholder="XXXXXXXXXX" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">البريد الإلكتروني</label>
                    <input type="email" placeholder="example@mail.sa" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">المدينة</label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option value="">اختر المدينة</option>
                        <option>الرياض</option>
                        <option>جدة</option>
                        <option>الدمام</option>
                        <option>مكة المكرمة</option>
                        <option>المدينة المنورة</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">ملاحظات</label>
                    <textarea rows="3" placeholder="ملاحظات إضافية عن العميل..." class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 resize-none"></textarea>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('addClientModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100 transition-colors">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-colors font-medium shadow-sm shadow-amber-500/30">حفظ العميل</button>
        </div>
    </div>
</div>

<div id="editClientModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('editClientModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">تعديل بيانات العميل</h2>
            <button onclick="closeModal('editClientModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">اسم العميل</label>
                <input type="text" value="شركة البنيان للتطوير العقاري" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">رقم الجوال</label>
                <input type="tel" value="0501112233" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('editClientModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100 transition-colors">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-colors font-medium">حفظ التعديلات</button>
        </div>
    </div>
</div>

@endsection
