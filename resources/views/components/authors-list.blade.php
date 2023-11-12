@props(['authors'])

<ul class="authors-list">
    @foreach ($authors as $author)
        <li class="authors-list__item">
            <x-authors-card :author="$author" />
        </li>
    @endforeach

    {{ $authors->links('layouts.pagination') }}
</ul>