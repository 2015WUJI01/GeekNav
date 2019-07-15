<!DOCTYPE html>
<html>
<head>
    <title>{{ env("APP_NAME") }} | 主页</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body data-spy="scroll" data-target="#myScrollspy" data-offset="0">
<div class="container">
    @include('layouts.nav')

    <div class="row">
        <nav class="col-md-2 col-12 d-none d-md-block d-lg-block p-4" id="myScrollspy">
            <ul class="nav nav-pills flex-column">
                @foreach ($categories as $key => $category)
                    <li class="nav-item">
                        <a class="nav-link {{ $key==0?"active":"" }}"
                           href="#category-{{ $category->id }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
        <div class="col-md-10 col-12 p-0">
            <div class="a-placeholder position-relative"></div>
            @include('layouts.msg')
            @foreach ($categories as $category)
                <div class="row category">
                    <div id="category-{{ $category->id }}" class="a-placeholder position-absolute offset"></div>
                    <h4 class="col-12 pl-4">{{ $category->name }}</h4>
                    @foreach ($category->links()->orderBy('visited','desc')->get() as $link)
                        <div class="col-lg-3 col-md-4 col-sm-4 col-6 px-2 py-0 m-0 mb-3">
                            <a class="item d-block" target="_blank" href="{{ urldecode($link->url) }}"
                               linkid="{{ $link->id }}">
                                <div class="logo">
                                    @if($link->logo)
                                        <div class="el-image">
                                            <img src="{{ $link->logo }}" class="el-image__inner">
                                        </div>
                                    @endif
                                    <span>{{ $link->name }}</span>
                                </div>
                                <div class="desc">{{ $link->description }}</div>
                                <div class="text-right text-muted small"><span
                                        class="visited">{{ $link->visited }}</span> 访问
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    $(function () {
        $(".item").click(function () {
            var link = $(this);
            $.ajax({
                url: "<?php echo url('/link/'); ?>" + '/' + this.getAttribute("linkid") + '/visit',
                type: "POST",
                data: {_token: '<?php echo csrf_token()?>'},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    data = JSON.parse(data);
                    console.log(data);
                    $("[linkid="+data.id+"]").find(".visited").text(data.visited);
                }
            });
        });
    });
</script>
</body>
</html>
