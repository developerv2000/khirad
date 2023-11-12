@extends('layouts.app')
@section('main')

@section('title', $title)

@section('meta-tags')
    @php
        $shareText = $description ? App\Helpers\Helper::generateShareText($description) : '“Хирад” – маъбади аҳли илм ва меҳроби поки донишҷӯӣ ва илмомӯзӣ аст. Ҳарки аз китоб ва мутолиа бегона аст, ғариб ва бемӯнис аст.';
    @endphp

    <meta property="og:title" content="{{ $title }}" />
    <meta name="twitter:title" content="{{ $title }}">

    <meta name="description" content="{{ $shareText }}">
    <meta property="og:description" content="{{ $shareText }}">
@endsection

<div class="main__inner categories-show-page">
    <section class="category-books">
        <div class="category-books__inner main-container">
            <h1 class="category-books__title  main-title">{{ $title }}</h1>
            @if($description && $description != '' && $books->currentPage() == 1)
                <div class="alert">
                    <span class="material-icons alert__icon">info</span>
                    <p class="alert__text">{{ $description }}</p>
                </div>
            @endif

            <x-books-list :books="$books" />
        </div>
    </section>
</div>

@endsection