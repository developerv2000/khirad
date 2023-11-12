@extends('layouts.app')
@section('main')

@section('title', $book->title)

@section('meta-tags')
    @php
        $shareText = App\Helpers\Helper::generateShareText($book->description);
    @endphp

    <meta name="description" content="{{ $shareText }}">
    <meta property="og:description" content="{{ $shareText }}">
    <meta property="og:title" content="{{ $book->title }}" />
    <meta property="og:image" content="{{ asset('img/books/' . $book->image) }}">
    <meta property="og:image:alt" content="{{ $book->title }}">
    <meta name="twitter:title" content="{{ $book->title }}">
    <meta name="twitter:image" content="{{ asset('img/books/' . $book->image) }}">
@endsection

<div class="main__inner books-show-page">
    <section class="books-info">
        <div class="books-info__inner main-container">
            <div class="books-info__image-container">
                <figure class="books-info__figure shiny-effect">
                    <img class="books-info__image" src="{{ asset('img/books/' . $book->image) }}" alt="{{ $book->title }}">
                </figure>
            </div>

            <div class="books-info__main">
                <h1 class="books-info__title">{{ $book->title }} |
                    @foreach ($book->authors as $author)
                        {{ $author->name }}
                    @endforeach
                </h1>
                <p class="book-info__description">{!! $book->description !!}</p>

                <div class="books-info__actions">
                    <a class="button button--secondary" href="{{ route('books.read', $book->slug) }}" target="_blank">
                        <span class="material-icons">auto_stories</span> {{ $book->price > 0 ? 'Хондани қисмате аз китоб' : 'Хондани китоб' }}
                    </a>

                    @if ($book->price > 0)
                        <button class="button button--thirdinary" data-action="show-modal" data-target-id="order-modal">
                            <span class="material-icons">paid</span> Фармоиши китоб
                        </button>
                    @endif
                </div>

                <table class="book-properties-table">
                    <tbody>
                        <tr>
                            <th>Нарх:</th>
                            <td class="main-color text-bold">{{ $book->price == '0' ? 'Ройгон' : $book->price . ' сом.' }}</td>
                        </tr>

                        <tr>
                            <th>Муаллиф:</th>
                            <td>
                                @foreach ($book->authors as $author)
                                    <a href="{{ route('authors.show', $author->slug) }}">
                                        {{ $author->name }}
                                    </a>
                                @endforeach
                            </td>
                        </tr>

                        <tr>
                            <th>Ношир:</th>
                            <td>{{ $book->publisher }}</td>
                        </tr>

                        <tr>
                            <th>Соли табъ:</th>
                            <td>{{ $book->publish_year }}</td>
                        </tr>

                        <tr>
                            <th>Дастабандӣ:</th>
                            <td>
                                @foreach ($book->categories as $category)
                                    <a href="{{ route('categories.show', $category->slug) }}">
                                        {{ $category->title }}
                                    </a>
                                @endforeach
                            </td>
                        </tr>

                        <tr>
                            <th>Шумори саҳифаҳо:</th>
                            <td>{{ $book->pages }} саҳифа</td>
                        </tr>

                        <tr>
                            <th>Шумори мутолиа:</th>
                            <td>{{ $book->views }} маротиба</td>
                        </tr>

                        <tr>
                            <th>Ба иштирок гузоштан:</th>
                            <td>
                                <div class="ya-share2" data-curtain data-shape="round" data-services="vkontakte,facebook,telegram,twitter,viber"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<x-order-modal :id="$book->id" />

@endsection
