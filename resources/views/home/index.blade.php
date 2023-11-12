@extends('layouts.app')
@section('main')

<div class="main__inner home-page">
    {{-- Most Readable Books start --}}
    <section class="most-readable-books">
        <div class="most-readable-books__inner main-container">
            <div class="most-readable-books__title-container">
                <h1 class="secondary-title most-readable-books__title"><a href="{{ route('categories.world-most-readable') }}">Серхондатарин китобҳои ҷаҳон</a></h1>

                <div class="most-readable-books__navs-container">
                    <button class="most-readable-books__nav" id="most-readable-books-carousel-prev-button"><span class="material-icons-outlined">arrow_back_ios</span></button>
                    <button class="most-readable-books__nav" id="most-readable-books-carousel-next-button"><span class="material-icons-outlined">arrow_forward_ios</span></button>
                </div>
            </div>

            <x-most-readable-books-carousel :books="$mostReadableBooks" />
        </div>
    </section>  {{-- Most Readable Books end --}}

    {{-- Home Books start --}}
    <section class="home-books">
        <div class="home-books__inner main-container">
            {{-- Extensive search start --}}
            <h2 class="extensive-search-title secondary-title">Пайдо кардани китобҳои лозима</h2>
            <x-extensive-search />

            <div class="home-books__main">
                {{-- Reccomended books start --}}
                <div class="recommended-books">
                    <h2 class="secondary-title recommended-books__title">Китобҳои тавсияшуда</h2>

                    <ul class="recommended-books__list">
                        @foreach ($recommendedBooks as $book)
                            <li class="recommended-books__item">
                                <x-books-card :book="$book" class="books-card--horizontal" />
                            </li>
                        @endforeach
                    </ul>
                </div>  {{-- Reccomended books End --}}

                {{-- Latest books start --}}
                <div class="latest-books">
                    <h2 class="secondary-title latest-books__title"><a href="{{ route('books.index') }}">Китобҳои тозанашр</a></h2>
                    <x-books-list :books="$latestBooks" pagination="false" />
                </div>  {{-- Latest books start --}}
            </div>
        </div>
    </section>  {{-- Home Books end --}}

    <section class="home-top-books">
        <div class="home-top-books__inner main-container">
            <a href="{{ route('categories.top-books') }}" class="home-top-books__title">
                <h2 class="home-top-books__title-h2">Серхонандатарин</h2>
                <p class="home-top-books__title-p">китобҳои сомона</p>
            </a>

            <ul class="home-top-books__list">
                @foreach ($topBooks as $book)
                    <li class="home-top-books__item">
                        <x-books-card :book="$book" />
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
</div>

@endsection
