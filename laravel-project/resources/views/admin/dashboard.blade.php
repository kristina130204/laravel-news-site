@extends('layouts.admin')
@section('content')
    <div>
        <h1>Admin dashboard</h1>
        <div class="grid-area">            
            <div class="grid-item">
                <div class="grid-title"><h2>Categories</h2><div class="grid-count">{{count($articles)}} elements</div></div>
                <div class="grid-content">
                    <div class="chart"><canvas id="myChartArticles" data-categories='{{$categories}}'
                    data-articles='{{$articles}}'></canvas></div>
                </div>
            </div>            
            <div class="grid-item">
                <div class="grid-title"><h2>Views</h2><div class="grid-count">{{array_sum($views)}} elements</div></div>
                <div class="grid-content">
                    <h3 class="title">The most viewed articles</h3>
                    <div class="grid-home grid-items-three">
                        @foreach ($popularArticles as $article)
                            <a href="/article/{{$article->slug}}" class="grid-item">
                                <div class="image"><img src={{$article->image}} alt={{$article->title}}><div class="date-views"><div class="date">{{$article->created_at->format('d.m.y')}}</div><div class="views"><i class="fa-regular fa-eye"></i>{{$article->total_views}}</div></div></div>
                                <div class="">{{$article->category->name}}</div>
                                <h2 class="title">{{$article->title}}</h2>
                                <div class="desc">{!!$article->shortContent!!}</div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>         
            <div class="grid-item">
                <div class="grid-title"><h2>Comments</h2><div class="grid-count">{{count($comments)}} elements</div></div>
                <div class="grid-content">
                    <div class="chart"><canvas id="myChartComments" data-categories='{{$categories}}'
                        data-articles='{{$articles}}' data-comments='{{$comments}}'></canvas></div>
                </div>
            </div>

        </div>
    </div>
@endsection
