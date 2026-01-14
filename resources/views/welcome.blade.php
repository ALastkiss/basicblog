@extends('layouts.blog')

@section('content')
<div class="relative isolate overflow-hidden bg-white">
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>

    <div class="mx-auto max-w-7xl px-6 pb-16 pt-4 sm:pb-24 lg:flex lg:px-8 lg:py-12 items-center">
        <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl lg:flex-shrink-0 lg:pt-0">
            <div class="mt-8 sm:mt-12 lg:mt-8">
                <a href="#" class="inline-flex space-x-6">
                    <span class="rounded-full bg-indigo-600/10 px-3 py-1 text-sm font-semibold leading-6 text-indigo-600 ring-1 ring-inset ring-indigo-600/10">Terbaru</span>
                </a>
            </div>
            <h1 class="mt-6 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                Jelajahi Wawasan <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Teknologi & Pendidikan</span>
            </h1>
            <p class="mt-4 text-lg leading-8 text-gray-600">
                Wadah aspirasi dan kreasi mahasiswa Pendidikan Teknologi Informasi. Temukan artikel menarik, tutorial koding, dan wawasan akademik terkini di sini.
            </p>
            <div class="mt-8 flex items-center gap-x-6">
                <a href="#articles" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all shadow-indigo-200">
                    Mulai Membaca
                </a>
                
                <a href="{{ route('dashboard') }}" class="text-sm font-semibold leading-6 text-gray-900 group">
                    Tulis Artikel <span aria-hidden="true" class="group-hover:translate-x-1 transition-transform inline-block">→</span>
                </a>
            </div>
        </div>
        
        <div class="mx-auto mt-10 flex max-w-2xl sm:mt-16 lg:ml-10 lg:mt-0 lg:mr-0 lg:max-w-none lg:flex-none xl:ml-32">
            <div class="max-w-3xl flex-none sm:max-w-5xl lg:max-w-none">
                <div class="-m-2 rounded-xl bg-gray-900/5 p-2 ring-1 ring-inset ring-gray-900/10 lg:-m-4 lg:rounded-2xl lg:p-4">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=2072&q=80" alt="App screenshot" width="2432" height="1442" class="w-[30rem] rounded-md shadow-2xl ring-1 ring-gray-900/10 opacity-90 hover:opacity-100 transition duration-500">
                </div>
            </div>
        </div>
    </div>
</div>

<div id="articles" class="bg-gray-50 py-16 sm:py-24">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Artikel Pilihan</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Tulisan hasil pemikiran kritis dan kreatif mahasiswa.</p>
        </div>
        
        <div class="mx-auto mt-12 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            @if($posts->count() > 0)
                @foreach($posts as $post)
                <article class="flex flex-col items-start justify-between bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 group h-full">
                    
                    <div class="relative w-full overflow-hidden rounded-xl h-60 bg-gray-100">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="absolute inset-0 h-full w-full object-cover group-hover:scale-110 transition duration-700 ease-in-out">
                        @else
                             <div class="absolute inset-0 h-full w-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-4xl font-bold opacity-90">
                                {{ substr($post->title, 0, 1) }}
                            </div>
                        @endif
                        <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                        
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-gray-600 shadow-sm">
                            {{ $post->created_at->format('d M, Y') }}
                        </div>
                    </div>

                    <div class="max-w-xl mt-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-x-4 text-xs">
                            <span class="relative z-10 rounded-full bg-indigo-50 px-3 py-1.5 font-medium text-indigo-600 hover:bg-indigo-100">Artikel</span>
                        </div>
                        <div class="group relative flex-1">
                            <h3 class="mt-3 text-xl font-semibold leading-6 text-gray-900 group-hover:text-indigo-600 transition-colors">
                                <a href="{{ route('posts.show.public', $post->slug) }}">
                                    <span class="absolute inset-0"></span>
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                                {{ Str::limit(strip_tags($post->content), 120) }}
                            </p>
                        </div>
                    </div>

                    <div class="relative mt-8 flex items-center gap-x-4 w-full pt-4 border-t border-gray-100">
                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-500 text-sm">
                            {{ substr($post->author->name, 0, 1) }}
                        </div>
                        <div class="text-sm leading-6 flex-1">
                            <p class="font-semibold text-gray-900">
                                <span class="absolute inset-0"></span>
                                {{ $post->author->name }}
                            </p>
                            <p class="text-gray-600 text-xs">Penulis</p>
                        </div>
                        <div class="flex items-center text-gray-400 text-xs gap-1">
                            <svg class="w-4 h-4 fill-current text-red-400" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                            <span>{{ $post->likes->count() }}</span>
                        </div>
                    </div>
                </article>
                @endforeach
            @else
                <div class="col-span-3 text-center py-24">
                    <div class="mx-auto h-24 w-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Belum ada artikel</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai buat artikel pertamamu di dashboard admin.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection