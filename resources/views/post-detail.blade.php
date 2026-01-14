@extends('layouts.blog')

@section('content')
<div x-data="{ width: '0%' }" x-init="window.addEventListener('scroll', () => { width = (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100 + '%' })" class="fixed top-0 left-0 h-1.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 z-[60]" :style="'width: ' + width"></div>

<article class="bg-white min-h-screen font-sans antialiased selection:bg-indigo-100 selection:text-indigo-700">
    
    <nav class="sticky top-0 z-40 bg-white/90 backdrop-blur-lg border-b border-gray-100 transition-all duration-300 shadow-sm">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between"> <a href="{{ route('home') }}" class="group flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors">
                <svg class="w-4 h-4 mr-1.5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            
            <button class="text-gray-400 hover:text-indigo-600 transition-colors p-2 rounded-full hover:bg-gray-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
            </button>
        </div>
    </nav>

    <header class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-6"> <div class="space-y-4">
            
            <div class="flex items-center gap-3 text-xs font-semibold tracking-wide uppercase text-gray-500">
                <time datetime="{{ $post->created_at }}" class="text-indigo-600">{{ $post->created_at->format('d F Y') }}</time>
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} Menit Baca</span>
            </div>
            
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight text-gray-900 leading-tight">
                {{ $post->title }}
            </h1>

            <div class="flex items-center gap-3 pt-2">
                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-sm font-bold text-white shadow-md shadow-indigo-200">
                    {{ substr($post->author->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-900 leading-none">{{ $post->author->name }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">Penulis Konten</p>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-10"> <div class="relative w-full aspect-video overflow-hidden rounded-2xl shadow-xl shadow-gray-200 group ring-1 ring-gray-900/5">
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" 
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                     alt="{{ $post->title }}">
            @else
                <div class="absolute inset-0 w-full h-full bg-gradient-to-tr from-slate-100 to-slate-200 flex items-center justify-center">
                    <span class="text-6xl font-black text-slate-300 select-none">{{ substr($post->title, 0, 1) }}</span>
                </div>
            @endif
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg prose-slate prose-headings:font-bold prose-headings:text-gray-900 prose-a:text-indigo-600 prose-a:no-underline hover:prose-a:underline prose-img:rounded-xl prose-img:shadow-lg prose-p:leading-relaxed prose-p:text-gray-600 mx-auto">
            
            <span class="float-left text-5xl font-black text-indigo-600 mr-3 mt-[-6px] leading-none">
                {{ substr(strip_tags($post->content), 0, 1) }}
            </span>
            {!! $post->content !!}
        </div>

        <div class="mt-10 mb-12 grid grid-cols-1 md:grid-cols-2 gap-6 items-center border-t border-gray-100 pt-8">
            
            <div class="flex flex-col items-center md:items-start">
                <span class="text-sm font-semibold text-gray-500 mb-3">Suka artikel ini?</span>
                <form action="{{ route('posts.like', $post->id) }}" method="POST">
                    @csrf
                    @php $isLiked = $post->isLikedByAuthUser(); @endphp

                    <button type="submit" class="group relative inline-flex items-center gap-2 px-6 py-2.5 rounded-full transition-all duration-300 shadow-sm border {{ $isLiked ? 'bg-red-50 border-red-200 text-red-600' : 'bg-white border-gray-200 text-gray-600 hover:border-indigo-300 hover:text-indigo-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform group-active:scale-125 {{ $isLiked ? 'fill-current' : '' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="{{ $isLiked ? '0' : '2' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span class="font-bold">{{ $post->likes->count() }}</span>
                    </button>
                </form>
            </div>

            @if($post->author->instagram)
            <div class="flex justify-center md:justify-end">
                <a href="{{ $post->author->instagram }}" target="_blank" class="group flex items-center gap-3 p-3 pr-5 rounded-xl bg-gray-50 hover:bg-indigo-50 transition-colors border border-gray-100 hover:border-indigo-100">
                    <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center text-indigo-600 shadow-sm ring-1 ring-gray-100 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069z"/></svg>
                    </div>
                    <div class="text-left">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Follow</p>
                        <p class="text-sm font-bold text-gray-900 group-hover:text-indigo-700">@ Instagram</p>
                    </div>
                </a>
            </div>
            @endif

        </div>
    </div>

</article>
@endsection