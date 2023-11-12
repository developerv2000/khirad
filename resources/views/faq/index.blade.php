@extends('layouts.app')
@section('main')

@section('title', 'Савол - ҷавоб')

<div class="main__inner faq-page">
    <section class="faq-section">
        <div class="faq-section__inner main-container">
            <h1 class="main-title faq-section__title">Савол - ҷавоб</h1>

            <div class="accordion faq-accordion">
                <div class="accordion__item">
                    <button class="accordion__button">
                        Ман муаллиф ҳастам ва мехоҳам китоби худро ба корбарони сомона пешниҳод кунам. Инро чӣ тавр бояд анҷом диҳам?<span class="material-icons-outlined accordion__button-icon">expand_more</span>
                    </button>

                    <div class="accordion__collapse">
                        <div class="accordion__collapse-body">
                            Мо аз Шумо барои ҳамкорӣ бисёр миннатдорем. Шумо метавонед китоби худро бо адреси сомонаи мо фиристед ва мо кӯшиш мекунем пас аз коркард, онро дар сомонаи худ ҷой диҳем.
                        </div>
                    </div>
                </div>

                <div class="accordion__item">
                    <button class="accordion__button">
                        Чӣ тавр метавонем китобҳои аудиоиро гӯш кунем?<span class="material-icons-outlined accordion__button-icon">expand_more</span>
                    </button>

                    <div class="accordion__collapse">
                        <div class="accordion__collapse-body">
                            Шумо ҳаргоҳ, ки хостед китобҳои ауидоиро бидуни мушкилӣ ҳам дар худи сайт гуш кунед ва ҳам барои худ бигиред.
                        </div>
                    </div>
                </div>

                <div class="accordion__item">
                    <button class="accordion__button">
                        Китобҳои машҳуртарини сайт кадомҳоянд?<span class="material-icons-outlined accordion__button-icon">expand_more</span>
                    </button>

                    <div class="accordion__collapse">
                        <div class="accordion__collapse-body">
                            Дар сайти мо китобҳои машҳур раддабандӣ шудаанд, Шумо метавонед аз рӯи раддабандӣ китобҳои машҳури мувафиқи завқатонро мутолеа намоед.
                        </div>
                    </div>
                </div>

                <div class="accordion__item">
                    <button class="accordion__button">Оё шумо метавонед китобҳоро ба дилхоҳ кишвар расонед?
                        <span class="material-icons-outlined accordion__button-icon">expand_more</span>
                    </button>

                    <div class="accordion__collapse">
                        <div class="accordion__collapse-body">
                            Бале муштарии азиз! Мо ин имкониятро дорем. Шумо метавонед китоби мавриди назаратонро супориш диҳед. Корбарони мо ба Шумо дастрас мекунанд.
                        </div>
                    </div>
                </div>

                <div class="accordion__item">
                    <button class="accordion__button">
                        Фармоиш кай расонида мешавад?<span class="material-icons-outlined accordion__button-icon">expand_more</span>
                    </button>
                      
                    <div class="accordion__collapse">
                        <div class="accordion__collapse-body">
                            Муҳлати расонидани китоб муштарии азиз вобаста ба манзил мебошад. Аммо мо кӯшиш мекунем дар кутоҳтарин фурсат китобҳоро дастрасӣ Шумо гардонем.
                        </div>
                    </div>
                </div>

                <div class="accordion__item">
                    <button class="accordion__button">
                        Арзиши интиқоли китоб чанд пул аст?<span class="material-icons-outlined accordion__button-icon">expand_more</span>
                    </button>

                    <div class="accordion__collapse">
                        <div class="accordion__collapse-body">
                            Арзиши интиқоли вобаста ба ҳаҷми китоб ва мавқеи зисти супоришгр вобастагӣ дорад.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>



@endsection