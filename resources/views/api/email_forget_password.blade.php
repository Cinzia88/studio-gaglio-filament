
<!DOCTYPE html>
<!-- Force the light theme: -->
<html data-theme="light">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hello Bulma!</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">


</head>

<body>
    <section class="hero is-hero-bar">
        <div class="hero-body">
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <h1 class="title">
                            Reset Password
                        </h1>

                    </div>
                </div>
            </div>




            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <p>
                            Hai ricevuto questa email, perché abbiamo ricevuto una richiesta di reimpostazione della password.<br />
                            Clicca in basso per resettarla
                        </p>
                    </div>
                </div>
            </div>
            <div class="buttons is-centered">
                <a href="{{ URL::to('reset-password/'.$data['token'] .'/'. $data['email'] ) }}" class="button is-success">Reset Password</a>

            </div>
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <p>
                            Questo link per reimpostare la password scadrà tra 60 minuti.
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
</body>

</html>
