<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم') — ميزان</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-slate-100 antialiased">

    <!-- Mobile sidebar overlay -->
    <div id="sidebarOverlay" onclick="closeSidebar()"
         class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"></div>

    <!-- ═══════ SIDEBAR (RTL → fixed to the RIGHT) ═══════ -->
    <aside id="sidebar"
           class="fixed top-0 right-0 bottom-0 w-64 bg-slate-900 z-40 flex flex-col
                  transition-transform duration-300 lg:translate-x-0">

        <!-- Logo -->
        <div class="flex items-center gap-3 px-5 py-5 border-b border-slate-700/50 flex-shrink-0">
            <div class="w-11 h-11 bg-slate-700 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002
                             5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                </svg>
            </div>
            <div class="overflow-hidden">
                <div class="text-white font-bold text-base leading-tight">ميزان</div>
                <div class="text-slate-400 text-xs leading-tight truncate">مكتب الرويسي للمحاماة</div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
            @php
            $navLinks = [
                ['href'=>'/dashboard',      'label'=>'لوحة التحكم',       'match'=>'dashboard',        'icon'=>'home'],
                ['href'=>'/employees',      'label'=>'الموظفين',           'match'=>'employees*',       'icon'=>'users'],
                ['href'=>'/clients',        'label'=>'العملاء',            'match'=>'clients*',         'icon'=>'user'],
                ['href'=>'/cases',          'label'=>'القضايا',            'match'=>'cases*',           'icon'=>'briefcase'],
                ['href'=>'/court-sessions', 'label'=>'الجلسات',           'match'=>'court-sessions*',  'icon'=>'calendar'],
                ['href'=>'/tasks',          'label'=>'المهام',             'match'=>'tasks*',           'icon'=>'check'],
                ['href'=>'/enjaz',          'label'=>'معاملات إنجاز',     'match'=>'enjaz*',           'icon'=>'document'],
                ['href'=>'/documents',      'label'=>'أرشيف المستندات',   'match'=>'documents*',       'icon'=>'archive'],
                ['href'=>'/reports',        'label'=>'التقارير',           'match'=>'reports*',         'icon'=>'chart'],
                ['href'=>'/settings',       'label'=>'الإعدادات',          'match'=>'settings*',        'icon'=>'settings'],
            ];
            @endphp

            @foreach($navLinks as $nav)
                @php $active = request()->is($nav['match']); @endphp
                <a href="{{ $nav['href'] }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                          {{ $active ? 'bg-white/10 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">

                    @if($nav['icon']==='home')
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    @elseif($nav['icon']==='users')
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    @elseif($nav['icon']==='user')
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    @elseif($nav['icon']==='briefcase')
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    @elseif($nav['icon']==='calendar')
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    @elseif($nav['icon']==='check')
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    @elseif($nav['icon']==='document')
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    @elseif($nav['icon']==='archive')
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                    @elseif($nav['icon']==='chart')
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    @elseif($nav['icon']==='settings')
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    @endif
                    <span>{{ $nav['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <!-- User info at bottom -->
        <div class="border-t border-slate-700/50 px-4 py-4 flex-shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-slate-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">ع</div>
                <div class="flex-1 min-w-0">
                    <div class="text-white text-sm font-semibold truncate">عبدالله الرويسي</div>
                    <div class="text-slate-400 text-xs truncate">مدير المكتب</div>
                </div>
                <a href="/" class="text-slate-400 hover:text-red-400 transition-colors" title="تسجيل الخروج">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </a>
            </div>
        </div>
    </aside>

    <!-- ═══════ MAIN AREA (offset right by sidebar width) ═══════ -->
    <div class="mr-64 min-h-screen flex flex-col">

        <!-- Top Navbar -->
        <header class="bg-white border-b border-slate-200 sticky top-0 z-30 h-16 flex items-center justify-between px-6">
            <!-- Right side: hamburger + search -->
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="relative hidden sm:block">
                    <svg class="w-4 h-4 text-slate-400 absolute top-2.5 right-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="search" placeholder="البحث في النظام..."
                           class="pr-9 pl-4 py-2 bg-slate-100 rounded-xl text-sm text-slate-700 w-72
                                  focus:outline-none focus:ring-2 focus:ring-slate-400 focus:bg-white
                                  transition-all placeholder-slate-400">
                </div>
            </div>

            <!-- Left side: notifications + user -->
            <div class="flex items-center gap-2">

                <!-- ── NOTIFICATIONS ── -->
                <div class="relative" id="notifWrapper">
                    <button onclick="toggleNotif(event)" id="notifBtn"
                            class="relative p-2 rounded-xl text-slate-500 hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span id="notifBadge" class="absolute top-1 right-1 min-w-[18px] h-[18px] px-1 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center border-2 border-white">5</span>
                    </button>

                    <!-- Dropdown panel (fixed so it escapes header stacking context) -->
                    <div id="notifPanel"
                         class="hidden fixed top-16 left-4 w-96 bg-white rounded-2xl shadow-2xl border border-slate-100 z-[200] overflow-hidden">
                        <!-- Header -->
                        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-bold text-slate-800">الإشعارات</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-600">5 جديد</span>
                            </div>
                            <button onclick="markAllRead()" class="text-xs text-slate-400 hover:text-slate-600 transition-colors">تحديد الكل كمقروء</button>
                        </div>

                        <!-- Notification items -->
                        <div class="divide-y divide-slate-50 max-h-96 overflow-y-auto" id="notifList">

                            <div class="notif-item flex gap-3 px-5 py-3.5 hover:bg-slate-50 cursor-pointer bg-blue-50/40 transition-colors" data-unread="1">
                                <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-slate-800">معاملة إنجاز مكتملة</p>
                                    <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">تم إتمام معاملة تصديق وثيقة للعميل أحمد العتيبي بنجاح عبر منصة ناجز</p>
                                    <p class="text-xs text-slate-400 mt-1">منذ 8 دقائق</p>
                                </div>
                                <span class="w-2 h-2 bg-blue-500 rounded-full mt-2 shrink-0"></span>
                            </div>

                            <div class="notif-item flex gap-3 px-5 py-3.5 hover:bg-slate-50 cursor-pointer bg-blue-50/40 transition-colors" data-unread="1">
                                <div class="w-9 h-9 rounded-xl bg-red-50 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-slate-800">جلسة قضائية غداً</p>
                                    <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">جلسة قضية نزاع عقد توريد — المحكمة التجارية بالرياض الساعة 09:00</p>
                                    <p class="text-xs text-slate-400 mt-1">منذ 25 دقيقة</p>
                                </div>
                                <span class="w-2 h-2 bg-blue-500 rounded-full mt-2 shrink-0"></span>
                            </div>

                            <div class="notif-item flex gap-3 px-5 py-3.5 hover:bg-slate-50 cursor-pointer bg-blue-50/40 transition-colors" data-unread="1">
                                <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-slate-800">مهمة متأخرة</p>
                                    <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">مراجعة عقد التوريد — تجاوزت الموعد المحدد بـ 12 يوماً</p>
                                    <p class="text-xs text-slate-400 mt-1">منذ ساعة</p>
                                </div>
                                <span class="w-2 h-2 bg-blue-500 rounded-full mt-2 shrink-0"></span>
                            </div>

                            <div class="notif-item flex gap-3 px-5 py-3.5 hover:bg-slate-50 cursor-pointer bg-blue-50/40 transition-colors" data-unread="1">
                                <div class="w-9 h-9 rounded-xl bg-green-50 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-slate-800">عميل جديد</p>
                                    <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">تمت إضافة العميل: شركة الشرق الأوسط للمقاولات</p>
                                    <p class="text-xs text-slate-400 mt-1">منذ 3 ساعات</p>
                                </div>
                                <span class="w-2 h-2 bg-blue-500 rounded-full mt-2 shrink-0"></span>
                            </div>

                            <div class="notif-item flex gap-3 px-5 py-3.5 hover:bg-slate-50 cursor-pointer bg-blue-50/40 transition-colors" data-unread="1">
                                <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-slate-800">مزامنة إنجاز مكتملة</p>
                                    <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">تمت مزامنة 3 معاملات جديدة من منصة إنجاز تلقائياً</p>
                                    <p class="text-xs text-slate-400 mt-1">منذ 5 ساعات</p>
                                </div>
                                <span class="w-2 h-2 bg-blue-500 rounded-full mt-2 shrink-0"></span>
                            </div>

                            <div class="notif-item flex gap-3 px-5 py-3.5 hover:bg-slate-50 cursor-pointer transition-colors" data-unread="0">
                                <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-slate-600">تذكير: جلسة محكمة العمالية</p>
                                    <p class="text-xs text-slate-400 mt-0.5 leading-relaxed">قضية فصل تعسفي — بعد 3 أيام الساعة 11:00</p>
                                    <p class="text-xs text-slate-300 mt-1">أمس</p>
                                </div>
                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="px-5 py-3 border-t border-slate-100 bg-slate-50">
                            <a href="#" class="text-xs text-slate-500 hover:text-slate-700 font-medium">عرض جميع الإشعارات</a>
                        </div>
                    </div>
                </div>
                <div class="h-6 w-px bg-slate-200 mx-1"></div>
                <div class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl hover:bg-slate-100 cursor-pointer transition-colors">
                    <div class="w-8 h-8 rounded-full bg-slate-600 flex items-center justify-center text-white font-bold text-sm">ع</div>
                    <div class="hidden md:block">
                        <div class="text-sm font-semibold text-slate-800 leading-tight">عبدالله الرويسي</div>
                        <div class="text-xs text-slate-400 leading-tight">مدير المكتب</div>
                    </div>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    <!-- ═══════ GLOBAL JS ═══════ -->
    <script>
        function openModal(id) {
            const el = document.getElementById(id);
            if (el) { el.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
        }
        function closeModal(id) {
            const el = document.getElementById(id);
            if (el) { el.classList.add('hidden'); document.body.style.overflow = ''; }
        }
        function toggleSidebar() {
            const s = document.getElementById('sidebar');
            const o = document.getElementById('sidebarOverlay');
            s.classList.toggle('translate-x-full');
            o.classList.toggle('hidden');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.add('translate-x-full');
            document.getElementById('sidebarOverlay').classList.add('hidden');
        }
        // ── Notification dropdown ──
        let notifOpen = false;
        let unreadCount = 5;

        function toggleNotif(e) {
            e.stopPropagation();
            notifOpen = !notifOpen;
            document.getElementById('notifPanel').classList.toggle('hidden', !notifOpen);
        }
        function markAllRead() {
            document.querySelectorAll('.notif-item[data-unread="1"]').forEach(el => {
                el.classList.remove('bg-blue-50/40');
                el.setAttribute('data-unread','0');
                const dot = el.querySelector('span.bg-blue-500');
                if (dot) dot.remove();
            });
            unreadCount = 0;
            document.getElementById('notifBadge').classList.add('hidden');
        }
        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!notifOpen) return;
            const wrapper = document.getElementById('notifWrapper');
            const panel   = document.getElementById('notifPanel');
            if (!wrapper.contains(e.target) && !panel.contains(e.target)) {
                panel.classList.add('hidden');
                notifOpen = false;
            }
        });
        // Mark single as read on click — runs after DOM is ready
        function initNotifItems() {
            document.querySelectorAll('.notif-item').forEach(el => {
                el.addEventListener('click', function() {
                    if (this.getAttribute('data-unread') === '1') {
                        this.classList.remove('bg-blue-50/40');
                        this.setAttribute('data-unread','0');
                        const dot = this.querySelector('span.bg-blue-500');
                        if (dot) dot.remove();
                        unreadCount = Math.max(0, unreadCount - 1);
                        const badge = document.getElementById('notifBadge');
                        if (unreadCount === 0) badge.classList.add('hidden');
                        else badge.textContent = unreadCount;
                    }
                });
            });
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initNotifItems);
        } else {
            initNotifItems();
        }

        // Tab switching utility
        function switchTab(tabGroup, tabId) {
            document.querySelectorAll('[data-tab-group="' + tabGroup + '"]').forEach(el => {
                el.classList.add('hidden');
            });
            document.querySelectorAll('[data-tab-btn-group="' + tabGroup + '"]').forEach(el => {
                el.classList.remove('bg-white', 'text-slate-800', 'shadow-sm');
                el.classList.add('text-slate-500');
            });
            document.getElementById(tabId).classList.remove('hidden');
            document.querySelector('[data-tab-btn="' + tabId + '"]').classList.add('bg-white', 'text-slate-800', 'shadow-sm');
            document.querySelector('[data-tab-btn="' + tabId + '"]').classList.remove('text-slate-500');
        }
    </script>
    @stack('scripts')
</body>
</html>
