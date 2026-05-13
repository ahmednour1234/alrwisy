@extends('layouts.app')
@section('title','معاملات إنجاز')

@section('content')

{{-- ═══ إنجاز Integration Status Banner ═══ --}}
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 mb-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            {{-- Enjaz logo badge --}}
            <div class="w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-sm font-bold text-slate-800">ربط نظام إنجاز</span>
                    <span id="connStatusBadge" class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                        متصل
                    </span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5">آخر مزامنة: <span id="lastSyncTime">اليوم 18:52</span> · <span class="text-slate-500">3 معاملات جديدة من إنجاز</span></p>
            </div>
        </div>

        {{-- Platform status chips --}}
        <div class="flex items-center gap-2 flex-wrap">
            @foreach(['إنجاز'=>true,'ناجز'=>true,'أبشر أعمال'=>true,'قوى'=>false,'وزارة العدل'=>true] as $plat=>$on)
            <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border {{ $on?'border-green-200 bg-green-50':'border-slate-200 bg-slate-50' }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $on?'bg-green-500':'bg-slate-300' }}"></span>
                <span class="text-xs font-medium {{ $on?'text-green-700':'text-slate-400' }}">{{ $plat }}</span>
            </div>
            @endforeach
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-2">
            <button onclick="syncEnjaz()" id="syncBtn"
                    class="flex items-center gap-2 px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-xl transition-colors">
                <svg id="syncIcon" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                <span id="syncLabel">مزامنة الآن</span>
            </button>
            <button onclick="openModal('enjazSettingsModal')"
                    class="flex items-center gap-2 px-4 py-2 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                إعدادات الربط
            </button>
        </div>
    </div>

    {{-- Sync progress bar (hidden by default) --}}
    <div id="syncProgress" class="hidden mt-4 pt-4 border-t border-slate-100">
        <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
            <span id="syncProgressLabel">جارٍ الاتصال بخوادم إنجاز...</span>
            <span id="syncProgressPct">0%</span>
        </div>
        <div class="w-full bg-slate-100 rounded-full h-1.5">
            <div id="syncProgressBar" class="bg-slate-600 h-1.5 rounded-full transition-all duration-500" style="width:0%"></div>
        </div>
    </div>
</div>

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-bold text-slate-800">معاملات إنجاز والخدمات الحكومية</h1>
        <p class="text-sm text-slate-500 mt-0.5">إدارة المعاملات الحكومية عبر إنجاز وناجز وأبشر</p>
    </div>
    <button onclick="openModal('addEnjazModal')"
            class="flex items-center gap-2 px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-xl transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        إضافة معاملة جديدة
    </button>
</div>

{{-- Stats strip --}}
<div class="grid grid-cols-3 md:grid-cols-6 gap-3 mb-5">
    @foreach([
        ['جديد','5','blue'],['تحت الإجراء','8','amber'],['بانتظار مستندات','4','purple'],
        ['مكتمل','42','green'],['مرفوض','3','red'],['ملغي','2','slate'],
    ] as [$label,$count,$color])
    <div class="bg-white rounded-xl p-3 border border-slate-100 shadow-sm text-center cursor-pointer hover:border-{{ $color }}-200 transition-colors">
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
            <input type="search" placeholder="البحث برقم المعاملة أو اسم العميل..." class="w-full pr-9 pl-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
        </div>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">نوع الخدمة</option>
            <option>تأشيرات</option><option>تفويض</option><option>تصديق</option>
            <option>طلب زيارة</option><option>خدمات مقيم</option><option>خدمات وزارة العدل</option>
            <option>خدمات ناجز</option><option>خدمات قوى</option><option>خدمات أبشر أعمال</option>
        </select>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">الحالة</option>
            <option>جديد</option><option>تحت الإجراء</option><option>بانتظار مستندات</option>
            <option>مكتمل</option><option>مرفوض</option><option>ملغي</option>
        </select>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">المنصة</option>
            <option>إنجاز</option><option>ناجز</option><option>أبشر أعمال</option><option>وزارة العدل</option>
        </select>
        <input type="month" class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
    </div>
