@extends('dashboard.layouts.app')
@section("main")

@if($activePage == 1)
    <div class="alert alert-warning">
        <span class="material-icons">info</span>
        При удалении категории, также удалятся все книги находящиеся в этой категории!
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

                <th width="220">
                    <a class="{{ $orderType }} {{ $orderBy == 'title' ? 'active' : '' }}" href="{{ route($modelShortcut . '.dashboard.index') }}?page={{ $activePage }}&orderBy=title&orderType={{ $reversedOrderType }}">Заголовок</a>
                </th>

                <th>
                    Описание
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

                    <td>{{ $item->title }}</td>
                    <td>{{ mb_strlen($item->description) > 200 ? (mb_substr($item->description, 0, 200) . '...') : $item->description }}</td>
                    <td>{{ $item->books_count }}</td>

                    {{-- Actions --}}
                    <td>
                        <div class="table__actions">
                            <a class="button--main" href="{{ route('categories.show', $item->slug) }}" target="_blank"
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