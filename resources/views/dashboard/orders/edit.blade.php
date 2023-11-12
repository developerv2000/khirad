@extends('dashboard.layouts.app')
@section("main")

<form action="javascript:void(0)" method="POST" class="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $item->id }}">

    <div class="form-group">
        <label class="required">Заказчик</label>
        <input type="text" class="form-input" value="{{ $item->name }}" readonly />
    </div>

    <div class="form-group">
        <label class="required">Название книги</label>
        <input type="text" class="form-input" value="{{ $item->book->title }}" readonly />
    </div>

    <div class="form-group">
        <label class="required">Электронная почта</label>
        <input type="text" class="form-input" value="{{ $item->email }}" readonly />
    </div>

    <div class="form-group">
        <label class="required">Телефон</label>
        <input type="text" class="form-input" value="{{ $item->phone }}" readonly />
    </div>

    <div class="form-group">
        <label class="required">Адрес</label>
        <input type="text" class="form-input" value="{{ $item->address }}" readonly />
    </div>

    <div class="form-group">
        <label class="required">Дата заказа</label>
        <input type="text" class="form-input" value="{{ Carbon\Carbon::create($item->created_at)->locale('ru')->isoFormat('DD MMMM YYYY HH:mm') }}" readonly />
    </div>

    <div class="form__actions">
        <button class="button button--danger" type="button" data-bs-toggle="modal" data-bs-target="#destroy-single-item-modal">
            <span class="material-icons">remove_circle</span> Удалить
        </button>
    </div>

</form>

@include('dashboard.modals.single-item-destroy', ['destroyItemId' => $item->id ])

@endsection