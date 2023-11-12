@extends('layouts.app')
@section('main')

@section('title', $author->name)

@section('meta-tags')
    @php
        $shareText = App\Helpers\Helper::generateShareText($author->biography);
    @endphp

    <meta name="description" content="{{ $shareText }}">
    <meta property="og:description" content="{{ $shareText }}">
    <meta property="og:title" content="{{ $author->name }}" />
    <meta property="og:image" content="{{ asset('img/authors/' . $author->image) }}">
    <meta property="og:image:alt" content="{{ $author->name }}">
    <meta name="twitter:title" content="{{ $author->name }}">
    <meta name="twitter:image" content="{{ asset('img/authors/' . $author->image) }}">
@endsection

<div class="main__inner authors-show-page">
    <section class="authors-biography-section">
        <div class="authors-biography-section__inner main-container">
            <img class="authors-biography__image" src="{{ asset('img/authors/' . $author->image) }}" alt="{{ $author->image }}">

            <div class="authors-biography__text-container">
                <h1 class="authors-biography__title">{{ $author->name }}</h1>
                <p class="authors-biography__text">{!! $author->biography !!}</p>
            </div>
        </div>
    </section>

    <section class="authors-books">
        <div class="authors-books__inner main-container">
            <h2 class="main-title">Китобҳои муаллиф</h2>
            <x-books-list :books="$author->books()->paginate(30)" />
        </div>
    </section>
</div>

@endsection
