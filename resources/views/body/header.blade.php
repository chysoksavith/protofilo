<nav>
    <div class="main_nav">
        <div class="log-container">
            <div class="logo">
                <a href="{{ url('/') }}" style="text-decoration: none">
                    <h1>Savith</h1>
                </a>
            </div>
            <div class="logo-name">
                <p>Web Developer /////// on DEVELOP</p>
            </div>
        </div>
        <div class="nav-buttons">
            <div class="btn">
                <a href="{{ url('/projects') }}">
                    <button  data-original-text="Projects">Projects</button>
                </a>

            </div>
            <div class="btn">
                <a href="{{ url('/info') }}">
                    <button >Info</button>
                </a>
            </div>
            <div class="btn">
                <a href="{{ url('/contact') }}">
                    <button >Contact</button>
                </a>
            </div>
        </div>
    </div>
    <div>
        <button class="header__button nav-btn-js" type="button"><i class="fa-solid fa-ellipsis-vertical"></i></button>
        <nav class="header__nav nav-js" data-active="false">
            <ul class="header__menu">
                <li class="header__menu-item">
                    <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a>
                </li>
                <li class="header__menu-item">
                    <a href="{{ url('/projects') }}" class="{{ Request::is('projects') ? 'active' : '' }}">Projects</a>
                </li>
                <li class="header__menu-item">
                    <a href="{{ url('/info') }}" class="{{ Request::is('info') ? 'active' : '' }}">Info</a>
                </li>
                <li class="header__menu-item">
                    <a href="{{ url('/contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">contact</a>
                </li>
            </ul>

        </nav>
    </div>
</nav>