</div>

{{-- Table --}}
@php
$transactions = [
    ['MU-2024-001','شركة البنيان للتطوير العقاري','تأشيرات عمل (×5)','إنجاز','ريم السلمي','01/03/2024','2,500 ر.س','3,000 ر.س','تحت الإجراء','amber'],
    ['MU-2024-002','أحمد بن سالم العتيبي','تصديق وثيقة','ناجز','ريم السلمي','05/03/2024','150 ر.س','200 ر.س','مكتمل','green'],
    ['MU-2024-003','مجموعة الفارس التجارية','تفويض رسمي','أبشر أعمال','نورة الزهراني','10/03/2024','300 ر.س','400 ر.س','بانتظار مستندات','purple'],
    ['MU-2024-004','شركة النخيل للاستثمار','خدمات مقيم (×3)','إنجاز','ريم السلمي','15/03/2024','750 ر.س','—','جديد','blue'],
    ['MU-2024-005','خالد ناصر الشمري','خدمات وزارة العدل','ناجز','نورة الزهراني','20/03/2024','500 ر.س','600 ر.س','مكتمل','green'],
    ['MU-2024-006','فاطمة علي الزهراني','طلب زيارة عائلية','أبشر','ريم السلمي','25/03/2024','200 ر.س','—','مرفوض','red'],
    ['MU-2024-007','مؤسسة السمو التجارية','تأشيرة عمل','إنجاز','ريم السلمي','01/04/2024','500 ر.س','—','تحت الإجراء','amber'],
    ['MU-2024-008','عمر محمد القحطاني','خدمات قوى','قوى','نورة الزهراني','05/04/2024','350 ر.س','400 ر.س','مكتمل','green'],
];
@endphp

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
        <span class="text-sm text-slate-500 font-medium">64 معاملة</span>
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
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">رقم المعاملة</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">اسم العميل</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">نوع الخدمة</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">المنصة</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">الموظف المسؤول</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">تاريخ التقديم</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">التكلفة</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">المبلغ المستلم</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">الحالة</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($transactions as [$num,$client,$service,$platform,$employee,$date,$cost,$received,$status,$color])
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-4 text-xs font-mono font-medium text-slate-600">{{ $num }}</td>
                    <td class="px-4 py-4 text-sm font-medium text-slate-700">{{ $client }}</td>
                    <td class="px-4 py-4 text-xs text-slate-500">{{ $service }}</td>
                    <td class="px-4 py-4">
                        <span class="text-xs font-medium text-slate-600 bg-slate-100 px-2 py-0.5 rounded-full">{{ $platform }}</span>
                    </td>
                    <td class="px-4 py-4 text-xs text-slate-500">{{ $employee }}</td>
                    <td class="px-4 py-4 text-xs text-slate-400">{{ $date }}</td>
                    <td class="px-4 py-4 text-xs font-medium text-slate-700">{{ $cost }}</td>
                    <td class="px-4 py-4 text-xs font-medium {{ $received==='—' ? 'text-slate-300' : 'text-green-600' }}">{{ $received }}</td>
                    <td class="px-4 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-700">{{ $status }}</span>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-1">
                            <button class="p-1.5 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="عرض">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                            <button onclick="openModal('editEnjazModal')" class="p-1.5 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="تعديل">
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
        <span class="text-xs text-slate-400">عرض 1–8 من 64 نتيجة</span>
        <div class="flex items-center gap-1">
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-400 text-sm hover:bg-slate-50 flex items-center justify-center">‹</button>
            <button class="w-8 h-8 rounded-lg bg-amber-500 text-white text-sm font-medium flex items-center justify-center">1</button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-500 text-sm hover:bg-slate-50 flex items-center justify-center">2</button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-400 text-sm hover:bg-slate-50 flex items-center justify-center">›</button>
        </div>
    </div>
</div>

