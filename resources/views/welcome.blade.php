<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'SmartBriefs') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Outfit', sans-serif; background-color: #f3f4f6; }
            .hero-gradient {
                background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 50%, #06b6d4 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.4);
            }
            .blob {
                position: absolute;
                filter: blur(40px);
                z-index: -1;
                opacity: 0.5;
            }
        </style>
    </head>
    <body class="antialiased bg-gray-50 min-h-screen flex flex-col relative overflow-hidden">
        
        <!-- Background Elements -->
        <div class="blob bg-purple-300 w-96 h-96 rounded-full top-0 left-0 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="blob bg-cyan-300 w-80 h-80 rounded-full bottom-0 right-0 translate-x-1/3 translate-y-1/3"></div>

        <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex-grow flex flex-col justify-center">
            
            <header class="absolute top-0 right-0 pt-6 pr-6">
                @if (Route::has('login'))
                    <nav class="space-x-4">
                        @auth
                            <a href="{{ url('/briefs') }}" class="font-semibold text-gray-700 hover:text-indigo-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-700 hover:text-indigo-600 transition">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">Get Started</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <main class="mt-16 sm:mt-24 text-center">
                <h1 class="text-5xl sm:text-7xl font-bold tracking-tight text-gray-900 mb-6">
                    Summarize & Transform <br>
                    <span class="hero-gradient">Intelligent Briefs</span>
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto mb-8 leading-relaxed">
                    Elevate your documents with AI-powered summaries, smart tagging, and instant tonal rewrites. Manage your briefs effortlessly with SmartBriefs.
                </p>
                
                <div class="flex justify-center gap-6 mt-8">
                     <a href="{{ route('register') }}" class="px-8 py-3 rounded-full bg-indigo-600 text-white font-semibold text-lg hover:bg-indigo-700 transition shadow-xl shadow-indigo-500/40 transform hover:-translate-y-1">
                        Start for Free
                    </a>
                    <a href="#features" class="px-8 py-3 rounded-full bg-white text-gray-700 font-semibold text-lg border border-gray-200 hover:border-gray-300 hover:shadow-md transition">
                        Learn More
                    </a>
                </div>

                <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8 text-left px-4">
                    <div class="glass-card p-8 rounded-2xl shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Instant Summaries</h3>
                        <p class="text-gray-600">Get concise breakdowns of lengthy documents in seconds using advanced AI models.</p>
                    </div>

                    <div class="glass-card p-8 rounded-2xl shadow-sm hover:shadow-md transition">
                         <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center text-cyan-600 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Smart Tagging</h3>
                        <p class="text-gray-600">Automatically extract relevant keywords to organize and retrieve your briefs easily.</p>
                    </div>

                    <div class="glass-card p-8 rounded-2xl shadow-sm hover:shadow-md transition">
                         <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600 mb-4">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Tonal Rewrites</h3>
                        <p class="text-gray-600">Need it formal? Friendly? Shorter? Transform your text with a single click.</p>
                    </div>
                </div>
            </main>

            <footer class="mt-auto py-6 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} SmartBriefs. All rights reserved.
            </footer>
        </div>
    </body>
</html>
