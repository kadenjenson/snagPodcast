<div class="nav-row h-full w-1/3 text-xl tracking-wide">
    <div class="nav-link logo h-10 w-auto px-3 cursor-pointer">
        <div class="logo-container">
            <a href="/">
                <img src="images/logos/snagPodcast-logo-dark.jpg" alt="SnagPodcast">
            </a>
        </div>
    </div>
    <div class="nav-link h-10 w-auto px-3 cursor-pointer {{ Request::path() === '/' ? 'active' : '' }}">
        <a href="/">Home</a>
    </div>
    <div class="nav-link h-10 w-auto px-3 cursor-pointer {{ Request::path() === 'about' ? 'active' : '' }}">
        <a href="/about">About</a>
    </div>
    <div class="nav-link h-10 w-auto px-3 cursor-pointer {{ Request::path() === 'contact' ? 'active' : '' }}">
        <a href="/contact">Contact</a>
    </div>
</div>

<div class="nav-row tagline">
    <div class="text-white text-2xl">Navigating <span>THE SNAGS</span> of Life, One Story at a Time</div>
</div>
