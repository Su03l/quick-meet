<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quick-Meet - نظام إدارة الاجتماعات والتايمر</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=alexandria:400,500,600,700&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Alexandria', sans-serif;
        }

        .planit-gradient {
            background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
            box-shadow: 0 0 20px rgba(14, 165, 233, 0.6);
        }

        .glow-text {
            text-shadow: 0 0 15px rgba(14, 165, 233, 0.8);
        }

        .toxic-border {
            border-color: rgba(14, 165, 233, 0.3);
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-[#050505] min-h-screen flex items-center justify-center p-4">
<div
    class="max-w-[1000px] w-full bg-white dark:bg-[#0a0a0a] rounded-[2rem] shadow-2xl overflow-hidden border border-gray-100 dark:toxic-border p-8 lg:p-16 text-center relative">

    <!-- Background Glow Effect -->
    <div class="absolute top-0 left-0 w-full h-full bg-sky-500/5 pointer-events-none"></div>

    <div class="mb-6 relative z-10">
            <span
                class="px-4 py-1.5 bg-sky-100 dark:bg-sky-900/30 text-sky-800 dark:text-sky-400 text-sm font-bold rounded-full uppercase tracking-wider border border-sky-200 dark:border-sky-500/30">
                Quick-Meet System v1.0
            </span>
    </div>
    <h1 class="text-4xl lg:text-6xl font-extrabold text-gray-900 dark:text-white mb-6 leading-tight relative z-10">
        نظام إدارة اجتماعات <br/>
        <span class="text-sky-500 dark:text-sky-400 glow-text">ذكي ومنظم بالوقت.</span>
    </h1>
    <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto relative z-10">
        منصة متكاملة لتنظيم أجندة الاجتماعات، تتبع الوقت المتبقي لكل بند، وتوليد محاضر الاجتماعات تلقائياً. مبنية بمعمارية حديثة تضمن الدقة، الاحترافية، والإنتاجية العالية.
    </p>

    <div class="flex flex-wrap gap-4 justify-center relative z-10 mb-12">
        <a href="/docs/api" target="_blank"
           class="px-8 py-4 planit-gradient text-white font-bold rounded-xl hover:opacity-90 transition-all active:scale-95 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            توثيق الـ API
        </a>
        <a href="https://github.com" target="_blank"
           class="px-8 py-4 border-2 border-slate-200 dark:border-sky-500/20 text-slate-600 dark:text-sky-400 font-bold rounded-xl hover:bg-slate-50 dark:hover:bg-sky-500/10 transition-all">
            المستودع البرمجي
        </a>
    </div>

    <!-- Developer Commands Section -->
    <div
        class="mb-12 relative z-10 text-right bg-gray-50 dark:bg-[#111] p-6 rounded-2xl border border-gray-200 dark:border-sky-500/10">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            أوامر المطورين (Developer Commands)
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div
                class="flex items-center justify-between bg-white dark:bg-black/50 p-4 rounded-xl border border-gray-200 dark:border-gray-800">
                <code class="text-sm text-sky-600 dark:text-sky-400 font-mono font-bold" dir="ltr">php artisan queue:work</code>
                <span class="text-xs text-gray-500">تشغيل محرك الإشعارات</span>
            </div>
            <div
                class="flex items-center justify-between bg-white dark:bg-black/50 p-4 rounded-xl border border-gray-200 dark:border-gray-800">
                <code class="text-sm text-sky-600 dark:text-sky-400 font-mono font-bold" dir="ltr">php artisan migrate</code>
                <span class="text-xs text-gray-500">تهيئة قاعدة البيانات</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-right relative z-10">
        <div
            class="p-6 bg-gray-50 dark:bg-[#111] rounded-2xl border border-transparent dark:border-sky-500/10 hover:border-sky-500/30 transition-all">
            <div class="text-sky-500 mb-4 flex justify-center md:justify-start">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">تايمر لحظي دقيق</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">تتبع الوقت المتبقي لكل بند في الأجندة لضمان عدم تجاوز الوقت المخصص للاجتماع.</p>
        </div>
        <div
            class="p-6 bg-gray-50 dark:bg-[#111] rounded-2xl border border-transparent dark:border-sky-500/10 hover:border-sky-500/30 transition-all">
            <div class="text-sky-400 mb-4 flex justify-center md:justify-start">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">إدارة الأجندة</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">نظم مواضيع النقاش، حدد المتحدثين، ووزع الدقائق بكل احترافية وسهولة.</p>
        </div>
        <div
            class="p-6 bg-gray-50 dark:bg-[#111] rounded-2xl border border-transparent dark:border-sky-500/10 hover:border-sky-500/30 transition-all">
            <div class="text-sky-600 mb-4 flex justify-center md:justify-start">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">تقارير PDF فورية</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">احصل على محضر اجتماع رسمي بصيغة PDF يرسل تلقائياً لجميع الحضور فور انتهاء الجلسة.</p>
        </div>
    </div>
</div>
</body>
</html>
