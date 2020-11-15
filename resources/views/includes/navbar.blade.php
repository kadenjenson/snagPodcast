{{--<div class="navbar top">--}}

{{--    <div class="navRow">--}}
{{--        <div class="navCol logo">--}}
{{--            <div class="logo-container {{Request::path() === '/' ? 'active' : ''}}">--}}
{{--                <a href="/"><img src="../images/logos/snagPodcast-logo-dark.jpg" alt="SnagPodcast"></a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="navCol white">--}}
{{--            <div class="link-container {{Request::path() === '/' ? 'active' : ''}}">--}}
{{--                <a href="/">Home</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="navCol white">--}}
{{--            <div class="link-container {{Request::path() === 'about' ? 'active' : ''}}">--}}
{{--                <a href="/about">About</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="navCol white">--}}
{{--            <div class="link-container {{Request::path() === 'contact' ? 'active' : ''}}">--}}
{{--                <a href="/contact">Contact</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="banner">--}}
{{--        <div class="text white">NAVIGATING <span>THE SNAGS</span> OF LIFE, ONE STORY AT A TIME</div>--}}
{{--    </div>--}}

{{--</div>--}}

<div class="nav-row h-full w-1/3 text-xl tracking-wide">
    <div class="nav-link logo h-10 w-auto px-3 cursor-pointer {{ Request::path() === '/' ? 'active' : '' }}">
        <div class="logo-container">
            <a href="/">
                <img src="images/logos/snagPodcast-logo-dark.jpg" alt="SnagPodcast">
            </a>
        </div>
    </div>
    <div class="nav-link h-10 w-auto px-3 cursor-pointer {{ Request::path() === 'about' ? 'active' : '' }}">
        <a href="/about">About</a>
    </div>
    <div class="nav-link h-10 w-auto px-3 cursor-pointer {{ Request::path() === 'contact' ? 'active' : '' }}">
        <a href="/contact">Contact</a>
    </div>
</div>

<div class="banner">
    <div class="text white">NAVIGATING <span>THE SNAGS</span> OF LIFE, ONE STORY AT A TIME</div>
</div>
