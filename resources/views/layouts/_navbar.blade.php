<nav class="navbar user-info-navbar" role="navigation">
    <!-- User Info, Notifications and Menu Bar -->
    <!-- Left links for user info navbar -->
    <ul class="user-info-menu left-links list-inline list-unstyled">
        <li class="hidden-xs">
            <a href="#" data-toggle="sidebar">
                <i class="fa-bars"></i>
            </a>
        </li>
        <li class="dropdown hover-line language-switcher">
            <a href="/" class="dropdown-toggle" data-toggle="dropdown">
                <img src="/assets/webstack/images/flags/flag-cn.png" alt="flag-cn"/> 中文
            </a>
            <ul class="dropdown-menu languages">
                <li class="active">
                    <a href="/">
                        <img src="/assets/webstack/images/flags/flag-cn.png" alt="flag-cn"/> 中文
                    </a>
                </li>
            </ul>
        </li>
        <li class="hover-line">
            <a href="{{ route('link.create') }}">
                添加导航
            </a>
        </li>
    </ul>
{{--    <a href="https://github.com/WebStackPage/WebStackPage.github.io" target="_blank">--}}
{{--        <img style="position: absolute; top: 0; right: 0; border: 0;"--}}
{{--             src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"--}}
{{--             alt="Fork me on GitHub">--}}
{{--    </a>--}}
</nav>