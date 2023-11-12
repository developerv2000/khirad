@extends('layouts.app')
@section('main')

<div class="main__inner search-page">
    <section class="search-section">
        <div class="search-section__inner main-container">
            <h1 class="main-title search-section__title">Ҷӯстуҷӯи китобҳо</h1>
            <div class="alert">
                <span class="material-icons alert__icon">info</span>
                <p class="alert__text">Ҷӯстуҷӯ тавассути вожаи <b>"{{ $keyword }}"</b> {{ $booksCount }} натиҷа пайдо шуд.</p>
            </div>

            <x-books-list :books="$books" />
        </div>
    </section>
</div>

@endsection