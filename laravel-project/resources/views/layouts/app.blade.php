@include('layouts.headers.header-with-search')
@include('layouts.nav')
        <div class="wrapper">
        <div class="container">
            <main class="main">
                @yield('content')
            </main>
        </div>
        <div class="to-up"><i class="fa-solid fa-caret-up"></i></div>
        </div>
        @include('layouts.footer')