{{-- Add Enjaz Modal --}}
<div id="addEnjazModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('addEnjazModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">إضافة معاملة جديدة</h2>
            <button onclick="closeModal('addEnjazModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">اسم العميل <span class="text-red-400">*</span></label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option value="">اختر العميل</option>
                        <option>شركة البنيان للتطوير العقاري</option>
                        <option>أحمد بن سالم العتيبي</option>
                        <option>مجموعة الفارس التجارية</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">نوع الخدمة <span class="text-red-400">*</span></label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option value="">اختر نوع الخدمة</option>
                        <option>تأشيرات</option><option>تفويض</option><option>تصديق</option>
                        <option>طلب زيارة</option><option>خدمات مقيم</option>
                        <option>خدمات وزارة العدل</option><option>خدمات ناجز</option>
                        <option>خدمات قوى</option><option>خدمات أبشر أعمال</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">المنصة / الجهة <span class="text-red-400">*</span></label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option value="">اختر المنصة</option>
                        <option>إنجاز</option><option>ناجز</option><option>أبشر أعمال</option>
                        <option>وزارة العدل</option><option>قوى</option><option>أبشر</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الموظف المسؤول</label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option>ريم السلمي</option><option>نورة الزهراني</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">تاريخ التقديم</label>
                    <input type="date" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الحالة</label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option>جديد</option><option>تحت الإجراء</option><option>بانتظار مستندات</option>
                        <option>مكتمل</option><option>مرفوض</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">التكلفة (ر.س)</label>
                    <input type="number" placeholder="0.00" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">المبلغ المستلم (ر.س)</label>
                    <input type="number" placeholder="0.00" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">ملاحظات</label>
                    <textarea rows="2" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 resize-none"></textarea>
                </div>
            </div>
        </div>
        <div class="flex justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('addEnjazModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl font-medium shadow-sm shadow-amber-500/30">حفظ المعاملة</button>
        </div>
    </div>
</div>

