@include('layouts.headers.header-with-search')
        <div class="wrapper">
        <div class="container">
            <aside class="sidebar">
                <ul class="list">
                    <li class="list-item"><a class="@if(request()->is("admin/")) active @endif" href="/admin/"><i class="fa-solid fa-arrow-trend-up"></i><span>Dashboard</span></a></li>
                    <li class="list-item"><a class="@if(request()->is("admin/categories")) active @endif" href="/admin/categories"><i class="fa-regular fa-window-restore"></i><span>Categories</span></a></li>
                    <li class="list-item"><a class="@if(request()->is("admin/articles")) active @endif" href="/admin/articles"><i class="fa-regular fa-newspaper"></i><span>Articles</span></a></li>
                    <li class="list-item"><a class="@if(request()->is("admin/comments")) active @endif" href="/admin/comments"><i class="fa-regular fa-comment"></i><span>Comments</span></a></li>
                    <li class="list-item"><a class="@if(request()->is("admin/replies")) active @endif" href="/admin/replies"><i class="fa-regular fa-comments"></i><span>Replies</span></a></li>
                    <li class="list-item"><a class="@if(request()->is("admin/tags")) active @endif" href="/admin/tags"><i class="fa-solid fa-tags"></i><span>Tags</span></a></li>
                    <li class="list-item"><a class="@if(request()->is("admin/users")) active @endif" href="/admin/users"><i class="fa-solid fa-user-pen"></i><span>Users</span></a></li>
                    <li class="list-item"><a class="@if(request()->is("admin/posts")) active @endif" href="/admin/posts"><i class="fa-solid fa-chalkboard-user"></i><span>Reader's posts</span></a></li>
                    <li class="list-item"><a class="@if(request()->is("admin/messages")) active @endif" href="/admin/messages"><i class="fa-regular fa-message"></i><span>Messages</span></a></li>
                </ul>
            </aside>
            <main class="main main-admin">
                @yield('content')
            </main>
        </div>
        <div class="to-up"><i class="fa-solid fa-caret-up"></i></div>
        </div>
        @include('layouts.footer')

