@props(['books'])

<div class="owl-carousel-container">
    <div class="owl-carousel most-readable-books-carousel" id="most-readable-books-carousel">
        @foreach ($books as $book)
            <div class="most-readable-books-carousel__item horizontal-card">
                <img class="horizontal-card__mobile-image" src="{{ asset('img/books/' . $book->image) }}" alt="{{ $book->title }}">
                <h2 class="horizontal-card__title">{{ $book->title }}</h2>

                <div class="horizontal-card__row">
                    <div class="horizontal-card__text-content">
                        <p class="horizontal-card__author">
                            <span class="material-icons">account_circle</span> {{ $book->authors()->first()->name }}
                        </p>
                        <p class="horizontal-card__description">{{ $book->description }}</p>                                
                        <a href="{{ route('books.show', $book->slug) }}" class="horizontal-card__button">
                            Муфассал <span class="material-icons-outlined">east</span>
                        </a>
                    </div>

                    <div class="horizontal-card__image-container">
                        <figure class="horizontal-card__figure shiny-effect">
                            <img class="horizontal-card__image" src="{{ asset('img/books/thumbs/' . $book->image) }}" alt="{{ $book->title }}">
                        </figure>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>