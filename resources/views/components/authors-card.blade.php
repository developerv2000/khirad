@props(['author', 'class' => ''])

<div class="authors-card {{ $class }}">
    <a class="authors-card__link" href="{{ route('authors.show', $author->slug) }}">
        <img class="authors-card__image" src="{{ asset('img/authors/thumbs/' . $author->image) }}" alt="{{ $author->name }}">
    </a>

    <h3 class="authors-card__name">{{ $author->name }}</h3>
</div>