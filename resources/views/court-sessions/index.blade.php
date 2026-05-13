@extends('layouts.app')
@section('title','الجلسات')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-bold text-slate-800">إدارة الجلسات</h1>
        <p class="text-sm text-slate-500 mt-0.5">متابعة جلسات المحاكم وتواريخها</p>
    </div>
    <button onclick="openModal('addSessionModal')"
            class="flex items-center gap-2 px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-xl transition-colors shadow-sm shadow-amber-500/30">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        إضافة جلسة جديدة
    </button>
</div>

{{-- Status strip --}}
<div class="grid grid-cols-4 gap-4 mb-5">
    @foreach([['مجدولة','18','blue'],['تمت','142','green'],['مؤجلة','7','amber'],['ملغاة','3','red']] as [$label,$count,$color])
    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm flex items-center gap-4 cursor-pointer hover:border-{{ $color }}-300 transition-colors">
        <div class="w-10 h-10 bg-{{ $color }}-50 rounded-xl flex items-center justify-center">
            <span class="text-lg font-bold text-{{ $color }}-600">{{ $count }}</span>
        </div>
        <div class="text-sm font-medium text-slate-600">{{ $label }}</div>
    </div>
    @endforeach
</div>

{{-- Filters --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-5">
    <div class="flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-48">
            <svg class="w-4 h-4 text-slate-400 absolute top-2.5 right-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="search" placeholder="البحث بالقضية أو العميل..." class="w-full pr-9 pl-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
        </div>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">جميع الحالات</option>
            <option>مجدولة</option><option>تمت</option><option>مؤجلة</option><option>ملغاة</option>
        </select>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">جميع المحاكم</option>
            <option>المحكمة التجارية بالرياض</option>
            <option>المحكمة العمالية بالرياض</option>
            <option>محكمة الأحوال الشخصية بجدة</option>
        </select>
        <input type="date" class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
    </div>
</div>

{{-- Table --}}
@php
$sessions = [
    ['قضية البنيان (2024/1234)','شركة البنيان','المحكمة التجارية بالرياض','الدائرة 7 — محمد العسيري','25/05/2026','10:00 ص','—','—','مجدولة','blue'],
    ['قضية العتيبي (2024/5678)','أحمد العتيبي','المحكمة العمالية بالرياض','الدائرة 3 — علي الحربي','14/05/2026','09:30 ص','—','—','مجدولة','blue'],
    ['قضية الزهراني (2024/9012)','فاطمة الزهراني','محكمة الأحوال الشخصية','الدائرة 2 — محمود السيد','15/05/2026','11:00 ص','—','—','مجدولة','blue'],
    ['قضية البنيان (2024/1234)','شركة البنيان','المحكمة التجارية بالرياض','الدائرة 7','12/04/2026','10:00 ص','تقرير الخبير صدر','25/05/2026','تمت','green'],
    ['قضية الفارس (2024/2345)','مجموعة الفارس','المحكمة التجارية بالرياض','الدائرة 5','10/05/2026','09:00 ص','تأجّل لمزيد من المستندات','28/05/2026','مؤجلة','amber'],
    ['قضية الشمري (2024/3456)','خالد الشمري','ديوان المظالم','الدائرة 1','08/05/2026','10:30 ص','رُفع الاستئناف','03/06/2026','تمت','green'],
    ['قضية القحطاني (2024/6789)','عمر القحطاني','المحكمة الجزائية بجدة','الدائرة 4','05/05/2026','09:00 ص','ألغيت الجلسة','—','ملغاة','red'],
];
@endphp

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
        <span class="text-sm text-slate-500 font-medium">170 جلسة</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">القضية</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">العميل</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">المحكمة</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">الدائرة / القاضي</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">التاريخ</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">الوقت</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">النتيجة</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">الجلسة القادمة</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">الحالة</th>
                    <th class="px-4 py-3.5 text-right text-xs font-medium text-slate-500">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($sessions as [$case,$client,$court,$circle,$date,$time,$result,$next,$status,$color])
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-4 text-xs font-medium text-slate-700">{{ $case }}</td>
                    <td class="px-4 py-4 text-xs text-slate-600">{{ $client }}</td>
                    <td class="px-4 py-4 text-xs text-slate-500">{{ $court }}</td>
                    <td class="px-4 py-4 text-xs text-slate-500">{{ $circle }}</td>
                    <td class="px-4 py-4 text-xs text-slate-500">{{ $date }}</td>
                    <td class="px-4 py-4 text-xs text-slate-400">{{ $time }}</td>
                    <td class="px-4 py-4 text-xs text-slate-500 max-w-32 truncate">{{ $result ?: '—' }}</td>
                    <td class="px-4 py-4 text-xs text-slate-500">{{ $next }}</td>
                    <td class="px-4 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-700">{{ $status }}</span>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-1">
                            <button class="p-1.5 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="عرض">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                            <button onclick="openModal('editSessionModal')" class="p-1.5 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="تعديل">
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
        <span class="text-xs text-slate-400">عرض 1–7 من 170 نتيجة</span>
        <div class="flex items-center gap-1">
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-400 text-sm hover:bg-slate-50 flex items-center justify-center">‹</button>
            <button class="w-8 h-8 rounded-lg bg-amber-500 text-white text-sm font-medium flex items-center justify-center">1</button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-500 text-sm hover:bg-slate-50 flex items-center justify-center">2</button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 text-slate-400 text-sm hover:bg-slate-50 flex items-center justify-center">›</button>
        </div>
    </div>
</div>

{{-- Add Session Modal --}}
<div id="addSessionModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('addSessionModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">إضافة جلسة جديدة</h2>
            <button onclick="closeModal('addSessionModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">القضية <span class="text-red-400">*</span></label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option value="">اختر القضية</option>
                        <option>2024/1234 — نزاع عقد توريد</option>
                        <option>2024/5678 — مطالبة عمالية</option>
                        <option>2024/9012 — طلاق وحضانة</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">المحكمة <span class="text-red-400">*</span></label>
                    <input type="text" placeholder="اسم المحكمة" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الدائرة / القاضي</label>
                    <input type="text" placeholder="الدائرة التجارية 7" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">تاريخ الجلسة <span class="text-red-400">*</span></label>
                    <input type="date" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">وقت الجلسة</label>
                    <input type="time" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الحالة</label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option>مجدولة</option><option>تمت</option><option>مؤجلة</option><option>ملغاة</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">نتيجة الجلسة / ملاحظات</label>
                    <textarea rows="3" placeholder="ملاحظات حول نتيجة الجلسة..." class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 resize-none"></textarea>
                </div>
            </div>
        </div>
        <div class="flex justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('addSessionModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl font-medium shadow-sm shadow-amber-500/30">حفظ الجلسة</button>
        </div>
    </div>
</div>

<div id="editSessionModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('editSessionModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">تعديل الجلسة</h2>
            <button onclick="closeModal('editSessionModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">نتيجة الجلسة</label>
                <textarea rows="3" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 resize-none"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">الحالة</label>
                <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                    <option>مجدولة</option><option>تمت</option><option>مؤجلة</option><option>ملغاة</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">الجلسة القادمة</label>
                <input type="date" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
            </div>
        </div>
        <div class="flex justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('editSessionModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl font-medium">حفظ</button>
        </div>
    </div>
</div>

@endsection
