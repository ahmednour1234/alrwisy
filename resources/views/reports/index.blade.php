@extends('layouts.app')
@section('title','التقارير والإحصاءات')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-bold text-slate-800">التقارير والإحصاءات</h1>
        <p class="text-sm text-slate-500 mt-0.5">نظرة شاملة على أداء المكتب والإحصاءات التفصيلية</p>
    </div>
    <div class="flex items-center gap-3">
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-white focus:outline-none focus:ring-2 focus:ring-slate-400">
            <option>هذا الشهر</option>
            <option>الشهر الماضي</option>
            <option>آخر 3 أشهر</option>
            <option>هذا العام</option>
        </select>
        <button class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            تصدير PDF
        </button>
    </div>
</div>

{{-- KPI Cards --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @foreach([
        ['إجمالي القضايا','127','↑ 12 هذا الشهر','blue','M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
        ['الإيرادات','187,500 ر.س','↑ 8% عن الشهر','green','M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['الجلسات','170','25 جلسة هذا الشهر','slate','M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['العملاء الجدد','8','هذا الشهر','purple','M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
    ] as [$label,$val,$sub,$color,$icon])
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-start gap-4">
        <div class="w-11 h-11 bg-{{ $color }}-100 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 text-{{ $color }}-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/></svg>
        </div>
        <div class="flex-1 min-w-0">
            <div class="text-xl font-bold text-slate-800">{{ $val }}</div>
            <div class="text-xs text-slate-500 mt-0.5">{{ $label }}</div>
            <div class="text-xs text-green-500 font-medium mt-1">{{ $sub }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- Charts row 1 --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-5">
    {{-- Cases by status - doughnut --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <h3 class="text-sm font-bold text-slate-700 mb-4">القضايا حسب الحالة</h3>
        <div class="flex justify-center mb-4" style="height:260px">
            <canvas id="casesByStatusChart"></canvas>
        </div>
        <div class="grid grid-cols-2 gap-1">
            @foreach(['قيد التنفيذ'=>'slate','جديدة'=>'slate','بانتظار جلسة'=>'slate','تحت الدراسة'=>'slate','مغلقة'=>'slate','مؤرشفة'=>'slate'] as $label=>$c)
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <span class="w-2 h-2 rounded-full bg-{{ $c }}-400 shrink-0"></span>{{ $label }}
            </div>
            @endforeach
        </div>
    </div>

    {{-- Cases by lawyer - bar --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 lg:col-span-2">
        <h3 class="text-sm font-bold text-slate-700 mb-4">القضايا حسب المحامي</h3>
        <div style="height:260px"><canvas id="casesByLawyerChart"></canvas></div>
    </div>
</div>

{{-- Charts row 2 --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">
    {{-- Revenue line chart --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-bold text-slate-700">تقرير الإيرادات الشهرية</h3>
            <span class="text-xs text-slate-400">ر.س</span>
        </div>
        <div style="height:280px"><canvas id="revenueChart"></canvas></div>
    </div>

    {{-- Enjaz status - horizontal bar --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <h3 class="text-sm font-bold text-slate-700 mb-4">معاملات إنجاز حسب النوع</h3>
        <div style="height:280px"><canvas id="enjazChart"></canvas></div>
    </div>
</div>

{{-- Bottom row: tasks + upcoming sessions tables --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
    {{-- Late tasks --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h3 class="text-sm font-bold text-slate-700">المهام المتأخرة</h3>
            <a href="/tasks" class="text-xs text-slate-500 hover:text-slate-700 font-medium">عرض الكل ←</a>
        </div>
        <div class="divide-y divide-slate-50">
            @foreach([
                ['مراجعة عقد التوريد','عبدالله الرويسي','20/02/2024','عالية'],
                ['إعداد مذكرة الاستئناف','سارة الحربي','25/02/2024','عالية'],
                ['متابعة قضية العمالة','محمد الغامدي','01/03/2024','متوسطة'],
                ['استلام وثائق موكل','ريم السلمي','05/03/2024','منخفضة'],
            ] as [$task,$assigned,$due,$priority])
            <div class="flex items-center justify-between px-5 py-3">
                <div>
                    <p class="text-sm text-slate-700 font-medium">{{ $task }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $assigned }} · استحق {{ $due }}</p>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $priority==='عالية'?'bg-red-100 text-red-700':($priority==='متوسطة'?'bg-slate-200 text-slate-700':'bg-slate-100 text-slate-600') }}">{{ $priority }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Upcoming sessions --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h3 class="text-sm font-bold text-slate-700">جلسات هذا الأسبوع</h3>
            <a href="/court-sessions" class="text-xs text-slate-500 hover:text-slate-700 font-medium">عرض الكل ←</a>
        </div>
        <div class="divide-y divide-slate-50">
            @foreach([
                ['نزاع عقد توريد','المحكمة التجارية بالرياض','10/04/2024','09:00','مجدولة'],
                ['قضية فصل تعسفي','المحكمة العمالية بالرياض','10/04/2024','11:00','مجدولة'],
                ['طلب خلع','محكمة الأحوال الشخصية','11/04/2024','10:00','مجدولة'],
                ['نزاع عقار','المحكمة التجارية بالدمام','12/04/2024','14:00','مجدولة'],
            ] as [$case,$court,$date,$time,$status])
            <div class="flex items-center justify-between px-5 py-3">
                <div>
                    <p class="text-sm text-slate-700 font-medium">{{ $case }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $court }} · {{ $date }} الساعة {{ $time }}</p>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700">{{ $status }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script>
Chart.defaults.font.family = "'Noto Kufi Arabic', ui-sans-serif, system-ui, sans-serif";

// Cases by Status - Doughnut
new Chart(document.getElementById('casesByStatusChart'), {
    type: 'doughnut',
    data: {
        labels: ['قيد التنفيذ','جديدة','بانتظار جلسة','تحت الدراسة','مغلقة','مؤرشفة'],
        datasets: [{
            data: [38, 15, 22, 8, 30, 14],
            backgroundColor: ['#64748b','#94a3b8','#475569','#cbd5e1','#334155','#e2e8f0'],
            borderWidth: 0,
            hoverOffset: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '65%',
        plugins: { legend: { display: false } }
    }
});

// Cases by Lawyer - Bar
new Chart(document.getElementById('casesByLawyerChart'), {
    type: 'bar',
    data: {
        labels: ['عبدالله الرويسي','سارة الحربي','محمد الغامدي','ريم السلمي','نورة الزهراني'],
        datasets: [{
            label: 'القضايا النشطة',
            data: [34, 28, 22, 15, 12],
            backgroundColor: '#64748b',
            borderRadius: 8,
            borderSkipped: false,
        },{
            label: 'القضايا المغلقة',
            data: [18, 22, 14, 10, 8],
            backgroundColor: '#e2e8f0',
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'top', rtl: true, labels: { boxWidth: 10, font: { size: 11 } } } },
        scales: {
            x: { grid: { display: false }, ticks: { font: { size: 11 } } },
            y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 11 } } }
        }
    }
});

// Revenue - Line
new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
        labels: ['يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر','يناير','فبراير','مارس','أبريل'],
        datasets: [{
            label: 'الإيرادات',
            data: [120000, 145000, 98000, 175000, 160000, 210000, 135000, 155000, 168000, 187500],
            borderColor: '#475569',
            backgroundColor: 'rgba(71,85,105,0.08)',
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#475569',
            pointRadius: 4,
            pointHoverRadius: 6,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, ticks: { font: { size: 10 } } },
            y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 10 }, callback: v => (v/1000)+'K' } }
        }
    }
});

// Enjaz by type - Horizontal bar
new Chart(document.getElementById('enjazChart'), {
    type: 'bar',
    data: {
        labels: ['تأشيرات','خدمات مقيم','خدمات ناجز','تصديق','تفويض','طلب زيارة','خدمات قوى','أبشر أعمال'],
        datasets: [{
            label: 'عدد المعاملات',
            data: [20, 14, 10, 8, 7, 5, 4, 3],
            backgroundColor: '#94a3b8',
            borderRadius: 6,
            borderSkipped: false,
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 11 } } },
            y: { grid: { display: false }, ticks: { font: { size: 11 } } }
        }
    }
});
</script>
@endpush
