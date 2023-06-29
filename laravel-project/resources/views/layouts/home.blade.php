@include('layouts.headers.header-with-search')
@include('layouts.nav')
        <div class="wrapper">
        <div class="container">
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

