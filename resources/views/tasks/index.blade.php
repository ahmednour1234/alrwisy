@extends('layouts.app')
@section('title','المهام')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-bold text-slate-800">إدارة المهام</h1>
        <p class="text-sm text-slate-500 mt-0.5">تتبع وإدارة مهام الفريق القانوني</p>
    </div>
    <div class="flex items-center gap-2">
        {{-- View toggle --}}
        <div class="bg-slate-100 rounded-xl p-1 flex items-center gap-1">
            <button data-tab-btn="kanbanView" data-tab-btn-group="tasks"
                    onclick="switchTab('tasks','kanbanView')"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors bg-white text-slate-800 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/></svg>
                كانبان
            </button>
            <button data-tab-btn="tableView" data-tab-btn-group="tasks"
                    onclick="switchTab('tasks','tableView')"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors text-slate-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                جدول
            </button>
        </div>
        <button onclick="openModal('addTaskModal')"
                class="flex items-center gap-2 px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-xl transition-colors shadow-sm shadow-amber-500/30">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            إضافة مهمة
        </button>
    </div>
</div>

{{-- Filters --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-5">
    <div class="flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-48">
            <svg class="w-4 h-4 text-slate-400 absolute top-2.5 right-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="search" placeholder="البحث في المهام..." class="w-full pr-9 pl-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
        </div>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">جميع الموظفين</option>
            <option>عبدالله الرويسي</option><option>سارة الحربي</option><option>محمد الغامدي</option>
        </select>
        <select class="px-3 py-2 border border-slate-200 rounded-xl text-sm text-slate-600 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <option value="">جميع الأولويات</option>
            <option>منخفضة</option><option>متوسطة</option><option>عالية</option><option>عاجلة</option>
        </select>
    </div>
</div>

{{-- ═══ KANBAN VIEW ═══ --}}
@php
$kanbanCols = [
    ['جديدة','blue',4,[
        ['مراسلة العميل بالتحديثات','قضية الفارس','نورة الزهراني','منخفضة','slate','22 مايو'],
        ['مراجعة لائحة الدعوى','قضية الشمري','محمد الغامدي','متوسطة','blue','20 مايو'],
        ['التواصل مع خبير التقييم','قضية البنيان','عبدالله الرويسي','متوسطة','blue','20 مايو'],
        ['رفع طلب استئناف','قضية القحطاني','عبدالله الرويسي','عالية','amber','18 مايو'],
    ]],
    ['جاري العمل','amber',5,[
        ['تحضير مذكرة الدفاع','قضية العتيبي','محمد الغامدي','عالية','amber','14 مايو'],
        ['مراجعة عقد الشراكة','قضية البنيان','سارة الحربي','عاجلة','red','12 مايو'],
        ['إعداد تقرير المحاسب','قضية الفارس','فيصل العنزي','متوسطة','blue','15 مايو'],
        ['مراجعة المستندات المقدّمة','قضية الزهراني','سارة الحربي','عالية','amber','13 مايو'],
        ['إعداد رسالة مطالبة','قضية النخيل','محمد الغامدي','متوسطة','blue','16 مايو'],
    ]],
    ['مكتملة','green',8,[
        ['رفع لائحة الدعوى','قضية البنيان','عبدالله الرويسي','عالية','amber','01 مايو'],
        ['التواصل مع المحكمة','قضية العتيبي','نورة الزهراني','متوسطة','blue','05 مايو'],
        ['إيداع المستندات','قضية الشمري','ريم السلمي','منخفضة','slate','03 مايو'],
    ]],
    ['متأخرة','red',3,[
        ['تسليم مذكرة الاستئناف','قضية الفارس','سارة الحربي','عاجلة','red','08 مايو'],
        ['متابعة طلب التأشيرة','معاملة إنجاز','ريم السلمي','عالية','amber','07 مايو'],
        ['رد على مذكرة الخصم','قضية البنيان','محمد الغامدي','عاجلة','red','06 مايو'],
    ]],
];
@endphp

<div id="kanbanView" data-tab-group="tasks" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
    @foreach($kanbanCols as $colIndex => [$colTitle,$colColor,$count,$tasks])
    @php $colId = 'col-'.$colIndex; @endphp
    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200 kanban-col" id="{{ $colId }}">
        <div class="flex items-center gap-2 mb-4">
            <div class="w-2.5 h-2.5 rounded-full bg-{{ $colColor }}-400 flex-shrink-0 {{ $colColor==='green'?'animate-pulse':'' }}"></div>
            <span class="font-semibold text-slate-700 text-sm">{{ $colTitle }}</span>
            <span class="col-count bg-slate-200 text-slate-600 text-xs font-medium px-2 py-0.5 rounded-full">{{ count($tasks) }}</span>
        </div>
        {{-- Drop zone --}}
        <div class="space-y-3 min-h-16 kanban-drop-zone rounded-xl transition-all"
             ondragover="dragOver(event)"
             ondragleave="dragLeave(event)"
             ondrop="drop(event)"
             data-col="{{ $colId }}">
            @foreach($tasks as $taskIndex => [$title,$case,$assignee,$priority,$pColor,$due])
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100 hover:shadow-md transition-all cursor-grab active:cursor-grabbing kanban-card select-none"
                 draggable="true"
                 ondragstart="dragStart(event)"
                 ondragend="dragEnd(event)">
                <div class="flex items-start justify-between mb-2">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-{{ $pColor }}-100 text-{{ $pColor }}-700">{{ $priority }}</span>
                    <button class="text-slate-300 hover:text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                    </button>
                </div>
                <h4 class="text-sm font-semibold text-slate-800 mb-1 leading-snug">{{ $title }}</h4>
                <p class="text-xs text-slate-400 mb-3">{{ $case }}</p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-1.5">
                        <div class="w-6 h-6 rounded-full bg-slate-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">{{ mb_substr($assignee,0,1) }}</div>
                        <span class="text-xs text-slate-500">{{ mb_substr($assignee,0,5) }}...</span>
                    </div>
                    <span class="text-xs {{ $colColor==='red' ? 'text-red-500 font-medium' : 'text-slate-400' }}">{{ $due }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <button onclick="openModal('addTaskModal')" class="w-full mt-3 py-2 border border-dashed border-slate-300 rounded-xl text-xs text-slate-400 hover:border-slate-500 hover:text-slate-600 transition-colors flex items-center justify-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            إضافة مهمة
        </button>
    </div>
    @endforeach
</div>

{{-- ═══ TABLE VIEW ═══ --}}
@php
$allTasks = [
    ['تحضير مذكرة الدفاع','قضية العتيبي','محمد الغامدي','عالية','amber','14 مايو','جاري العمل','amber'],
    ['مراجعة عقد الشراكة','قضية البنيان','سارة الحربي','عاجلة','red','12 مايو','متأخرة','red'],
    ['رفع طلب استئناف','قضية القحطاني','عبدالله الرويسي','عالية','amber','18 مايو','جديدة','blue'],
    ['مراسلة العميل','قضية الفارس','نورة الزهراني','منخفضة','slate','22 مايو','جديدة','blue'],
    ['إعداد تقرير المحاسب','قضية الفارس','فيصل العنزي','متوسطة','blue','15 مايو','جاري العمل','amber'],
    ['رفع لائحة الدعوى','قضية البنيان','عبدالله الرويسي','عالية','amber','01 مايو','مكتملة','green'],
    ['تسليم مذكرة الاستئناف','قضية الفارس','سارة الحربي','عاجلة','red','08 مايو','متأخرة','red'],
    ['متابعة طلب التأشيرة','معاملة إنجاز','ريم السلمي','عالية','amber','07 مايو','متأخرة','red'],
];
@endphp

<div id="tableView" data-tab-group="tasks" class="hidden bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">عنوان المهمة</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">القضية المرتبطة</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">الموظف المسؤول</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">الأولوية</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">تاريخ التسليم</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">الحالة</th>
                    <th class="px-5 py-3.5 text-right text-xs font-medium text-slate-500">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($allTasks as [$title,$case,$assignee,$priority,$pColor,$due,$status,$sColor])
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-5 py-4 font-medium text-slate-800 text-sm">{{ $title }}</td>
                    <td class="px-5 py-4 text-sm text-slate-500">{{ $case }}</td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-amber-500 flex items-center justify-center text-white text-xs font-bold">{{ mb_substr($assignee,0,1) }}</div>
                            <span class="text-sm text-slate-600">{{ $assignee }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $pColor }}-100 text-{{ $pColor }}-700">{{ $priority }}</span>
                    </td>
                    <td class="px-5 py-4 text-sm text-slate-500">{{ $due }}</td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $sColor }}-100 text-{{ $sColor }}-700">{{ $status }}</span>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-1">
                            <button onclick="openModal('editTaskModal')" class="p-1.5 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                            <button class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Add Task Modal --}}
