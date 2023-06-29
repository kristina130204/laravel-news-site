<div class="posts">
    <h2 class="title title-styled"><a href="/all-posts">Our reader's posts</a></h2>
    @foreach ($posts as $post)
        <div class="post">
            <div class="grid-home">
                <a href="/post/{{$post->slug}}" class="grid-item">
                    <div class="image"><img src={{$post->image}} alt={{$post->title}}><div class="date-views"><div class="date">{{$post->created_at->format('d.m.y')}}</div><div class="views"><i class="fa-regular fa-eye"></i>{{$post->total_views}}</div></div>
                    </div>
                    <div class="content">
                        <h2 class="title">{{$post->title}}</h2>
                        <div class="author"><img src={{$post->user->image}} alt=""><span class="name">{{$post->user->name}}</span></div>
                        <div class="desc">{!!$post->shortContent!!}</div>
                    </div>
                </a>
            </div>
            </div>
    @endforeach
</div>