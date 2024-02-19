@extends('layouts.app')
@section('main')

@section('title', 'Тамос')

<div class="main__inner contacts-page">
    <section class="contacts-section">
        <div class="contacts-section__inner main-container">
            <h1 class="main-title contacts-section__title">Ба мо нависед</h1>

            <div class="contacts-form-container">
                <form class="feedback-form" id="feedback-form" action="{{ route('feedback') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <input class="input feedback-form__input" type="text" name="name" placeholder="Номи Шумо">
                        <input class="input feedback-form__input" type="text" name="email" placeholder="Почта*">
                    </div>

                    <div class="form-group">
                        <input class="input feedback-form__input" type="text" name="theme" placeholder="Мавзуъ">
                    </div>

                    <div class="form-group">
                        <textarea class="textarea feedback-form__textarea" name="body" rows="8" placeholder="Матн*"></textarea>
                    </div>

                    <button class="g-recaptcha button button--secondary feedback-form__button" data-sitekey="6LeTtHcpAAAAANDcYSO5J8Kbpd6tYjERQ4-vocAG" data-callback='onRecaptchaSubmit' data-action='submit'>
                        Фиристодан
                    </button>
                </form>

                <div id="map"></div>
            </div>
        </div>
    </section>
</div>



@endsection