<div id="addTaskModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('addTaskModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">إضافة مهمة جديدة</h2>
            <button onclick="closeModal('addTaskModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">عنوان المهمة <span class="text-red-400">*</span></label>
                <input type="text" placeholder="وصف المهمة المطلوبة" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">القضية المرتبطة</label>
                <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                    <option value="">بدون قضية</option>
                    <option>2024/1234 — نزاع عقد توريد</option>
                    <option>2024/5678 — مطالبة عمالية</option>
                    <option>معاملة إنجاز</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الموظف المسؤول</label>
                    <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                        <option>عبدالله الرويسي</option><option>سارة الحربي</option>
                        <option>محمد الغامدي</option><option>نورة الزهراني</option>
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

<div id="editTaskModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('editTaskModal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">تعديل المهمة</h2>
            <button onclick="closeModal('editTaskModal')" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">عنوان المهمة</label>
                <input type="text" value="مراجعة عقد الشراكة" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">الحالة</label>
                <select class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 bg-slate-50 text-slate-600">
                    <option>جديدة</option><option>جاري العمل</option><option>مكتملة</option><option>متأخرة</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
            <button onclick="closeModal('editTaskModal')" class="px-4 py-2 text-sm text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-100">إلغاء</button>
            <button class="px-5 py-2 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-xl font-medium">حفظ</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// ── Kanban Drag & Drop ──────────────────────────────────────────
