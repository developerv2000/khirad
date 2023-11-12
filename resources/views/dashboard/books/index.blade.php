@extends('dashboard.layouts.app')
@section("main")

@include('dashboard.layouts.search')

{{-- Table form start --}}
<form action="{{ route($modelShortcut . '.destroy') }}" method="POST" class="table-form" id="table-form">
    @csrf
    {{-- Table start --}}
    <table class="main-table" cellpadding = "8" cellspacing = "10">
        {{-- Table Head start --}}
        <thead>
            <tr>
                {{-- Empty space for checkbox --}}
                <th width="20"></th>

                @php $reversedOrderType = App\Helpers\Helper::reverseOrderType($orderType); @endphp

                <th width="100">
                    Обложка
                </th>

                <th width="300">
                    <a class="{{ $orderType }} {{ $orderBy == 'title' ? 'active' : '' }}" href="{{ route('dashboard.index') }}?page={{ $activePage }}&orderBy=title&orderType={{ $reversedOrderType }}">Название</a>
                </th>

                <th>
                    <a class="{{ $orderType }} {{ $orderBy == 'author_names' ? 'active' : '' }}" href="{{ route('dashboard.index') }}?page={{ $activePage }}&orderBy=author_names&orderType={{ $reversedOrderType }}">Автор</a>
                </th>

                <th>
                    <a class="{{ $orderType }} {{ $orderBy == 'category_titles' ? 'active' : '' }}" href="{{ route('dashboard.index') }}?page={{ $activePage }}&orderBy=category_titles&orderType={{ $reversedOrderType }}">Категории</a>
                </th>

                <th>
                    <a class="{{ $orderType }} {{ $orderBy == 'price' ? 'active' : '' }}" href="{{ route('dashboard.index') }}?page={{ $activePage }}&orderBy=price&orderType={{ $reversedOrderType }}">Цена</a>
                </th>

                <th>
                    <a class="{{ $orderType }} {{ $orderBy == 'created_at' ? 'active' : '' }}" href="{{ route('dashboard.index') }}?page={{ $activePage }}&orderBy=created_at&orderType={{ $reversedOrderType }}">Дата добавления</a>
                </th>

                <th width="120">
                    Действие
                </th>
            </tr>
        </thead>  {{-- Table Head end --}}

        {{-- Table Body start --}}
        <tbody>
            @foreach ($items as $item)
                <tr>
                    {{-- Checkbox for multidelete --}}
                    <td>
                        <div class="checkbox">
                            <label for="item{{$item->id}}">
                                <input id="item{{$item->id}}" type="checkbox" name="id[]" value="{{$item->id}}">
                                <span></span>
                            </label>
                        </div>
                    </td>

                    <td><img src="{{ asset('img/books/thumbs/' . $item->image) }}"></td>
                    <td>{{ $item->title }}</td>

                    <td>
                        @if($orderBy == 'author_names')
                            {!! str_replace(',', '<br>', $item->author_names) !!}
                        @else
                            @foreach ($item->authors as $author)
                                {{ $author->name }}
                                @if(!$loop->last)
                                    <br>
                                @endif
                            @endforeach
                        @endif
                    </td>

                    <td>
                        @if($orderBy == 'category_titles')
                            {!! str_replace(',', '<br>', $item->category_titles) !!}
                        @else
                            @foreach ($item->categories as $category)
                                {{ $category->title }}
                                @if(!$loop->last)
                                    <br>
                                @endif
                            @endforeach
                        @endif
                    </td>

                    <td>{{ $item->price == '0' ? 'Бесплатная' : $item->price . ' сом.' }}</td>
                    <td>{{ Carbon\Carbon::create($item->created_at)->locale('ru')->isoFormat('DD MMMM YYYY HH:mm') }}</td>

                    {{-- Actions --}}
                    <td>
                        <div class="table__actions">
                            <a class="button--main" href="{{ route('books.show', $item->slug) }}" target="_blank"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Посмотреть">
                                <span class="material-icons">visibility</span>
                            </a>

                            <a class="button--secondary" href="{{ route($modelShortcut . '.edit', $item->id) }}" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать">
                                <span class="material-icons">edit</span>
                            </a>

                            <button class="button--danger" type="button" data-action="show-single-item-destroy-modal" data-item-id="{{ $item->id }}"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить">
                                <span class="material-icons">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>  {{-- Table Body end --}}
    </table>  {{-- Table end --}}

    {{ $items->links('dashboard.layouts.pagination') }}
</form>  {{-- Table form end --}}


@include('dashboard.modals.single-item-destroy')
@include('dashboard.modals.multiple-items-destroy')

@endsection