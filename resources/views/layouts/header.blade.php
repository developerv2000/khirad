<header class="header">
    <div class="header__inner main-container">
        <a href="{{ route('home') }}" class="logo header__logo">
            <img class="logo__image" src="{{ asset('img/main/logo.png') }}" alt="Хирад лого">
        </a>

        <img class="mobile-menu-toggler" src="{{ asset('img/main/menu.svg') }}" data-action="toggle-mobile-menu" alt="menu">

        {{-- Header Nav --}}
        <nav class="header-nav">
            <ul class="header-nav__ul">
                <li class="header-nav__li">
                    <a href="{{ route('home') }}" class="header-nav__link">Асосӣ</a>
                </li>

                <li class="header-nav__li categories-dropdown">
                    <button class="header-nav__link categories-dropdown__button">Дастабандӣ <span class="material-icons">arrow_drop_down</span></button>

                    <div class="categories-dropdown__content">
                        <ul class="categories-dropdown__list">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('categories.show', $category->slug) }}">{{ $category->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li class="header-nav__li">
                    <a href="{{ route('books.index') }}" class="header-nav__link">Ҳамаи китобҳо</a>
                </li>

                <li class="header-nav__li">
                    <a href="{{ route('categories.show', 'kitobhoi-horiji') }}" class="header-nav__link">Китобҳои хориҷӣ</a>
                </li>

                <li class="header-nav__li">
                    <a href="{{ route('authors.index') }}" class="header-nav__link">Муаллифон</a>
                </li>

                <li class="header-nav__li">
                    <a href="{{ route('contacts') }}" class="header-nav__link">Тамос</a>
                </li>

                <li class="header-nav__li">
                    <form class="header-nav__form" action="{{ route('downloadApk') }}" method="POST">
                        @csrf
                        <button class="header-nav__button">Барномаи андроид</button>
                    </form>
                </li>
            </ul>
        </nav> {{-- Header Nav end --}}

        {{-- Global Search --}}
        <form class="header-search" action="{{ route('search') }}" method="GET" id="header-search-form">
            <input class="header-search__input header-search__input--hidden" type="text" list="header-search-datalist" autocomplete="off" name="keyword" id="header-search-input"
                placeholder="Ҷӯстуҷӯ..." minlength="3" required>
            <datalist id="header-search-datalist">
                @foreach ($searchAuthorKeywords as $keyword)
                    <option value="{{ $keyword }}">
                @endforeach

                @foreach ($searchBookKeywords as $keyword)
                    <option value="{{ $keyword }}">
                @endforeach
            </datalist>

            <button class="header-search__button button--transparent" type="button" id="header-search-button">
                <span class="material-icons-outlined">search</span>
            </button>
        </form> {{-- global seach end --}}

        {{-- Mobile Menu --}}
        <div class="mobile-menu">
            <div class="mobile-menu__overlay" data-action="toggle-mobile-menu"></div>

            <nav class="mobile-menu__nav">
                <button class="mobile-menu__close-btn button--transparent" data-action="toggle-mobile-menu">
                    <span class="material-icons-outlined">arrow_forward_ios</span>
                </button>

                {{-- Mobile Search --}}
                <form class="mobile-search" action="{{ route('search') }}" method="GET">
                    <input class="mobile-search__input" type="text" list="header-search-datalist" autocomplete="off" name="keyword" placeholder="Ҷӯстуҷӯи китобҳо..." minlength="3" required>

                    <button class="mobile-search__button" type="submit">
                        <span class="material-icons-outlined">search</span>
                    </button>
                </form> {{-- Mobile Search end --}}

                <ul class="mobile-menu__ul">
                    <li class="mobile-menu__li">
                        <a class="mobile-menu__link" href="{{ route('home') }}">Асосӣ</a>
                    </li>

                    <div class="collapse mobile-menu-collapse">
                        <button class="collapse__button"> Дастабандӣ
                            <span class="material-icons-outlined collapse__icon">expand_more</span>
                        </button>

                        <div class="collapse__body">
                            <ul class="mobile-menu-collapse__ul">
                                @foreach ($categories as $category)
                                    <li class="mobile-menu-collapse__li">
                                        <a class="mobile-menu-collapse__link" href="{{ route('categories.show', $category->slug) }}">{{ $category->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <li class="mobile-menu__li">
                        <a class="mobile-menu__link" href="{{ route('books.index') }}">Ҳамаи китобҳо</a>
                    </li>

                    <li class="mobile-menu__li">
                        <a class="mobile-menu__link" href="{{ route('categories.show', 'kitobhoi-horiji') }}">Китобҳои хориҷӣ</a>
                    </li>

                    <li class="mobile-menu__li">
                        <a class="mobile-menu__link" href="{{ route('authors.index') }}">Муаллифон</a>
                    </li>

                    <li class="mobile-menu__li">
                        <a class="mobile-menu__link" href="{{ route('contacts') }}">Тамос</a>
                    </li>
                </ul>
            </nav>
        </div> {{-- Mobile Menu end --}}

    </div>
</header>
