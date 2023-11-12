@extends('dashboard.layouts.app')
@section("main")

<form action="{{ route($modelShortcut . '.store') }}" method="POST" data-on-submit="show-spinner" class="form" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label class="required">Заголовок</label>
        <input type="text" class="form-input" name="title" value="{{ old('title') }}" required />
    </div>

    <div class="form-group">
        <label class="required">Описание</label>
        <textarea class="form-textarea" name="description" rows="7" required>{{ old('description') }}</textarea>
    </div>

    <div class="form-group">
        <label class="required">Обложка</label>
        <input class="form-input" name="image" type="file" accept=".png, .jpg, .jpeg" required
        data-action="show-image-from-local" data-target="local-image">

        <img class="form-image" src="{{ asset('img/dashboard/default-image.png') }}" id="local-image">
    </div>

    <div class="form-group">
        <label class="required">Книга (pdf файл)</label>
        <input class="form-input" name="filename" type="file" accept=".pdf" required>
    </div>

    <div class="form-group">
        <label class="required">Цена. Оставьте 0 если книга бесплатная</label>
        <input type="number" class="form-input" name="price" value="{{ old('price') ?? 0 }}" required />
    </div>

    <div class="form-group">
        <label class="required">Издатель</label>
        <input type="text" class="form-input" name="publisher" value="{{ old('publisher') }}" required />
    </div>

    <div class="form-group">
        <label class="required">Год выпуска</label>
        <input type="number" class="form-input" name="publish_year" value="{{ old('publish_year') }}" required />
    </div>

    <div class="form-group">
        <label class="required">Количество страниц</label>
        <input type="number" class="form-input" name="pages" value="{{ old('pages') }}" required />
    </div>

    <div class="form-group">
        <label class="required">Автор</label>
        <select class="selectize-multiple" name="authors[]" multiple="multiple" required>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}">{{ $author->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label class="required">Категории</label>
        <select class="selectize-multiple" name="categories[]" multiple="multiple" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label class="required">Добавить в Серхондатарин китобҳои ҷаҳон?</label>
        <select class="selectize-singular" name="most_readable" required>
            <option value="0">Нет</option>
            <option value="1">Да</option>
        </select>
    </div>

    <div class="form__actions">
        <button class="button button--success" type="submit">
            <span class="material-icons">done_all</span> Добавить
        </button>
    </div>

</form>

@endsection