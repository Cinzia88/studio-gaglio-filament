
<!DOCTYPE html>
<!-- Force the light theme: -->
<html data-theme="light">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hello Bulma!</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">

  <style>
     :root {
      --bulma-primary: red;
      --bulma-size-medium: 0.5rem;
    }

    .button {
      background-color: red;
    }


  </style>
</head>

<body>
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
                            {{ $token }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="buttons is-centered">
                <a href="{{ URL::to('reset-password/ {{ $token }}) " class="button is-success">Reset Password</a>

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
</body>

</html>