{{-- Enjaz Integration Settings Modal --}}
<div id="enjazSettingsModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('enjazSettingsModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-slate-800 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9"/></svg>
                </div>
                <h2 class="text-base font-bold text-slate-800">إعدادات ربط نظام إنجاز</h2>
            </div>
            <button onclick="closeModal('enjazSettingsModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6 space-y-5">
            {{-- Connection test result --}}
            <div class="flex items-center gap-3 p-3 bg-green-50 border border-green-200 rounded-xl">
                <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div>
                    <p class="text-sm font-medium text-green-800">الاتصال نشط</p>
                    <p class="text-xs text-green-600">متصل بنجاح بمنصة إنجاز · آخر فحص منذ 3 دقائق</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">رقم الترخيص / السجل التجاري</label>
                <input type="text" value="1010XXXXXXX" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-400 bg-slate-50" dir="ltr">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">مفتاح API</label>
                <div class="relative">
                    <input type="password" value="sk_live_xxxxxxxxxxxxxxxxxxxx" id="apiKeyInput" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-400 bg-slate-50 pl-10" dir="ltr">
                    <button onclick="toggleApiKey()" class="absolute left-3 top-2.5 text-slate-400 hover:text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">تكرار المزامنة التلقائية</label>
                <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-400 bg-slate-50 text-slate-600">
                    <option>كل 15 دقيقة</option>
                    <option>كل 30 دقيقة</option>
                    <option selected>كل ساعة</option>
                    <option>كل 6 ساعات</option>
                    <option>يدوي فقط</option>
                </select>
            </div>

            {{-- Platforms toggle --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-3">المنصات المفعّلة</label>
                <div class="space-y-2">
                    @foreach(['إنجاز'=>true,'ناجز'=>true,'أبشر أعمال'=>true,'قوى'=>false,'وزارة العدل'=>true] as $plat=>$on)
                    <div class="flex items-center justify-between px-4 py-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-sm text-slate-700">{{ $plat }}</span>
                        <button onclick="this.classList.toggle('bg-slate-700');this.classList.toggle('bg-slate-200');this.querySelector('span').classList.toggle('translate-x-5');this.querySelector('span').classList.toggle('translate-x-0.5')"
                            class="relative inline-flex w-11 h-6 rounded-full transition-colors duration-200 {{ $on?'bg-slate-700':'bg-slate-200' }} focus:outline-none shrink-0">
                            <span class="inline-block w-5 h-5 bg-white rounded-full shadow transform transition-transform duration-200 {{ $on?'translate-x-5':'translate-x-0.5' }} mt-0.5"></span>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex justify-between items-center px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="testConnection()" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                اختبار الاتصال
            </button>
            <div class="flex gap-3">
                <button onclick="closeModal('enjazSettingsModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-white">إلغاء</button>
                <button class="px-5 py-2 text-sm text-white bg-slate-800 hover:bg-slate-700 rounded-xl font-medium">حفظ الإعدادات</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// ── Enjaz Sync simulation ──
function syncEnjaz() {
    const btn = document.getElementById('syncBtn');
    const icon = document.getElementById('syncIcon');
    const label = document.getElementById('syncLabel');
    const progress = document.getElementById('syncProgress');
    const bar = document.getElementById('syncProgressBar');
    const pct = document.getElementById('syncProgressPct');
    const progressLabel = document.getElementById('syncProgressLabel');

    btn.disabled = true;
    btn.classList.add('opacity-60');
    icon.classList.add('animate-spin');
    label.textContent = 'جارٍ المزامنة...';
    progress.classList.remove('hidden');

    const steps = [
        [20, 'الاتصال بخوادم إنجاز...'],
        [45, 'جلب المعاملات الجديدة...'],
        [70, 'تحديث حالات المعاملات...'],
        [90, 'مزامنة بيانات ناجز...'],
        [100, 'اكتملت المزامنة!'],
    ];

    let i = 0;
    const interval = setInterval(() => {
        if (i >= steps.length) {
            clearInterval(interval);
            setTimeout(() => {
                // Reset
                btn.disabled = false;
                btn.classList.remove('opacity-60');
                icon.classList.remove('animate-spin');
                label.textContent = 'مزامنة الآن';
                progress.classList.add('hidden');
                bar.style.width = '0%';
                // Update last sync time
                const now = new Date();
                document.getElementById('lastSyncTime').textContent =
                    'اليوم ' + now.getHours().toString().padStart(2,'0') + ':' + now.getMinutes().toString().padStart(2,'0');
                // Push a notification
                pushSyncNotification();
            }, 800);
            return;
        }
        const [p, txt] = steps[i];
        bar.style.width = p + '%';
        pct.textContent = p + '%';
        progressLabel.textContent = txt;
        i++;
    }, 600);
}

function pushSyncNotification() {
    const list = document.getElementById('notifList');
    if (!list) return;
    const item = document.createElement('div');
    item.className = 'notif-item flex gap-3 px-5 py-3.5 hover:bg-slate-50 cursor-pointer bg-blue-50/40 transition-colors';
    item.setAttribute('data-unread','1');
    item.innerHTML = `
        <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 mt-0.5">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-slate-800">مزامنة إنجاز مكتملة</p>
            <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">تمت مزامنة 3 معاملات جديدة بنجاح من منصة إنجاز</p>
            <p class="text-xs text-slate-400 mt-1">الآن</p>
        </div>
        <span class="w-2 h-2 bg-blue-500 rounded-full mt-2 shrink-0"></span>`;
    list.prepend(item);
    // Update badge
    const badge = document.getElementById('notifBadge');
    if (badge) {
        badge.classList.remove('hidden');
        badge.textContent = parseInt(badge.textContent || 0) + 1;
    }
}

function testConnection() {
    alert('✓ الاتصال بمنصة إنجاز نشط وتعمل بشكل صحيح');
}

function toggleApiKey() {
    const inp = document.getElementById('apiKeyInput');
    inp.type = inp.type === 'password' ? 'text' : 'password';
}
</script>
@endpush
