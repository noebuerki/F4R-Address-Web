<div class="d-flex justify-content-center mt-5 mx-1 mx-md-0">

    <div class="card bg-light align-self-center mb-4">
        <div class="card-body">
            <p class="card-text">
                <?php

                use App\Authentication\Authentication;

                echo 'Benutzername: ' . htmlentities($user->username);
                if (Authentication::isAdmin()) {
                    echo ' <span class="badge badge-warning">Admin</span>';
                }
                ?>
            </p>
            <p class="card-text">
                <?php

                echo 'E-Mail: ' . htmlentities($user->email);
                ?>
            </p>
        </div>
    </div>
</div>

<div class="d-flex flex-md-row flex-column justify-content-md-center">

    <div class="row card bg-light mb-3 mx-1 mx-md-0">
        <div class="card-body">
            <p class="card-title">E-Mail ändern</p>

            <form method="post" action="/user/doChangeMail" class="needs-validation" novalidate>

                <div class="form-group">
                    <input required type="password" placeholder="Passwort" class="form-control" data-toggle="tooltip"
                           title="Passwort eingeben"
                           name="passwordInput">
                    <div class="invalid-feedback">Passwort eingeben</div>
                </div>

                <div class="form-group">
                    <input required type="email" placeholder="Neue E-Mail" class="form-control" name="emailInput"
                           data-toggle="tooltip" title="Neue E-Mail eingeben"
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="100">
                    <div class="invalid-feedback">Ungültiges Format</div>
                </div>

                <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Änderung übernehmen">
                    Speichern <i class="bi bi-arrow-repeat"></i>
                </button>

            </form>
        </div>
    </div>

    <div class="row card bg-light mb-3 mx-1 mx-md-4">
        <div class="card-body">
            <p class="card-title">Passwort ändern</p>

            <form method="post" action="/user/doChangePassword" class="needs-validation" novalidate>

                <div class="form-group">
                    <input required type="password" placeholder="Aktuelles Passwort" class="form-control"
                           data-toggle="tooltip" title="Aktuelles Passwort eingeben"
                           name="passwordInput">
                    <div class="invalid-feedback">Passwort eingeben</div>
                </div>

                <div class="form-group">
                    <input required type="password" placeholder="Neues Passwort" class="form-control"
                           name="passwordInputNew" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}" maxlength="50"
                           data-toggle="tooltip" title="Neues Passwort eingeben"
                           oninput="form.passwordRepeatInput.pattern = escapeRegExp(this.value)">
                    <div class="invalid-feedback">Passwort ungültig</div>
                </div>

                <div class="form-group">
                    <input required id="passwordRepeatInput" type="password" placeholder="Passwort Wiederholen"
                           data-toggle="tooltip" title="Neues Passwort wiederholen"
                           class="form-control" name="passwordRepeatInput" pattern="">
                    <div class="invalid-feedback">Passwort nicht gleich</div>
                </div>

                <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Änderung übernehmen">
                    Speichern <i class="bi bi-arrow-repeat"></i>
                </button>

            </form>
        </div>
    </div>

    <div class="row card bg-light mb-3 mx-1 mx-md-0">
        <div class="card-body">
            <p class="card-title">Konto löschen</p>

            <form method="post" action="/user/doDelete" class="needs-validation" novalidate>

                <div class="form-group">
                    <input required type="password" placeholder="Passwort" class="form-control" data-toggle="tooltip"
                           title="Passwort eingeben"
                           name="passwordInput">
                    <div class="invalid-feedback">Passwort eingeben</div>
                </div>

                <div class="form-group form-check">
                    <input required type="checkbox" class="form-check-input" id="dataCheckbox" data-toggle="tooltip"
                           title="Bestätigen">
                    <label for="dataCheckbox" class="form-check-label">
                        Alle Daten & Konto löschen
                    </label>
                </div>

                <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Konto endgültig löschen">
                    Löschen <i class="bi bi-trash-fill"></i>
                </button>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="PWHelp" data-backdrop="static" data-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Anforderungen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-left">
                    Deine E-Mail muss:<br>
                    - Ein @ enthalten<br><br>

                    Dein Passwort muss:<br>
                    - Mindestens 8 Zeichen enthalten<br>
                    - Mindestens einen Kleinbuchstaben enthalten<br>
                    - Mindestens einen Grossbuchstaben enthalten<br>
                    - Mindestens eine Zahl enthalten<br>
                    - Mindesten ein Sonderzeichen enthalten<br>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn btn-secondary my-5 registerspace" data-toggle="modal" title="Anforderungen anzeigen"
        data-target="#PWHelp">
    <i class="bi bi-clipboard-check"></i> Anforderungen
</button>

<script>
    /* Form Validation */
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                        Modal();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    function escapeRegExp(str) {
        return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
    }

    function Modal() {
        $('#PWHelp').modal('show');
    }
</script>

