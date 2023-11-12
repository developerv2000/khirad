@props(['book', 'class' => ''])

<div class="books-card {{ $class }}">
    <a class="books-card__link" href="{{ route('books.show', $book->slug) }}">
        <figure class="books-card__figure shiny-effect">
            <img class="books-card__image" src="{{ asset('img/books/thumbs/' . $book->image) }}" alt="{{ $book->title }}">
        </figure>
    </a>

    <div class="books-card__text-content">
        <h2 class="books-card__title">{{ $book->title }}</h2>
        <p class="books-card__author"> 
            @foreach ($book->authors as $author)
                {{ $author->name }}
            @endforeach
        </p>
    </div>
</div>