<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center">
            <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="glass-panel p-6 rounded-2xl shadow-sm border-l-4 border-indigo-500 bg-white/70">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-widest">Total Users</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $users->count() }}</div>
                </div>
                <div class="glass-panel p-6 rounded-2xl shadow-sm border-l-4 border-emerald-500 bg-white/70">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-widest">Total Briefs</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $briefs->count() }}</div>
                </div>
                <div class="glass-panel p-6 rounded-2xl shadow-sm border-l-4 border-purple-500 bg-white/70">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-widest">AI Processed</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $briefs->where('ai_summary', '!=', null)->count() }}</div>
                </div>
            </div>

            <!-- Users List -->
            <div class="glass-panel text-gray-900 rounded-2xl shadow-sm overflow-hidden bg-white/80 border border-white/50">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                     <h3 class="text-lg font-bold text-gray-900">{{ __('Users') }}</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50 text-gray-500">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">ID</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Name</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Role</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4 text-gray-500 font-mono text-xs">#{{ $user->id }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold mr-3 text-xs">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        @if($user->is_admin)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-200">
                                                Admin
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                                User
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- All Briefs List -->
            <div class="glass-panel text-gray-900 rounded-2xl shadow-sm overflow-hidden bg-white/80 border border-white/50">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-900">{{ __('All Briefs') }}</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50 text-gray-500">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Brief</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Author</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Date</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">AI Status</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach ($briefs as $brief)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $brief->title }}</td>
                                    <td class="px-6 py-4 text-gray-600">
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold mr-2 text-[10px]">
                                                {{ substr($brief->user->name, 0, 1) }}
                                            </div>
                                            {{ $brief->user->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">{{ $brief->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        @if($brief->ai_summary)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                                Processed
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('briefs.show', $brief) }}" class="text-indigo-600 hover:text-indigo-900 font-medium text-xs uppercase tracking-wide">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
