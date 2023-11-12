<header class="header" id="header">
    {{-- Title start --}}
    <h1 class="header__title">
        {{-- first level --}}
        @if(strpos($route, 'books') !== false  || $route == 'dashboard.index') Книги 
        @elseif(strpos($route, 'authors') !== false) Авторы
        @elseif(strpos($route, 'categories') !== false) Категории
        @elseif(strpos($route, 'orders') !== false) Заказы
        @endif

        {{-- First levels items count --}}
        @if( strpos($route, 'index') ) ({{ count($allItems) }}) @endif

        {{-- second level for CREATE --}}
        @if(strpos($route, 'create') ) / Добавить

        {{-- second level for EDIT --}}
        @elseif($route == 'books.edit') / {{ $item->title }}
        @elseif($route == 'authors.edit') / {{ $item->name }}
        @elseif($route == 'categories.edit') / {{ $item->title }}
        @elseif($route == 'orders.edit') / {{ $item->book->title }}
        @endif
    </h1>  {{-- Title end --}}

    {{-- Actions start --}}
    <div class="header__actions">
        {{-- Create Items for index routes --}}
        @switch($route)
            @case('dashboard.index')
            @case('authors.dashboard.index')
            @case('categories.dashboard.index')
                <a href="{{ route($modelShortcut . '.create') }}">
                    <span class="material-icons">add</span> Добавить
                </a>
            @break
        @endswitch

        {{-- Destroy Multiple Items actions for index routes --}}
        @switch($route)
            @case('dashboard.index')
            @case('authors.dashboard.index')
            @case('categories.dashboard.index')
            @case('orders.dashboard.index')
                <button id="header-select-all-button">
                    <span class="material-icons">done_all</span> Отметить все
                </button>

                <button data-bs-toggle="modal" data-bs-target="#destroy-multiple-items-form">
                    <span class="material-icons">clear</span> Удалить отмеченные
                </button>
            @break
        @endswitch
    </div>  {{-- Actions end --}}
</header>