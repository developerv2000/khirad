@extends('dashboard.layouts.app')
@section("main")

@if($activePage == 1)
    <div class="alert alert-warning">
        <span class="material-icons">info</span>
        При удалении автора, также удалятся все его книги!
    </div>
@endif

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

                <th width="130">
                    Изображение
                </th>

                <th width="200">
                    <a class="{{ $orderType }} {{ $orderBy == 'name' ? 'active' : '' }}" href="{{ route($modelShortcut . '.dashboard.index') }}?page={{ $activePage }}&orderBy=name&orderType={{ $reversedOrderType }}">Имя</a>
                </th>

                <th>
                    Биография
                </th>

                <th>
                    <a class="{{ $orderType }} {{ $orderBy == 'foreign' ? 'active' : '' }}" href="{{ route($modelShortcut . '.dashboard.index') }}?page={{ $activePage }}&orderBy=foreign&orderType={{ $reversedOrderType }}">Национальность</a>
                </th>

                <th>
                    <a class="{{ $orderType }} {{ $orderBy == 'popular' ? 'active' : '' }}" href="{{ route($modelShortcut . '.dashboard.index') }}?page={{ $activePage }}&orderBy=popular&orderType={{ $reversedOrderType }}">Популярность</a>
                </th>

                <th>
                    <a class="{{ $orderType }} {{ $orderBy == 'books_count' ? 'active' : '' }}" href="{{ route($modelShortcut . '.dashboard.index') }}?page={{ $activePage }}&orderBy=books_count&orderType={{ $reversedOrderType }}">Кол-во книг</a>
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

                    <td><img src="{{ asset('img/authors/thumbs/' . $item->image) }}"></td>
                    <td>{{ $item->name }}</td>
                    <td>{{ mb_strlen($item->biography) > 200 ? (mb_substr($item->biography, 0, 200) . '...') : $item->biography }}</td>
                    <td>{{ $item->foreign ? 'Зарубежный' : 'Таджик' }}</td>
                    <td>{{ $item->popular ? 'Популярный' : '' }}</td>
                    <td>{{ $item->books_count }}</td>

                    {{-- Actions --}}
                    <td>
                        <div class="table__actions">
                            <a class="button--main" href="{{ route('authors.show', $item->slug) }}" target="_blank"
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