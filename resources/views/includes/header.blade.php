<div class="navbar top">
    <div class="navTopRow">
        <div class="navTopCol logo {{Request::path() === '/' ? 'active' : ''}}">
            <div>
                <a href="/">
                    <img src="https://storage.buzzsprout.com/variants/U9cdKhRYM59B46nTAoSLnrHZ/8d66eb17bb7d02ca4856ab443a78f2148cafbb129f58a3c81282007c6fe24ff2" alt="SnagPodcast">
                </a>
            </div>
        </div>
        <div class="navTopCol white {{Request::path() === 'about' ? 'active' : ''}}">
            <a href="/about">About</a>
        </div>
        <div class="navTopCol white {{Request::path() === 'contact' ? 'active' : ''}}">
            <a href="/contact">Contact</a>
        </div>
    </div>
</div>