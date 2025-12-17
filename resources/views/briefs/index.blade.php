<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('My Briefs') }}
            </h2>
            <a href="{{ route('briefs.create') }}" class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-lg glow-effect">
                {{ __('Create New Brief') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-sm">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($briefs as $brief)
                    <div class="glass-panel rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col transform hover:-translate-y-1">
                        <div class="p-6 flex-grow">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-gray-900 line-clamp-1 hover:text-indigo-600 transition" title="{{ $brief->title }}">
                                    <a href="{{ route('briefs.show', $brief) }}">{{ $brief->title }}</a>
                                </h3>
                                @if($brief->ai_summary)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                        AI Processed
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                        Pending
                                    </span>
                                @endif
                            </div>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3 text-sm leading-relaxed">
                                {{ Str::limit($brief->content, 120) }}
                            </p>
                            
                            @if($brief->ai_tags)
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach(array_slice($brief->ai_tags, 0, 3) as $tag)
                                        <span class="bg-indigo-50 text-indigo-700 text-xs px-2 py-1 rounded-md border border-indigo-100 font-medium">{{ $tag }}</span>
                                    @endforeach
                                    @if(count($brief->ai_tags) > 3)
                                        <span class="text-xs text-gray-400 self-center font-medium">+{{ count($brief->ai_tags) - 3 }}</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                        
                        <div class="bg-gray-50/50 p-4 border-t border-gray-100 flex justify-between items-center backdrop-blur-sm">
                            <span class="text-xs text-gray-400 font-medium">{{ $brief->created_at->diffForHumans() }}</span>
                            <div class="flex gap-4">
                                <a href="{{ route('briefs.show', $brief) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm transition">View</a>
                                <a href="{{ route('briefs.edit', $brief) }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm transition">Edit</a>
                                <form action="{{ route('briefs.destroy', $brief) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm transition">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($briefs->isEmpty())
                <div class="text-center py-24 glass-panel rounded-3xl">
                     <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-indigo-50 mb-6">
                        <svg class="w-12 h-12 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                     </div>
                     <h3 class="text-xl font-bold text-gray-900">No briefs yet</h3>
                     <p class="mt-2 text-gray-500 max-w-sm mx-auto">Get started by creating your first document brief. Our AI will help you summarize and organize it.</p>
                     <div class="mt-8">
                        <a href="{{ route('briefs.create') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg transform hover:-translate-y-1 transition">
                            Create First Brief
                        </a>
                     </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
