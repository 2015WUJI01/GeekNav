<div class="sidebar-menu toggle-others fixed">
    <div class="sidebar-menu-inner">
        <header class="logo-env">
            <!-- logo -->
            <div class="logo">
                <a href="index.html" class="logo-expanded">
                    <img src="../assets/images/logo@2x.png" width="100%" alt=""/>
                </a>
                <a href="index.html" class="logo-collapsed">
                    <img src="../assets/images/logo-collapsed@2x.png" width="40" alt=""/>
                </a>
            </div>
            <div class="mobile-menu-toggle visible-xs">
                <a href="#" data-toggle="user-info-menu">
                    <i class="linecons-cog"></i>
                </a>
                <a href="#" data-toggle="mobile-menu">
                    <i class="fa-bars"></i>
                </a>
            </div>
        </header>
        <ul id="main-menu" class="main-menu">
            @foreach ($categories as $key => $category)
                <li>
                    <a href="#category-{{ $category->id }}" class="smooth">
                        <i class="linecons-star"></i>
                        <span class="title">{{ $category->name }}</span>
                    </a>
                </li>
            @endforeach
{{--            <li>--}}
{{--                <a href="#常用推荐" class="smooth">--}}
{{--                    <i class="linecons-star"></i>--}}
{{--                    <span class="title">常用推荐</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a>--}}
{{--                    <i class="linecons-lightbulb"></i>--}}
{{--                    <span class="title">灵感采集</span>--}}
{{--                </a>--}}
{{--                <ul>--}}
{{--                    <li>--}}
{{--                        <a href="#发现产品" class="smooth">--}}
{{--                            <span class="title">发现产品</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <div class="submit-tag">--}}
{{--                <a href="about.html">--}}
{{--                    <i class="linecons-heart"></i>--}}
{{--                    <span class="tooltip-blue">添加导航</span>--}}
{{--                    <span class="label label-Primary pull-right hidden-collapsed">♥︎</span>--}}
{{--                </a>--}}
{{--            </div>--}}
        </ul>
    </div>
</div>