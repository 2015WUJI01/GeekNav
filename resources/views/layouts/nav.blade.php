<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="/">{{ env('APP_NAME') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Request::getPathInfo() == '/' ? 'active' : '' }}">
                <a class="nav-link" href="/">主页</a>
            </li>
            <li class="nav-item {{ Request::getPathInfo() == route('category.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('link.create') }}">新增站点</a>
            </li>
            <li class="nav-item {{ Request::getPathInfo() == route('category.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('category.create') }}">新增分类</a>
            </li>
            @if(Request::getPathInfo() == '/')
                <li class="nav-item dropdown d-inline d-lg-none d-md-none">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">选择类别</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categories as $key => $category)
                            <a class="dropdown-item" href="#category-{{ $category->id }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </li>
            @endif
        </ul>
        {{--        <form class="form-inline my-2 my-lg-0">--}}
        {{--            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">--}}
        {{--            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>--}}
        {{--        </form>--}}
    </div>
</nav>
