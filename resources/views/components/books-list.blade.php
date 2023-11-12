@props(['books', 'pagination' => 'true'])

<ul class="books-list">
    @foreach ($books as $book)
        <li class="books-list__item">
            <x-books-card :book="$book" />
        </li>
    @endforeach

    @if($pagination == 'true')
        {{ $books->links('layouts.pagination') }}
    @endif
</ul>