let draggedCard = null;

function dragStart(e) {
    draggedCard = e.currentTarget;
    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('text/plain', '');
    // Delay so the browser renders the drag ghost before we fade the original
    requestAnimationFrame(() => {
        draggedCard.classList.add('opacity-30', 'scale-95', 'shadow-none');
    });
}

function dragEnd(e) {
    if (draggedCard) {
        draggedCard.classList.remove('opacity-30', 'scale-95', 'shadow-none');
        draggedCard = null;
    }
    // Clear all drop-zone highlights
    document.querySelectorAll('.kanban-drop-zone').forEach(z => clearHighlight(z));
}

function dragOver(e) {
    e.preventDefault();
    e.dataTransfer.dropEffect = 'move';
    const zone = e.currentTarget;
    zone.classList.add('bg-slate-200', 'ring-2', 'ring-slate-400', 'ring-inset', 'rounded-xl');
    // Show insert indicator line
    const afterEl = getDragAfterElement(zone, e.clientY);
    // Remove old placeholder
    const placeholder = zone.querySelector('.drop-placeholder');
    if (placeholder) placeholder.remove();
    const ph = document.createElement('div');
    ph.className = 'drop-placeholder h-1 bg-slate-400 rounded-full mx-1 my-1';
    if (afterEl) zone.insertBefore(ph, afterEl);
    else zone.appendChild(ph);
}

function dragLeave(e) {
    // Only fire when truly leaving the zone (not entering a child element)
    if (!e.currentTarget.contains(e.relatedTarget)) {
        clearHighlight(e.currentTarget);
    }
}

function drop(e) {
    e.preventDefault();
    const zone = e.currentTarget;
    clearHighlight(zone);

    if (!draggedCard) return;

    const fromZone = draggedCard.parentElement;
    if (zone === fromZone && !zone.querySelector('.drop-placeholder')) {
        draggedCard.classList.remove('opacity-30','scale-95','shadow-none');
        draggedCard = null;
        return;
    }

    // Insert card at the right position
    const afterEl = getDragAfterElement(zone, e.clientY);
    if (afterEl) zone.insertBefore(draggedCard, afterEl);
    else zone.appendChild(draggedCard);

    draggedCard.classList.remove('opacity-30', 'scale-95', 'shadow-none');

    // Update all column counters
    updateCounts();

    // Toast notification
    const colTitle = zone.closest('.kanban-col').querySelector('span.font-semibold').textContent.trim();
    showToast('تم نقل المهمة إلى: ' + colTitle);

    draggedCard = null;
}

function clearHighlight(zone) {
    zone.classList.remove('bg-slate-200', 'ring-2', 'ring-slate-400', 'ring-inset');
    const ph = zone.querySelector('.drop-placeholder');
    if (ph) ph.remove();
}

function getDragAfterElement(zone, y) {
    const cards = [...zone.querySelectorAll('.kanban-card:not(.opacity-30)')];
    let closest = null;
    let closestOffset = Number.NEGATIVE_INFINITY;
    for (const card of cards) {
        const rect = card.getBoundingClientRect();
        const offset = y - rect.top - rect.height / 2;
        if (offset < 0 && offset > closestOffset) {
            closestOffset = offset;
            closest = card;
        }
    }
    return closest;
}

function updateCounts() {
    document.querySelectorAll('.kanban-col').forEach(col => {
        const count = col.querySelectorAll('.kanban-card').length;
        col.querySelector('.col-count').textContent = count;
    });
}

function showToast(msg) {
    // Remove existing toast
    document.querySelectorAll('.kanban-toast').forEach(t => t.remove());
    const toast = document.createElement('div');
    toast.className = 'kanban-toast fixed bottom-6 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-sm px-5 py-3 rounded-xl shadow-xl z-[300] flex items-center gap-2 transition-opacity duration-300';
    toast.innerHTML = `<svg class="w-4 h-4 text-green-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>${msg}`;
    document.body.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 2200);
}

// Prevent text selection during drag
document.addEventListener('selectstart', function(e) {
    if (draggedCard) e.preventDefault();
});
</script>
@endpush
