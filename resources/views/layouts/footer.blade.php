<footer class="footer">
    <div class="footer__inner">
        <div class="footer__main">
            <div class="footer__main-inner main-container">
                <div class="footer__about">
                    <a href="{{ route('home') }}" class="logo footer__logo">
                        <img class="logo__image" src="{{ asset('img/main/logo.png') }}" alt="Хирад лого">
                    </a>

                    <p class="footer__about-text">
                        Лаҳзае нишастан дар саҳифаи “Хирад”, ҳузур дар маҳзари андешамандони қурун ва фарзонагони замон аст. “Хирад”, маъбади аҳли илм ва меҳроби поки донишҷӯӣ ва илмомӯзӣ аст. Ҳарки аз китоб ва мутолиа бегона аст, ғариб ва бемӯнис аст.
                    </p>

                    <ul class="footer__about-socials">
                        <li>
                            <a href="https://www.facebook.com/%D0%A5%D0%B8%D1%80%D0%B0%D0%B4-106239201477539" target="_blank">
                                <img src="{{asset('img/socials/facebook.png')}}" alt="facebook">
                            </a>
                        </li>

                        <li>
                            <a href="https://www.instagram.com/khirad.21/" target="_blank">
                                <img class="instagram" src="{{asset('img/socials/instagram.png')}}" alt="instagram">
                            </a>
                        </li>

                        <li>
                            <a href="https://www.youtube.com/channel/UCnvlnva3G4JZK9qzH4fkBvQ" target="_blank">
                                <img src="{{asset('img/socials/youtube.png')}}" alt="youtube">
                            </a>
                        </li>

                        <li>
                            <a href="https://t.me/Khirad21" target="_blank">
                                <img src="{{asset('img/socials/telegram.png')}}" alt="telegram">
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="footer__additional-links">
                    <h3 class="footer__main-title">Илова бар ин</h3>
                    <ul class="footer__list">
                        <li class="footer__list-item">
                            <a href="{{ route('books.index') }}" class="footer__list-link">Ҳамаи китобҳо</a>
                        </li>

                        <li class="footer__list-item">
                            <a href="{{ route('categories.world-most-readable') }}" class="footer__list-link">Серхондатарин китобҳои ҷаҳон</a>
                        </li>

                        <li class="footer__list-item">
                            <a href="{{ route('categories.top-books') }}" class="footer__list-link">Серхондатарин китобҳои сомона</a>
                        </li>

                        <li class="footer__list-item">
                            <a href="{{ route('categories.show', 'kitobhoi-horiji') }}" class="footer__list-link">Китобҳои хориҷӣ</a>
                        </li>

                        <li class="footer__list-item">
                            <a href="{{ route('authors.index') }}?popular=true" class="footer__list-link">Муаллифони машҳур</a>
                        </li>

                        <li class="footer__list-item">
                            <a href="{{ route('faq') }}" class="footer__list-link">Савол - ҷавоб</a>
                        </li>
                    </ul>
                </div>

                <div class="footer__contacts">
                    <h3 class="footer__main-title">Тамос</h3>
                    <ul class="footer__list">
                        <li class="footer__list-item">
                            <a class="footer__list-link">
                                <span class="material-icons">navigation </span> Индекс 734064
                            </a>
                        </li>

                        <li class="footer__list-item">
                            <a href="{{ route('contacts') }}" class="footer__list-link">
                                <span class="material-icons">place</span> Ҷумҳурии Тоҷикистон <br> ш. Душанбе, кӯчаи Шамси 4Б
                            </a>
                        </li>

                        <li class="footer__list-item">
                            <a href="tel:+992927685858" class="footer__list-link">
                                <span class="material-icons">phone</span> +992 927685858
                            </a>
                        </li>

                        <li class="footer__list-item">
                            <a href="mailto:info@khirad.tj" class="footer__list-link">
                                <span class="material-icons">email</span> info@khirad.tj
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer__copyright">© {{ date('Y') }} Хирад. Ҳамаи ҳуқуқҳо ҳифз шудаанд.</div>
    </div>
</footer>