<div class="tags-nav-div">
    <ul class="tags-nav">
        @foreach ($tags_nav as $tag)
            <li class="tag">
                <a href="/tag/{{$tag->slug}}" class="tag @if(request()->is("tag/".$tag->slug)) active-tag @endif">
                    {{$tag->name}}
                </a>
            </li>
        @endforeach
        
    </ul>
    {{-- <div class="item-dropdown">
        <ul class="categ">
            <li class="tag-toggle-li dropdown">
                <a class="tag-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Categories
                </a>
                <ul class="dropdown-menu">
                    @foreach ($categories_sidebar as $item)
                        <li>
                            <a aria-current="page" href="/cat/{{$item->slug}}"><span class="tag">{{$item->name}}</span></a>
                        </li>
                    @endforeach
                </ul>
              </li>
        </ul>
        <ul class="tags">
            <li class="tag-toggle-li dropdown">
                <a class="tag-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Tags
                </a>
                <ul class="dropdown-menu">
                    @foreach ($tags_nav as $tag)
                        <li>
                            <a href="/tag/{{$tag->slug}}" class="tag">
                                {{$tag->name}}
                            </a>
                        </li>
                     @endforeach
                </ul>
              </li>
        </ul>
    </div> --}}
</div>