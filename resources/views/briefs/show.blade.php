<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ $brief->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Main Content Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Brief Content -->
                <div class="glass-panel text-gray-900 rounded-2xl shadow-sm p-8 bg-white/60">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Original Brief
                    </h3>
                    <div class="prose prose-indigo max-w-none text-gray-600 leading-relaxed font-light">
                         {!! nl2br(e($brief->content)) !!}
                    </div>

                    @if($brief->attachment_path)
                        <div class="mt-8 pt-6 border-t border-gray-100">
                             <h4 class="text-sm font-semibold text-gray-900 mb-2">Attachment</h4>
                            <a href="{{ Storage::url($brief->attachment_path) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition shadow-sm">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                View Attachment
                            </a>
                        </div>
                    @endif
                </div>

                <!-- AI Rewrite Section -->
                @if($brief->ai_rewrite)
                    <div class="glass-panel rounded-2xl shadow-sm p-8 border-l-4 border-purple-500 bg-white/70">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            AI Rewrites
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($brief->ai_rewrite as $key => $text)
                                <div class="bg-purple-50/50 rounded-xl p-5 border border-purple-100">
                                    <h4 class="text-xs font-bold text-purple-700 uppercase tracking-wide mb-2">{{ ucfirst($key) }} Version</h4>
                                    <p class="text-gray-700 text-sm leading-relaxed">{{ $text }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar Column -->
            <div class="space-y-6">
                <!-- Action Card -->
                 <div class="glass-panel bg-white/80 rounded-2xl shadow-sm p-6 border border-white/50">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm font-medium text-gray-500">Created {{ $brief->created_at->diffForHumans() }}</span>
                        <div class="flex space-x-2">
                             <a href="{{ route('briefs.edit', $brief) }}" class="p-2 text-gray-400 hover:text-indigo-600 transition rounded-full hover:bg-gray-100" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                             <form action="{{ route('briefs.destroy', $brief) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition rounded-full hover:bg-red-50" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    @if(!$brief->ai_summary)
                         <form action="{{ url('/briefs/' . $brief->id . '/ai') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/30 transform hover:-translate-y-0.5 transition flex justify-center items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                Generate AI Analysis
                            </button>
                        </form>
                    @else
                         <div class="w-full py-3 px-4 bg-green-100 text-green-700 font-bold rounded-xl flex justify-center items-center cursor-default border border-green-200">
                             <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                             AI Processing Complete
                         </div>
                    @endif
                 </div>

                <!-- AI Summary Card -->
                @if($brief->ai_summary)
                    <div class="glass-panel p-6 rounded-2xl shadow-sm border-t-4 border-indigo-500 bg-white/70">
                        <h3 class="font-bold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            AI Summary
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $brief->ai_summary }}</p>
                    </div>
                @endif
                
                <!-- AI Tags Card -->
                @if($brief->ai_tags)
                    <div class="glass-panel p-6 rounded-2xl shadow-sm border-t-4 border-cyan-500 bg-white/70">
                         <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            Smart Tags
                        </h3>
                        <div class="flex flex-wrap gap-2">
                             @foreach($brief->ai_tags as $tag)
                                <span class="px-3 py-1 rounded-lg bg-cyan-50 text-cyan-700 text-sm font-medium border border-cyan-100 hover:bg-cyan-100 transition cursor-default">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
