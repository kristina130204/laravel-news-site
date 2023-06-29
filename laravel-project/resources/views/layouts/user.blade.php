@include('layouts.headers.header-with-search')
@include('layouts.nav')
<div class="wrapper">
<div class="container">
    <aside class="sidebar">
        <div class="profile">
            <div class="user-image">
                <img src={{ Auth::user()->image ?? "/images/no-image.png"}} alt={{ Auth::user()->name }} class="user">
            </div>
            <div class="user-info">
                <a href="/user" class="username">{{ Auth::user()->name }}</a>
                <div class="created">Account created <span class="date">{{ Auth::user()->created_at->format('d.m.y') }}</span></div>
                @if (Auth::user()->role === 'admin')
                    <div class="admin"><a href="/admin" target="blank">Go to admin panel</a></div>
                @endif
                <div class="posts"><a href="/user-posts">View your posts</a></div>
                <div class="create"><a href="posts/create" class="btn outlined-button">Create a new post!</a></div>
                <div class="buttons">
                    <a href="/user/{{Auth::user()->id}}/edit" class="btn edit-button"><i class="fa-solid fa-pen"></i></a>
                    {!! Form::open(['url' => '/user/'.Auth::user()->id, 'method' => 'DELETE']) !!}
                    {!! Form::submit('Dispose', ['class' => 'btn btn-dark']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </aside>
    <main class="main">
        @yield('content')
    </main>
</div>
<div class="to-up"><i class="fa-solid fa-caret-up"></i></div>
<div class="chat-container">
    <div class="chat-btn"><i class="fa-regular fa-comments"></i>
    <div class="chat-div hidden">
        <div id="chat">@include('chat.chat')</div>
    </div>
    </div>
</div>
</div>
@include('layouts.footer')

