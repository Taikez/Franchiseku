@extends('layouts.app')

@section('title', 'Franchiseku | News')

@section('main')
@vite('resources/css/blog.css')
    
    <section id="newsHeader" class="d-flex align-items-center justify-content-center" style="min-height: 30vh;">
        <div class="container-fluid">
            <div class="row text-center gap-4">
                <h1 class="fs-1 fw-bold" >Today Business News</h1>
                <p class="fs-5">See What’s Happening In The World Today</p>
            </div>
        </div>
    </section>


    <section class="bg-light pt-2">
        <div class="container">
            <img src="{{asset('frontendImg/news-header-img.png')}}" alt="" class="img-fluid">
        </div>
    </section>


    {{-- sidebar and content --}}
    <div class="news bg-white" id="newsBody">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                  <aside class="blog__sidebar">
                     
                    <div class="widget">
                        <h4 class="widget-title">Recent Blog</h4>
                        <ul class="rc__post">
                            @foreach ($latestNews as $item)
                                <li class="rc__post__item">
                                    <div class="rc__post__thumb">
                                        <a href="{{route('news.detail', $item->id)}}"><img class="img-fluid " src="{{asset($item->newsImage)}}" alt=""></a>
                                    </div>
                                    <div class="rc__post__content">
                                        <h5 class="title"><a href="{{route('news.detail', $item->id)}}">{{$item->newsTitle}}</a></h5>
                                            <span class="post-date"><i class="fal fa-calendar-alt"></i> {{Carbon\Carbon::parse($item->created_at)->diffForHumans()}} </span>
                                        </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget">
                        <h4 class="widget-title">Categories</h4>
                        <ul class="sidebar__cat">
                            @foreach ($categories as $item)
                            <li class="sidebar__cat__item w-75"><a href="">{{$item->newsCategory}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                   
                    <div class="widget">
                        <h4 class="widget-title">Popular Tags</h4>
                        <ul class="sidebar__tags">

                            {{-- Ngambil maksimal 10 tags dari news->newsTags soalnya datany multiple   --}}
                            {{-- ribet bgst --}}
                            
                            @php
                                $totalTagsDisplayed = 0;
                            @endphp

                            @foreach ($news as $newsItem)
                                <h2>{{ $newsItem->title }}</h2>
                                @foreach (explode(',', $newsItem->newsTags) as $tag)
                                    @if ($totalTagsDisplayed >= 10)
                                        @break
                                    @endif
                                    <li><a href="">{{ trim($tag) }}</a></li>
                                    @php
                                        $totalTagsDisplayed++;
                                    @endphp
                                @endforeach
                                @if ($totalTagsDisplayed >= 10)
                                    @break
                                @endif
                            @endforeach

                        </ul>
                    </div>
                  </aside>
                </div>
                <div class="col rightPanel" style="min-height: 100vh" id="newsContent">
                  
                    @foreach ($latestNews as $item)     
                    <div class="container mt-5">
                        <div class="row mx-auto">
                            <div class="col-md-8 mx-auto">
                                <h2 class="fw-bold fs-2 mb-3" style="color:#015051">{{$item->newsTitle}}</h2>
                            </div>
                            <div class="col-md-8 mx-auto">
                                <img src="{{asset($item->newsImage)}}" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-8 mx-auto">
                                <p class="fw-light mt-2">{{$item->newsAuthor}} {{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}.</p>
                                <a href="{{route('news.detail',$item->id)}}">
                                    <p class="text-success fs-5">Read More >></p>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                  
                </div>
            </div>
        </div>
    </div>

    

@endsection