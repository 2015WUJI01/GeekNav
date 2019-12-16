@extends('layouts._app')

@section('title', '首页')

@section('style')
    <style>
        .sidebar-menu {
            width: 220px; /* 侧边栏窄一点 */
        }
        .xe-widget.xe-conversations {
            padding: 10px; /* 覆写链接卡片padding */
        }
        .box2 {
            height: 86px; /* 覆写链接卡片大小 */
        }
        p.overflowClip_2 {
            height: 33px; /* 卡片固定卡片描述高度 */
        }
        p.overflowClip_2,
        p.overflowClip_3 {
            font-size: 12px; /* 缩小卡片描述及访问字体大小 */
        }
    </style>
@endsection
@section('content')
    <div class="page-container">
        @include('layouts._sidebar', ['categories' => $categories])
        <div class="main-content">
            @include('layouts._navbar')

            @foreach ($categories as $category)
                <!-- {{ $category->name }} -->
                <h4 class="text-gray">
                    <i class="linecons-tag" style="margin-right: 7px;" id="category-{{ $category->id }}"></i>
                    {{ $category->name }}
                </h4>
                <div class="row">
                    @foreach ($category->links()->orderBy('visited','desc')->get() as $link)
                        <div class="col-xs-6 col-sm-4 col-md-3">
                            <div class="xe-widget xe-conversations box2 label-info" linkid="{{ $link->id }}"
                                 onclick="window.open('{{ urldecode($link->url) }}', '_blank')" data-toggle="tooltip"
                                 data-placement="top" title="" data-original-title="{{ urldecode($link->url) }}">
                                <div class="xe-comment-entry">
                                    @if($link->logo)
                                        <a class="xe-user-img">
                                            <img src="{{ $link->logo }}" class="img-circle" width="40">
                                        </a>
                                    @endif
                                    <div class="xe-comment">
                                        <a href="#" class="xe-user-name overflowClip_1">
                                            <strong>{{ $link->name }}</strong>
                                        </a>
                                        <p class="overflowClip_2">{{ $link->description }}</p>
                                        <p class="overflowClip_3 text-right"><span class="visited">{{ $link->visited }}</span> 访问</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
{{--                    @include('layouts._site_card')--}}
                </div>
                <br/>
                <!-- END {{ $category->name }} -->
            @endforeach


            @include('layouts._footer')
        </div>
    </div>
@endsection

@section('script')
    <!-- 点击增加访问次数 -->
    <script>
        $(function () {
            $(".box2").click(function () {
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
                        // console.log(data);
                        $("[linkid="+data.id+"]").find(".visited").text(data.visited);
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('/assets/webstack/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/webstack/js/TweenMax.min.js') }}"></script>
    <script src="{{ asset('/assets/webstack/js/resizeable.js') }}"></script>
    <script src="{{ asset('/assets/webstack/js/joinable.js') }}"></script>
    <script src="{{ asset('/assets/webstack/js/xenon-api.js') }}"></script>
    <script src="{{ asset('/assets/webstack/js/xenon-toggles.js') }}"></script>
    <script src="{{ asset('/assets/webstack/js/xenon-custom.js') }}"></script>
    <!-- 锚点平滑移动 -->
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.has-sub', function () {
                var _this = $(this);
                if (!$(this).hasClass('expanded')) {
                    setTimeout(function () {
                        _this.find('ul').attr("style", "")
                    }, 300);

                } else {
                    $('.has-sub ul').each(function (id, ele) {
                        var _that = $(this);
                        if (_this.find('ul')[0] != ele) {
                            setTimeout(function () {
                                _that.attr("style", "")
                            }, 300);
                        }
                    })
                }
            });
            $('.user-info-menu .hidden-sm').click(function () {
                if ($('.sidebar-menu').hasClass('collapsed')) {
                    $('.has-sub.expanded > ul').attr("style", "")
                } else {
                    $('.has-sub.expanded > ul').show()
                }
            });
            $("#main-menu li ul li").click(function () {
                $(this).siblings('li').removeClass('active'); // 删除其他兄弟元素的样式
                $(this).addClass('active'); // 添加当前元素的样式
            });
            $("a.smooth").click(function (ev) {
                ev.preventDefault();

                public_vars.$mainMenu.add(public_vars.$sidebarProfile).toggleClass('mobile-is-visible');
                ps_destroy();
                $("html, body").animate({
                    scrollTop: $($(this).attr("href")).offset().top - 30
                }, {
                    duration: 500,
                    easing: "swing"
                });
            });
            return false;
        });

        var href = "";
        var pos = 0;
        $("a.smooth").click(function (e) {
            $("#main-menu li").each(function () {
                $(this).removeClass("active");
            });
            $(this).parent("li").addClass("active");
            e.preventDefault();
            href = $(this).attr("href");
            pos = $(href).position().top - 30;
        });
    </script>
@endsection
