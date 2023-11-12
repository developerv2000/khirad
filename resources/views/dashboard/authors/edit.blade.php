@extends('dashboard.layouts.app')
@section("main")

<form action="{{ route($modelShortcut . '.update') }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $item->id }}">

    <div class="form-group">
        <label class="required">Имя</label>
        <input type="text" class="form-input" name="name" value="{{ old('name') ?? $item->name }}" required />
    </div>

    <div class="form-group">
        <label class="required">Биография</label>
        <textarea class="form-textarea" name="biography" rows="7" required>{{ old('biography') ?? $item->biography }}</textarea>
    </div>

    <div class="form-group">
        <label>Изображение</label>
        <input class="form-input" name="image" type="file" accept=".png, .jpg, .jpeg"
        data-action="show-image-from-local" data-target="local-image">

        <img class="form-image" src="{{ asset('img/authors/' . $item->image) }}" id="local-image">
    </div>

    <div class="form-group">
        <label class="required">Является ли автор зарубежным автором?</label>
        <select class="selectize-singular" name="foreign" required>
            <option value="0" @selected(!$item->foreign)>Нет</option>
            <option value="1" @selected($item->foreign)>Да</option>
        </select>
    </div>

    <div class="form-group">
        <label class="required">Добавить в популярные авторы?</label>
        <select class="selectize-singular" name="popular" required>
            <option value="0" @selected(!$item->popular)>Нет</option>
            <option value="1" @selected($item->popular)>Да</option>
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