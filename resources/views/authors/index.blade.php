@extends('layouts.app')
@section('main')

@section('title', $title)

<div class="main__inner authors-index-page">
    <section class="authors-search-section">
        <div class="authors-search-section__inner main-container">
            <h1 class="authors-search-section__title  main-title">{{ $title }}</h1>

            {{-- Search start --}}
            <div class="search authors-search">
                <div class="selectize-singular-container">
                    <select class="selectize-singular-linked" placeholder="Муаллифи лозимаро пайдо намоед...">
                        <option></option>
                        @foreach($allAuthors as $author)
                            <option value="{{ route('authors.show', $author->slug) }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>  {{-- Search end --}}

            {{-- Filter Start --}}
            <div class="authors-filter">
                <h3 class="authors-filter__title">Полоиш аз рӯйи алифбо :</h3>

                <ul class="authors-filter__list">
                    @foreach ($filterLetters as $letter)
                        <li>
                            <a class="authors-filter__link {{ $letter == $activeLetter ? 'authors-filter__link--active' : '' }}" href="{{ route('authors.index') }}?letter={{ $letter }}{{ $popular ? '&popular=true' : '' }}">{{ $letter }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>  {{-- Filter end --}}

            <x-authors-list :authors="$authors" />
        </div>
    </section>
</div>

@endsection