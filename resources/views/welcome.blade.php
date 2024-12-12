<x-layouts.guest>
    <section class="hero is-hero-bar">
        <div class="hero-body">
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <h1 class="title">
                            title
                        </h1>
                    </div>
                </div>
            </div>
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <p>
                            Hai ricevuto questa e-mail perché abbiamo ricevuto dal tuo account una richiesta di verifica
                            dell'e-mail.
                        </p>
                    </div>
                </div>
            </div>
            <div class="buttons is-centered">
                <a href="" class="button is-success">Clicca qui per verificare la tua e-mail</a>
                <button class="button is-danger">Dark</button>

            </div>
            <div>
                <img src="{{URL::asset('/images/propic.png')}}" alt="profile Pic" height="200" width="200">

            </div>

            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <p>
                            Questo link per verificare la tua e-mail scadrà tra 60 minuti.
                        </p>
                    </div>
                </div>
            </div>
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <p>
                            Saluti,<br/>Studio Gaglio
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.guest>
