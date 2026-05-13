@extends('layouts.app')
@section('title','لوحة التحكم')

@section('content')

{{-- ═══════ Page Header ═══════ --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-bold text-slate-800">لوحة التحكم</h1>
        <p class="text-sm text-slate-500 mt-0.5">مرحباً بك، عبدالله — الأربعاء 13 مايو 2026</p>
    </div>
    <div class="flex items-center gap-2">
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 text-green-600 rounded-xl text-xs font-medium border border-green-100">
            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
            النظام يعمل بكفاءة
        </span>
    </div>
</div>

{{-- ═══════ Stats Cards ═══════ --}}
@php
$stats = [
    ['label'=>'إجمالي القضايا',             'value'=>'127', 'icon'=>'briefcase', 'color'=>'blue',   'bg'=>'bg-blue-50',   'text'=>'text-blue-500',   'change'=>'+8%'],
    ['label'=>'القضايا المفتوحة',           'value'=>'43',  'icon'=>'folder',    'color'=>'amber',  'bg'=>'bg-amber-50',  'text'=>'text-amber-500',  'change'=>'+3%'],
    ['label'=>'القضايا المغلقة',            'value'=>'84',  'icon'=>'check',     'color'=>'green',  'bg'=>'bg-green-50',  'text'=>'text-green-500',  'change'=>'+12%'],
    ['label'=>'جلسات اليوم',               'value'=>'5',   'icon'=>'calendar',  'color'=>'purple', 'bg'=>'bg-purple-50', 'text'=>'text-purple-500', 'change'=>'اليوم'],
    ['label'=>'المهام المتأخرة',            'value'=>'12',  'icon'=>'warning',   'color'=>'red',    'bg'=>'bg-red-50',    'text'=>'text-red-500',    'change'=>'-2'],
    ['label'=>'معاملات إنجاز قيد التنفيذ', 'value'=>'28',  'icon'=>'document',  'color'=>'slate',  'bg'=>'bg-slate-100', 'text'=>'text-slate-500',  'change'=>'+5%'],
    ['label'=>'عدد العملاء',               'value'=>'96',  'icon'=>'users',     'color'=>'teal',   'bg'=>'bg-teal-50',   'text'=>'text-teal-500',   'change'=>'+4%'],
    ['label'=>'عدد الموظفين',              'value'=>'11',  'icon'=>'team',      'color'=>'indigo', 'bg'=>'bg-indigo-50', 'text'=>'text-indigo-500', 'change'=>'ثابت'],
];
@endphp

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @foreach($stats as $stat)
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="{{ $stat['bg'] }} w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0">
                @if($stat['icon']==='briefcase')
                <svg class="w-5 h-5 {{ $stat['text'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                @elseif($stat['icon']==='folder')
                <svg class="w-5 h-5 {{ $stat['text'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/></svg>
                @elseif($stat['icon']==='check')
                <svg class="w-5 h-5 {{ $stat['text'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                @elseif($stat['icon']==='calendar')
                <svg class="w-5 h-5 {{ $stat['text'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                @elseif($stat['icon']==='warning')
                <svg class="w-5 h-5 {{ $stat['text'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                @elseif($stat['icon']==='document')
                <svg class="w-5 h-5 {{ $stat['text'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                @elseif($stat['icon']==='users')
                <svg class="w-5 h-5 {{ $stat['text'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                @else
                <svg class="w-5 h-5 {{ $stat['text'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                @endif
            </div>
            <span class="text-xs text-slate-400 bg-slate-50 px-2 py-0.5 rounded-full">{{ $stat['change'] }}</span>
        </div>
        <div class="text-2xl font-bold text-slate-800">{{ $stat['value'] }}</div>
        <div class="text-xs text-slate-500 mt-0.5 font-medium">{{ $stat['label'] }}</div>
    </div>
    @endforeach
</div>

{{-- ═══════ Recent Data Tables ═══════ --}}
<div class="grid grid-cols-1 xl:grid-cols-2 gap-5">

    {{-- Recent Cases --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h3 class="font-semibold text-slate-800 text-sm">آخر القضايا المضافة</h3>
            <a href="/cases" class="text-xs text-amber-500 hover:text-amber-600 font-medium">عرض الكل ←</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-5 py-3 text-right text-xs text-slate-400 font-medium">رقم القضية</th>
                        <th class="px-5 py-3 text-right text-xs text-slate-400 font-medium">العميل</th>
                        <th class="px-5 py-3 text-right text-xs text-slate-400 font-medium">النوع</th>
                        <th class="px-5 py-3 text-right text-xs text-slate-400 font-medium">الحالة</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach([
                        ['2024/1234','شركة البنيان','تجارية','قيد التنفيذ','amber'],
                        ['2024/5678','أحمد العتيبي','عمالية','جديدة','blue'],
                        ['2024/9012','مجموعة الفارس','أحوال شخصية','بانتظار جلسة','purple'],
                        ['2024/3456','خالد الشمري','إدارية','تحت الدراسة','slate'],
                        ['2024/7890','شركة النخيل','عقارية','مغلقة','green'],
                    ] as [$num,$client,$type,$status,$color])
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3 text-slate-500 font-mono text-xs">{{ $num }}</td>
                        <td class="px-5 py-3 font-medium text-slate-700 text-xs">{{ $client }}</td>
                        <td class="px-5 py-3 text-slate-500 text-xs">{{ $type }}</td>
                        <td class="px-5 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                bg-{{ $color }}-100 text-{{ $color }}-700">{{ $status }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- This Week's Sessions --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h3 class="font-semibold text-slate-800 text-sm">جلسات هذا الأسبوع</h3>
            <a href="/court-sessions" class="text-xs text-amber-500 hover:text-amber-600 font-medium">عرض الكل ←</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-5 py-3 text-right text-xs text-slate-400 font-medium">القضية</th>
                        <th class="px-5 py-3 text-right text-xs text-slate-400 font-medium">المحكمة</th>
                        <th class="px-5 py-3 text-right text-xs text-slate-400 font-medium">التاريخ</th>
                        <th class="px-5 py-3 text-right text-xs text-slate-400 font-medium">الحالة</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach([
                        ['قضية البنيان','تجارية الرياض','13 مايو','مجدولة','blue'],
                        ['قضية العتيبي','عمالية الرياض','14 مايو','مجدولة','blue'],
                        ['قضية الفارس','أحوال جدة','15 مايو','مجدولة','blue'],
                        ['قضية الشمري','إدارية الرياض','11 مايو','تمت','green'],
                        ['قضية النخيل','تجارية الدمام','10 مايو','مؤجلة','amber'],
                    ] as [$case,$court,$date,$status,$color])
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3 font-medium text-slate-700 text-xs">{{ $case }}</td>
                        <td class="px-5 py-3 text-slate-500 text-xs">{{ $court }}</td>
                        <td class="px-5 py-3 text-slate-500 text-xs">{{ $date }}</td>
                        <td class="px-5 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                bg-{{ $color }}-100 text-{{ $color }}-700">{{ $status }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Urgent Tasks --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h3 class="font-semibold text-slate-800 text-sm">المهام العاجلة</h3>
            <a href="/tasks" class="text-xs text-amber-500 hover:text-amber-600 font-medium">عرض الكل ←</a>
        </div>
        <div class="divide-y divide-slate-50">
            @foreach([
                ['مراجعة عقد الشراكة — البنيان','سارة الحربي','10 مايو','متأخرة','red'],
                ['تحضير مذكرة الدفاع — العتيبي','محمد الغامدي','14 مايو','عاجلة','red'],
                ['رفع طلب استئناف — الشمري','عبدالله الرويسي','16 مايو','عالية','amber'],
                ['مراسلة العميل — الفارس','سارة الحربي','18 مايو','متوسطة','blue'],
            ] as [$task,$assignee,$due,$priority,$color])
            <div class="px-5 py-3 flex items-center justify-between hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-8 rounded-full bg-{{ $color }}-400 flex-shrink-0"></div>
                    <div>
                        <p class="text-xs font-medium text-slate-700">{{ $task }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $assignee }} · {{ $due }}</p>
                    </div>
                </div>
                <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-{{ $color }}-100 text-{{ $color }}-700 flex-shrink-0">{{ $priority }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Recent Enjaz --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h3 class="font-semibold text-slate-800 text-sm">معاملات إنجاز الحديثة</h3>
            <a href="/enjaz" class="text-xs text-amber-500 hover:text-amber-600 font-medium">عرض الكل ←</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-5 py-3 text-right text-xs text-slate-400 font-medium">العميل</th>
                        <th class="px-5 py-3 text-right text-xs text-slate-400 font-medium">الخدمة</th>
                        <th class="px-5 py-3 text-right text-xs text-slate-400 font-medium">المنصة</th>
                        <th class="px-5 py-3 text-right text-xs text-slate-400 font-medium">الحالة</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach([
                        ['شركة البنيان','تأشيرة عمل','إنجاز','تحت الإجراء','amber'],
                        ['أحمد العتيبي','تصديق','ناجز','مكتمل','green'],
                        ['مجموعة الفارس','تفويض رسمي','أبشر أعمال','بانتظار مستندات','orange'],
                        ['خالد الشمري','خدمات مقيم','إنجاز','جديد','blue'],
                        ['شركة النخيل','وزارة العدل','ناجز','مكتمل','green'],
                    ] as [$client,$service,$platform,$status,$color])
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3 font-medium text-slate-700 text-xs">{{ $client }}</td>
                        <td class="px-5 py-3 text-slate-500 text-xs">{{ $service }}</td>
                        <td class="px-5 py-3 text-slate-400 text-xs">{{ $platform }}</td>
                        <td class="px-5 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                bg-{{ $color }}-100 text-{{ $color }}-700">{{ $status }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
