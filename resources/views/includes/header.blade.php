<div class="navbar top">

    <div class="navTopRow">
        <div class="navTopCol logo">
            <div class="logo-container {{Request::path() === '/' ? 'active' : ''}}">
                <a href="/">
                    <img src="../images/snagPodcast-logo-dark.jpg" alt="SnagPodcast">
                </a>
            </div>
        </div>
        <div class="navTopCol white link">
            <div class="link-container {{Request::path() === 'about' ? 'active' : ''}}">
                <a href="/about">About</a>
            </div>
        </div>
        <div class="navTopCol white link">
            <div class="link-container {{Request::path() === 'contact' ? 'active' : ''}}">
                <a href="/contact">Contact</a>
            </div>
        </div>
    </div>

    {{-- <div class="banner">
        <div class="text white">
            NAVIGATING <span>THE SNAGS</span> OF LIFE ON STORY AT A TIME
        </div>
    </div> --}}

</div>