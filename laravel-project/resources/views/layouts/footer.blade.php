<footer class="footer">
    <div class="container">
        <div class="footer-copyright">
            <div class="copyright">@Copyright</div>
            <div class="made-with">Made with use of Laravel, Bootstrap 5 and Font Awesome</div>
        </div>
        <ul class="footer-list">
            <li class="footer-item"><a href="https://t.me/astromeownt" target="blank"><i class="fa-brands fa-telegram"></i></a></li>
            <li class="footer-item"><a href="https://github.com/kristina130204" target="blank"><i class="fa-brands fa-github"></i></a></li>
            <li class="footer-item"><a href="https://www.linkedin.com/in/kristina-danylova-86721a247/" target="blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
        </ul>
        <div class="footer-end">
            <ul class="footer-categories">
                @foreach ($categories_sidebar as $item)
                    <li class="category"><a href="/cat/{{$item->slug}}">{{$item->name}}</a></li>
                @endforeach
            </ul>     
        <ul class="footer-tags">
            @foreach ($tags_nav as $item)
                <li class="tag"><a href="/tag/{{$item->slug}}">{{$item->name}}</a></li>
            @endforeach
        </ul>
        </div>

    </div>
</footer>
</div>
<script src="https://kit.fontawesome.com/ef33cec68a.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('js/share.js') }}"></script>
</body>
</html>