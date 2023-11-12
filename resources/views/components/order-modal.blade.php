@props(['id'])

<div class="main-modal order-modal" id="order-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-background" data-action="hide-modal" data-target-id="order-modal"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <h1 class="modal-title">Фармоиш додани китоб</h1>
            <p class="modal-text">
                Маълумоти хешро ба мо ирсол намоед ва мо барои баррасии минбаъда бо Шумо дар тамос хоҳем шуд !
            </p>

            <form class="modal-form" action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" value="{{ $id }}">

                <div class="form-group">
                    <input class="input modal-input" type="text" name="name" placeholder="Номи Шумо" required>
                </div>

                <div class="form-group">
                    <input class="input modal-input" type="email" name="email" placeholder="Почтаи электронии Шумо" required>
                </div>

                <div class="form-group">
                    <input class="input modal-input" type="text" name="phone" placeholder="Рақамҳои мобилии Шумо" required>
                </div>

                <div class="form-group">
                    <input class="input modal-input" type="text" name="address" placeholder="Суроғаи Шумо" required>
                </div>
                
                <div class="modal-actions">
                    <button class="button button--cancel" type="button" data-action="hide-modal" data-target-id="order-modal">Пӯшидан</button>
                    <button class="button button--secondary" type="submit">Фиристодан</button>
                </div>
            </form>
        </div>
    </div>
</div>