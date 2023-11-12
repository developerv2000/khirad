@extends('dashboard.layouts.app')
@section("main")

<form action="{{ route($modelShortcut . '.update') }}" method="POST" data-on-submit="show-spinner" class="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $item->id }}">

    <div class="form-group">
        <label class="required">Заголовок</label>
        <input type="text" class="form-input" name="title" value="{{ old('title') ?? $item->title }}" required />
    </div>

    <div class="form-group">
        <label class="required">Описание</label>
        <textarea class="form-textarea" name="description" rows="7" required>{{ old('description') ?? $item->description }}</textarea>
    </div>

    <div class="form-group">
        <label>Обложка</label>
        <input class="form-input" name="image" type="file" accept=".png, .jpg, .jpeg"
        data-action="show-image-from-local" data-target="local-image">

        <img class="form-image" src="{{ asset('img/books/' . $item->image) }}" id="local-image">
    </div>

    <div class="form-group">
        <label>Книга (pdf файл) : <a href="/books/{{ $item->filename }}" target="_blank">{{ $item->filename }}</a></label>
        <input class="form-input" name="filename" type="file" accept=".pdf">
    </div>

    <div class="form-group">
        <label class="required">Цена. Оставьте 0 если книга бесплатная</label>
        <input type="number" class="form-input" name="price" value="{{ old('price') ?? $item->price }}" required />
    </div>

    <div class="form-group">
        <label class="required">Издатель</label>
        <input type="text" class="form-input" name="publisher" value="{{ old('publisher') ?? $item->publisher }}" required />
    </div>

    <div class="form-group">
        <label class="required">Год выпуска</label>
        <input type="number" class="form-input" name="publish_year" value="{{ old('publish_year') ?? $item->publish_year }}" required />
    </div>

    <div class="form-group">
        <label class="required">Количество страниц</label>
        <input type="number" class="form-input" name="pages" value="{{ old('pages') ?? $item->pages }}" required />
    </div>

    <div class="form-group">
        <label class="required">Автор</label>
        <select class="selectize-multiple" name="authors[]" multiple="multiple" required>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}"
                    @foreach ($item->authors as $itemAuth)
                        @selected($author->id == $itemAuth->id)
                    @endforeach
                    >{{ $author->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label class="required">Категории</label>
        <select class="selectize-multiple" name="categories[]" multiple="multiple" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @foreach ($item->categories as $itemCat)
                        @selected($category->id == $itemCat->id)
                    @endforeach
                    >{{ $category->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label class="required">Добавить в Серхондатарин китобҳои ҷаҳон?</label>
        <select class="selectize-singular" name="most_readable" required>
            <option value="0" @selected(!$item->most_readable)>Нет</option>
            <option value="1" @selected($item->most_readable)>Да</option>
        </select>
    </div>

    <div class="form__actions">
        <button class="button button--success" type="submit">
            <span class="material-icons">done_all</span> Обновить
        </button>

        <button class="button button--danger" type="button" data-bs-toggle="modal" data-bs-target="#destroy-single-item-modal">
            <span class="material-icons">remove_circle</span> Удалить
        </button>
    </div>

</form>

@include('dashboard.modals.single-item-destroy', ['destroyItemId' => $item->id ])

@endsection