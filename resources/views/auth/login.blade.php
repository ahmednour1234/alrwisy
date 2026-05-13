<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول — ميزان</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
    @theme {
        --font-sans: 'Noto Kufi Arabic', ui-sans-serif, system-ui, sans-serif;
    }
    @layer base {
        * { font-family: 'Noto Kufi Arabic', sans-serif; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col lg:flex-row" style="font-family:'Noto Kufi Arabic',sans-serif;">

    <!-- Right Panel — Branding -->
    <div class="hidden lg:flex lg:w-1/2 bg-slate-900 flex-col justify-between p-12 relative overflow-hidden">
        <!-- Decorative circles -->
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-amber-500/10"></div>
        <div class="absolute -bottom-32 -left-16 w-80 h-80 rounded-full bg-amber-500/5"></div>
        <div class="absolute top-1/2 left-1/4 w-48 h-48 rounded-full bg-slate-700/40"></div>

        <!-- Logo + title -->
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-12">
                <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002
                                 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                    </svg>
                </div>
                <div>
                    <div class="text-white font-bold text-xl leading-tight">ميزان</div>
                    <div class="text-slate-400 text-sm">إدارة مكاتب المحاماة</div>
                </div>
            </div>
            <h1 class="text-4xl font-bold text-white leading-relaxed mb-4">
                نظام متكامل<br>
                <span class="text-amber-400">لإدارة مكتبك القانوني</span>
            </h1>
            <p class="text-slate-400 text-lg leading-relaxed">
                أدِر قضاياك وعملاءك وجلساتك ومعاملاتك الحكومية من منصة واحدة احترافية.
            </p>
        </div>

        <!-- Feature list -->
        <div class="relative z-10 space-y-4">
            @foreach(['إدارة القضايا والجلسات القضائية','متابعة معاملات إنجاز وناجز وأبشر','أرشفة المستندات والوثائق القانونية','تقارير وإحصاءات شاملة'] as $feature)
            <div class="flex items-center gap-3">
                <div class="w-6 h-6 rounded-full bg-amber-500/20 flex items-center justify-center flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="text-slate-300 text-sm">{{ $feature }}</span>
            </div>
            @endforeach
        </div>

        <!-- Footer branding -->
        <div class="relative z-10">
            <p class="text-slate-600 text-sm">مكتب الرويسي للمحاماة والاستشارات القانونية</p>
            <p class="text-slate-700 text-xs mt-1">الرياض، المملكة العربية السعودية</p>
        </div>
    </div>

    <!-- Left Panel — Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-slate-50 p-8">
        <div class="w-full max-w-md">

            <!-- Mobile logo -->
            <div class="flex lg:hidden items-center justify-center gap-3 mb-10">
                <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                    </svg>
                </div>
                <div>
                    <div class="text-slate-800 font-bold text-xl leading-tight">ميزان</div>
                    <div class="text-slate-500 text-sm">إدارة مكاتب المحاماة</div>
                </div>
            </div>

            <!-- Heading -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-800">أهلاً بك 👋</h2>
                <p class="text-slate-500 text-sm mt-1">سجّل دخولك للوصول إلى لوحة التحكم</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <form action="/dashboard" method="GET">
                    @csrf
                    <!-- Email -->
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">البريد الإلكتروني</label>
                        <div class="relative">
                            <svg class="w-4 h-4 text-slate-400 absolute top-3 right-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                            <input type="email" value="admin@alruwaysi-law.sa" placeholder="example@law.sa"
                                   class="w-full pr-10 pl-4 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-800
                                          focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent
                                          bg-slate-50 focus:bg-white transition-all">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">كلمة المرور</label>
                        <div class="relative">
                            <svg class="w-4 h-4 text-slate-400 absolute top-3 right-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <input type="password" value="password"
                                   class="w-full pr-10 pl-4 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-800
                                          focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent
                                          bg-slate-50 focus:bg-white transition-all">
                        </div>
                    </div>

                    <!-- Remember me + forgot -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" checked class="w-4 h-4 rounded border-slate-300 text-amber-500 focus:ring-amber-400 accent-amber-500">
                            <span class="text-sm text-slate-600">تذكرني</span>
                        </label>
                        <a href="#" class="text-sm text-amber-500 hover:text-amber-600 font-medium">نسيت كلمة المرور؟</a>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                            class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded-xl
                                   transition-colors shadow-sm shadow-amber-500/30 text-sm">
                        تسجيل الدخول
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <p class="text-center text-xs text-slate-400 mt-6">
                جميع الحقوق محفوظة © {{ date('Y') }} — مكتب الرويسي للمحاماة
            </p>
        </div>
    </div>

</body>
</html>
