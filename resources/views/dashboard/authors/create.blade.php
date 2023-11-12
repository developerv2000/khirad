@extends('dashboard.layouts.app')
@section("main")

<form action="{{ route($modelShortcut . '.store') }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label class="required">Имя</label>
        <input type="text" class="form-input" name="name" value="{{ old('name') }}" required />
    </div>

    <div class="form-group">
        <label class="required">Биография</label>
        <textarea class="form-textarea" name="biography" rows="7" required>{{ old('biography') }}</textarea>
    </div>

    <div class="form-group">
        <label class="required">Изображение</label>
        <input class="form-input" name="image" type="file" accept=".png, .jpg, .jpeg" required
        data-action="show-image-from-local" data-target="local-image">

        <img class="form-image" src="{{ asset('img/dashboard/default-image.png') }}" id="local-image">
    </div>

    <div class="form-group">
        <label class="required">Является ли автор зарубежным автором?</label>
        <select class="selectize-singular" name="foreign" required>
            <option value="0">Нет</option>
            <option value="1">Да</option>
        </select>
    </div>

    <div class="form-group">
        <label class="required">Добавить в популярные авторы?</label>
        <select class="selectize-singular" name="popular" required>
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