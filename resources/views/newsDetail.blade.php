@extends('layouts.app')

@section('main')
<!-- CSS here -->

@vite('resources/css/blog.css')


<div id="newsTitle">
    <div class="container-fluid  d-flex align-items-center justify-content-center" style="min-height: 50vh">
        <div class="row">
            <div class="col">
                <h1 class="fs-1 fw-bold">{{$news->newsTitle}}</h1>
                <p class="fs-5 ">Home / Blog</p>
            </div>
        </div>
    </div>
</div>

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
                        <li class="sidebar__cat__item w-75"><a href="{{route('news.by.category',$item->id)}}">{{$item->newsCategory}}</a></li>
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
                                $displayedTags = [];
                            @endphp
                            
                            @foreach ($latestNews as $newsItem)
                                <h2>{{ $newsItem->title }}</h2>
                                @foreach (explode(',', $newsItem->newsTags) as $tag)
                                    @if ($totalTagsDisplayed >= 10)
                                        @break
                                    @endif
                                    @php
                                        $trimmedTag = trim($tag);
                                    @endphp
                                    @if (!in_array($trimmedTag, $displayedTags))
                                        <li><a href="{{ route('news.by.tags', $trimmedTag) }}">{{ $trimmedTag }}</a></li>
                                        @php
                                            $displayedTags[] = $trimmedTag;
                                            $totalTagsDisplayed++;
                                        @endphp
                                    @endif
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
              <div class="row mt-4">
                <div class="col-md-12">
                  <img src="{{asset($news->newsImage)}}" class="d-block m-2 shadow-sm rounded img-fluid mx-auto" alt="">
                </div>
              </div>

              <div class="row">
                <div class="col-md-5 text-center">
                  <p class="fw-light fs-4 mt-3 text-info"> By {{$news->newsAuthor}} {{Carbon\Carbon::parse($news->created_at)->diffForHumans()}}</p>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 p-5 pt-2 fs-sm-6 fw-light text-justify">
                  <p>{!! $news->newsContent !!}</p>
                </div>
                <div class="col-md-12 px-5">
                    <h5 class="fs-6"> Tags : {{$news->newsTags}}</h5>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection