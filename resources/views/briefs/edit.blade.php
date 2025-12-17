<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Brief') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-panel text-gray-900 rounded-2xl shadow-xl overflow-hidden bg-white/80 border border-white/50">
                <div class="p-8">
                    <form action="{{ route('briefs.update', $brief) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="title" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Title') }}</label>
                            <input type="text" name="title" id="title" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50/50 py-3 px-4 transition" value="{{ old('title', $brief->title) }}" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Content') }}</label>
                            <textarea name="content" id="content" rows="8" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50/50 py-3 px-4 transition" required>{{ old('content', $brief->content) }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                             <label for="attachment" class="block text-sm font-bold text-gray-700 mb-2">{{ __('Attachment') }}</label>
                             @if($brief->attachment_path)
                                <div class="mb-3 px-4 py-2 bg-indigo-50 rounded-lg text-sm text-indigo-700 flex items-center justify-between border border-indigo-100">
                                    <span>Current: <strong>{{ basename($brief->attachment_path) }}</strong></span>
                                    <a href="{{ Storage::url($brief->attachment_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 underline text-xs">View</a>
                                </div>
                             @endif
                             
                             <div class="flex items-center justify-center w-full">
                                <label for="attachment" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to replace</span> or drag new file</p>
                                        <p class="text-xs text-gray-500">PDF, DOCX, TXT up to 10MB</p>
                                    </div>
                                    <input id="attachment" name="attachment" type="file" class="hidden" />
                                </label>
                            </div> 
                            @error('attachment')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end pt-6 border-t border-gray-100">
                            <a href="{{ route('briefs.index') }}" class="text-gray-500 hover:text-gray-700 font-medium mr-6 transition">{{ __('Cancel') }}</a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-full font-semibold text-white tracking-wide hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition shadow-lg shadow-indigo-500/30">
                                {{ __('Update Brief') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
