<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                {{ __('Overview') }}
            </h2>
            <div class="text-sm text-slate-500 font-medium">
                {{ now()->format('l, d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="fixed inset-0 -z-10 bg-slate-50">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-white rounded-full blur-3xl opacity-60 pointer-events-none"></div>
    </div>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-2 relative bg-slate-900 rounded-3xl p-8 overflow-hidden shadow-xl shadow-slate-200">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-600 rounded-full mix-blend-overlay filter blur-3xl opacity-20"></div>
                    <div class="absolute bottom-0 left-10 w-40 h-40 bg-purple-600 rounded-full mix-blend-overlay filter blur-3xl opacity-20"></div>

                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800 border border-slate-700 text-xs font-semibold text-indigo-400 mb-4">
                                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                                System Online
                            </div>
                            <h3 class="text-3xl font-bold text-white mb-2">
                                Selamat Datang, {{ Auth::user()->name }}!
                            </h3>
                            <p class="text-slate-400 max-w-lg">
                                Siap membagikan ide cemerlang hari ini? Kelola semua tulisanmu dengan mudah dari sini.
                            </p>
                        </div>
                        
                        <div class="mt-8 flex gap-4">
                            <a href="{{ route('posts.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl transition-all shadow-lg shadow-indigo-900/50">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Buat Artikel Baru
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 flex flex-col justify-center relative overflow-hidden group hover:border-indigo-100 transition-colors">
                    <div class="absolute right-0 top-0 p-6 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-32 h-32 text-indigo-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1h2a2 2 0 012 2v2a2 0 00.5.5V20zM5 6v14h14V11h-4a2 2 0 01-2-2V6H5z"/></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <p class="text-slate-500 font-medium text-sm uppercase tracking-wider">Total Publikasi</p>
                        <div class="flex items-baseline gap-2 mt-2">
                            <span class="text-6xl font-black text-slate-800 tracking-tight">{{ $totalArticles }}</span>
                            <span class="text-lg text-slate-400 font-medium">Artikel</span>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-100">
                            <a href="{{ route('home') }}" target="_blank" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 flex items-center gap-1 group-hover:gap-2 transition-all">
                                Lihat Blog Kamu 
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 flex flex-col">
                    <div class="px-8 py-6 border-b border-slate-50 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Tulisan Terakhir</h3>
                            <p class="text-sm text-slate-500">Update status kontenmu</p>
                        </div>
                        <a href="{{ route('posts.index') }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                        </a>
                    </div>

                    <div class="flex-1 p-4">
                        @if($recentArticles->count() > 0)
                            <div class="space-y-2">
                                @foreach($recentArticles as $article)
                                <div class="group flex items-center justify-between p-4 rounded-2xl hover:bg-slate-50 transition-colors duration-200">
                                    <div class="flex items-center gap-4 overflow-hidden">
                                        <div class="h-12 w-12 flex-shrink-0 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-lg border border-indigo-100 overflow-hidden">
                                            @if($article->image)
                                                <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-full object-cover">
                                            @else
                                                {{ substr($article->title, 0, 1) }}
                                            @endif
                                        </div>
                                        
                                        <div class="min-w-0">
                                            <h4 class="text-slate-800 font-semibold truncate group-hover:text-indigo-700 transition-colors">{{ $article->title }}</h4>
                                            <div class="flex items-center gap-3 text-xs text-slate-500 mt-1">
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    {{ $article->created_at->diffForHumans() }}
                                                </span>
                                                <span class="{{ $article->is_published ? 'text-green-600' : 'text-amber-600' }}">
                                                    {{ $article->is_published ? '• Published' : '• Draft' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('posts.edit', $article->id) }}" class="flex-shrink-0 opacity-0 group-hover:opacity-100 translate-x-2 group-hover:translate-x-0 transition-all duration-300 px-4 py-2 rounded-lg bg-white border border-slate-200 text-slate-600 text-sm font-medium shadow-sm hover:border-indigo-500 hover:text-indigo-600">
                                        Edit
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="h-64 flex flex-col items-center justify-center text-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </div>
                                <p class="text-slate-500 font-medium">Belum ada artikel.</p>
                                <a href="{{ route('posts.create') }}" class="mt-2 text-indigo-600 text-sm hover:underline">Mulai menulis &rarr;</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-800">Manajemen Konten</h4>
                        <p class="text-slate-500 text-sm mt-1 mb-4">Lihat, edit, atau hapus artikel yang sudah diterbitkan.</p>
                        <a href="{{ route('posts.index') }}" class="block w-full text-center py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 hover:text-slate-900 transition-colors">
                            Kelola Artikel
                        </a>
                    </div>

                    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl p-6 shadow-lg shadow-indigo-200 text-white">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="h-10 w-10 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm">
                                <span class="font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="text-xs text-indigo-100 font-medium uppercase tracking-wider">Logged in as</p>
                                <p class="font-bold">{{ Auth::user()->name }}</p>
                            </div>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="flex items-center justify-between w-full px-4 py-2 bg-white/10 rounded-xl hover:bg-white/20 transition-colors backdrop-blur-sm text-sm">
                            <span>Edit Profil</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>