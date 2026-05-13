@extends('layouts.app')
@section('title','تفاصيل القضية')

@section('content')

{{-- Breadcrumb + Actions --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <div class="flex items-center gap-2 text-sm text-slate-400 mb-1">
            <a href="/cases" class="hover:text-amber-500 transition-colors">القضايا</a>
            <span>›</span>
            <span class="text-slate-600">نزاع عقد توريد — البنيان</span>
        </div>
        <h1 class="text-xl font-bold text-slate-800">نزاع عقد توريد — شركة البنيان للتطوير العقاري</h1>
        <div class="flex items-center gap-3 mt-2">
            <span class="text-xs font-mono text-slate-400">رقم القضية: 2024/1234</span>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">قيد التنفيذ</span>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">تجارية</span>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <button onclick="openModal('addSessionModal')" class="flex items-center gap-1.5 px-3 py-2 border border-slate-200 text-slate-600 text-sm rounded-xl hover:bg-slate-50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            إضافة جلسة
        </button>
        <button onclick="openModal('addTaskModal')" class="flex items-center gap-1.5 px-3 py-2 border border-slate-200 text-slate-600 text-sm rounded-xl hover:bg-slate-50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            إضافة مهمة
        </button>
        <button onclick="openModal('uploadDocModal')" class="flex items-center gap-1.5 px-3 py-2 border border-slate-200 text-slate-600 text-sm rounded-xl hover:bg-slate-50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
            رفع مستند
        </button>
        <button onclick="openModal('changeStatusModal')" class="flex items-center gap-1.5 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm rounded-xl transition-colors shadow-sm shadow-amber-500/30">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            تغيير الحالة
        </button>
    </div>
</div>

{{-- Main grid --}}
<div class="grid grid-cols-3 gap-5">

    {{-- Left column: main content (2/3) - appears on RIGHT in RTL --}}
    <div class="col-span-2 space-y-5">

        {{-- Sessions Timeline --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-slate-800 text-sm">مسار الجلسات</h3>
                <span class="text-xs text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">4 جلسات</span>
            </div>
            <div class="p-5">
                <div class="relative">
                    <div class="absolute right-4 top-0 bottom-0 w-0.5 bg-slate-200"></div>
                    <div class="space-y-6">
                        @foreach([
                            ['الجلسة الرابعة','مجدولة','25 مايو 2026','الدائرة التجارية 7 — القاضي: محمد العسيري','مجدولة','blue','حاضر في الجلسة'],
                            ['الجلسة الثالثة','تمت','12 أبريل 2026','الدائرة التجارية 7','تمت','green','تقرير التحقيق صدر لصالح الموكل'],
                            ['الجلسة الثانية','تمت','05 مارس 2026','الدائرة التجارية 7','تمت','green','المحكمة طلبت تقرير خبير'],
                            ['الجلسة الأولى','تمت','10 يناير 2026','الدائرة التجارية 5','تمت','green','قدّمنا لائحة الدعوى'],
                        ] as [$session,$statusLabel,$date,$court,$status,$color,$notes])
                        <div class="flex gap-5 pr-8 relative">
                            <div class="absolute right-3 top-1 w-2.5 h-2.5 rounded-full bg-{{ $color }}-400 border-2 border-white shadow-sm flex-shrink-0"></div>
                            <div class="flex-1 bg-slate-50 rounded-xl p-4 border border-slate-100">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <span class="font-semibold text-slate-800 text-sm">{{ $session }}</span>
                                        <span class="mr-2 text-xs text-slate-400">{{ $date }}</span>
                                    </div>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-700">{{ $statusLabel }}</span>
                                </div>
                                <p class="text-xs text-slate-500 mb-1">{{ $court }}</p>
                                <p class="text-xs text-slate-600 bg-white px-3 py-2 rounded-lg border border-slate-100">{{ $notes }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Tasks linked to case --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-slate-800 text-sm">المهام المرتبطة</h3>
                <button onclick="openModal('addTaskModal')" class="text-xs text-amber-500 hover:text-amber-600 font-medium flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    إضافة مهمة
                </button>
            </div>
            <div class="divide-y divide-slate-50">
                @foreach([
                    ['مراجعة عقد التوريد الأصلي','سارة الحربي','10 مايو 2026','متأخرة','red','مكتملة'],
                    ['تحضير مذكرة الدفاع','محمد الغامدي','25 مايو 2026','عالية','amber','جاري العمل'],
                    ['التواصل مع خبير التقييم','عبدالله الرويسي','20 مايو 2026','متوسطة','blue','جديدة'],
                    ['مراسلة العميل بالتحديثات','نورة الزهراني','18 مايو 2026','منخفضة','slate','جديدة'],
                ] as [$task,$assignee,$due,$priority,$pColor,$taskStatus])
                <div class="flex items-center justify-between px-5 py-3.5 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 rounded-full border-2 border-{{ $pColor }}-300 flex-shrink-0 flex items-center justify-center">
                            @if($taskStatus==='مكتملة')
                            <svg class="w-3 h-3 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-700 {{ $taskStatus==='مكتملة' ? 'line-through text-slate-400' : '' }}">{{ $task }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $assignee }} · مستحقة {{ $due }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-{{ $pColor }}-100 text-{{ $pColor }}-700">{{ $priority }}</span>
                        <span class="text-xs text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">{{ $taskStatus }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Documents --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-slate-800 text-sm">المستندات والمرفقات</h3>
                <button onclick="openModal('uploadDocModal')" class="text-xs text-amber-500 hover:text-amber-600 font-medium flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    رفع مستند
                </button>
            </div>
            <div class="p-5 grid grid-cols-2 gap-3">
                @foreach([
                    ['عقد التوريد الأصلي.pdf','عقد','2.4 MB','01/03/2024'],
                    ['هوية العميل.jpg','هوية','0.8 MB','01/03/2024'],
                    ['مذكرة الدفاع.docx','مذكرة','1.2 MB','15/03/2024'],
                    ['تقرير الخبير.pdf','مستند','3.1 MB','12/04/2024'],
                ] as [$fname,$type,$size,$date])
                <div class="flex items-center gap-3 p-3 border border-slate-100 rounded-xl hover:bg-slate-50 transition-colors">
                    <div class="w-9 h-9 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-slate-700 truncate">{{ $fname }}</p>
                        <p class="text-xs text-slate-400">{{ $type }} · {{ $size }} · {{ $date }}</p>
                    </div>
                    <button class="text-slate-300 hover:text-slate-600 flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Notes --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-slate-800 text-sm">الملاحظات</h3>
            </div>
            <div class="p-5 space-y-3">
                @foreach([
                    ['عبدالله الرويسي','مدير المكتب','12 أبريل 2026','قرر القاضي الانتظار حتى صدور نتيجة التقرير الفني. يجب متابعة الأمر مع الخبير المحاسب خلال هذا الأسبوع.'],
                    ['سارة الحربي','محامية أولى','05 مارس 2026','الطرف المدعى عليه قدّم مستندات ناقصة. سيكون بمقدورنا الطعن في هذه المستندات في الجلسة القادمة.'],
                ] as [$author,$role,$date,$note])
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-7 h-7 rounded-full bg-amber-500 flex items-center justify-center text-white text-xs font-bold">{{ mb_substr($author,0,1) }}</div>
                        <div>
                            <span class="text-xs font-semibold text-slate-700">{{ $author }}</span>
                            <span class="text-xs text-slate-400 mr-1">· {{ $role }} · {{ $date }}</span>
                        </div>
                    </div>
                    <p class="text-sm text-slate-600 leading-relaxed">{{ $note }}</p>
                </div>
                @endforeach
                <div>
                    <textarea rows="2" placeholder="اكتب ملاحظة جديدة..." class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-white resize-none"></textarea>
                    <div class="flex justify-end mt-2">
                        <button class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm rounded-xl transition-colors font-medium">إضافة ملاحظة</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Right column: sidebar info (1/3) - appears on LEFT in RTL --}}
    <div class="col-span-1 space-y-4">

        {{-- Case info card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 bg-slate-50">
                <h3 class="font-semibold text-slate-800 text-sm">معلومات القضية</h3>
            </div>
            <div class="p-5 space-y-3">
                @foreach([
                    ['رقم القضية','2024/1234'],
                    ['نوع القضية','تجارية'],
                    ['المحكمة','المحكمة التجارية بالرياض'],
                    ['الدائرة','الدائرة التجارية 7'],
                    ['المدينة','الرياض'],
                    ['تاريخ البداية','01 مارس 2024'],
                    ['الجلسة القادمة','25 مايو 2026'],
                ] as [$key,$val])
                <div class="flex items-start justify-between">
                    <span class="text-xs text-slate-400">{{ $key }}</span>
                    <span class="text-xs font-medium text-slate-700 text-left max-w-36">{{ $val }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Client info card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 bg-slate-50">
                <h3 class="font-semibold text-slate-800 text-sm">بيانات العميل</h3>
            </div>
            <div class="p-5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-500 flex items-center justify-center text-white font-bold">ب</div>
                    <div>
                        <div class="font-semibold text-slate-800 text-sm">شركة البنيان للتطوير العقاري</div>
                        <div class="text-xs text-slate-400">شركة · عميل نشط</div>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        0501112233
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        info@bonian.sa
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t border-slate-100">
                    <span class="text-xs text-slate-400">عدد القضايا مع المكتب:</span>
                    <span class="font-semibold text-slate-800 mr-1">4 قضايا</span>
                </div>
            </div>
        </div>

        {{-- Lawyer card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 bg-slate-50">
                <h3 class="font-semibold text-slate-800 text-sm">المحامي المسؤول</h3>
            </div>
            <div class="p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center text-white font-bold text-sm">ع</div>
                    <div>
                        <div class="font-semibold text-slate-800 text-sm">عبدالله الرويسي</div>
                        <div class="text-xs text-slate-400">مدير المكتب · محامي</div>
                    </div>
                </div>
                <button class="w-full text-center text-xs text-amber-500 hover:text-amber-600 font-medium py-2 border border-amber-200 rounded-xl hover:bg-amber-50 transition-colors">تغيير المحامي</button>
            </div>
        </div>

        {{-- Quick actions --}}
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4">
            <h4 class="text-sm font-semibold text-amber-800 mb-3">الجلسة القادمة</h4>
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-xs text-amber-700">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    25 مايو 2026 — 10:00 صباحاً
                </div>
                <div class="flex items-center gap-2 text-xs text-amber-700">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    المحكمة التجارية بالرياض
                </div>
                <div class="flex items-center gap-2 text-xs text-amber-700">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    الدائرة التجارية 7
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Modals --}}
<div id="addSessionModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('addSessionModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">إضافة جلسة جديدة</h2>
            <button onclick="closeModal('addSessionModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        <div class="p-6 grid grid-cols-2 gap-4">
            <div class="col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-1.5">المحكمة</label>
                <input type="text" value="المحكمة التجارية بالرياض" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">الدائرة / القاضي</label>
                <input type="text" placeholder="الدائرة التجارية 7" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">تاريخ الجلسة</label>
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
            <div class="col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-1.5">ملاحظات الجلسة</label>
                <textarea rows="2" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 resize-none"></textarea>
            </div>
        </div>
        <div class="flex justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('addSessionModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl font-medium shadow-sm shadow-amber-500/30">حفظ الجلسة</button>
        </div>
    </div>
</div>

<div id="addTaskModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('addTaskModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">إضافة مهمة</h2>
            <button onclick="closeModal('addTaskModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">عنوان المهمة <span class="text-red-400">*</span></label>
                <input type="text" placeholder="وصف المهمة المطلوبة" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الموظف المسؤول</label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option>عبدالله الرويسي</option><option>سارة الحربي</option><option>محمد الغامدي</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الأولوية</label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option>منخفضة</option><option>متوسطة</option><option>عالية</option><option>عاجلة</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">تاريخ التسليم</label>
                <input type="date" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
            </div>
        </div>
        <div class="flex justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('addTaskModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl font-medium shadow-sm shadow-amber-500/30">إضافة المهمة</button>
        </div>
    </div>
</div>

<div id="uploadDocModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('uploadDocModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">رفع مستند</h2>
            <button onclick="closeModal('uploadDocModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">نوع المستند</label>
                <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                    <option value="">اختر نوع المستند</option>
                    <option>عقد</option><option>وكالة</option><option>هوية</option><option>مذكرة</option>
                    <option>حكم</option><option>إيصال</option><option>مستند قضية</option>
                </select>
            </div>
            <div class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center hover:border-amber-300 transition-colors cursor-pointer">
                <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                <p class="text-sm text-slate-500 font-medium">اسحب الملف هنا أو</p>
                <p class="text-xs text-amber-500 font-medium mt-1">انقر للاختيار</p>
                <p class="text-xs text-slate-400 mt-2">PDF, DOC, JPG — حجم أقصى 20 MB</p>
            </div>
        </div>
        <div class="flex justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('uploadDocModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl font-medium shadow-sm shadow-amber-500/30">رفع المستند</button>
        </div>
    </div>
</div>

<div id="changeStatusModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('changeStatusModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">تغيير حالة القضية</h2>
            <button onclick="closeModal('changeStatusModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        <div class="p-6 space-y-3">
            @foreach(['جديدة'=>'blue','تحت الدراسة'=>'slate','قيد التنفيذ'=>'amber','بانتظار جلسة'=>'purple','مغلقة'=>'green','مؤرشفة'=>'gray'] as $s=>$c)
            <label class="flex items-center gap-3 p-3 border border-slate-100 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors {{ $s==='قيد التنفيذ' ? 'border-amber-200 bg-amber-50' : '' }}">
                <input type="radio" name="newStatus" value="{{ $s }}" {{ $s==='قيد التنفيذ' ? 'checked' : '' }} class="accent-amber-500">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $c }}-100 text-{{ $c }}-700">{{ $s }}</span>
            </label>
            @endforeach
        </div>
        <div class="flex justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('changeStatusModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl font-medium">حفظ الحالة</button>
        </div>
    </div>
</div>

@endsection
