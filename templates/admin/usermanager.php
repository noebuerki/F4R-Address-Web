<div style="margin-bottom: 100px">
    <div class="d-flex flex-column flex-md-row justify-content-center mt-5">

        <div class="card bg-light mb-3 mx-3">
            <div class="card-body">
                <p class="h5 card-title">Passwort ändern</p>

                <form method="post" action="/admin/changePassword" class="needs-validation" novalidate>

                    <div class="form-group">
                        <input required type="text" placeholder="Benutzername" class="form-control"
                               data-toggle="tooltip" title="Benutzername eingeben"
                               name="usernameInputPW">
                        <div class="invalid-feedback">Benutzername eingeben</div>
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

                    <button type="submit" class="btn btn-secondary" data-toggle="tooltip"
                            title="Änderung übernehmen">
                        Speichern <i class="bi bi-arrow-repeat"></i>
                    </button>

                </form>
            </div>
        </div>

        <div class="card bg-light mb-3 mx-3">
            <div class="card-body">
                <p class="h5 card-title">Konto löschen</p>

                <form method="post" action="/admin/removeUser" class="needs-validation" novalidate>

                    <div class="form-group">
                        <input required type="text" placeholder="Benutzername" class="form-control"
                               data-toggle="tooltip" title="Benutzername eingeben"
                               name="usernameInputRemove">
                        <div class="invalid-feedback">Benutzername eingeben</div>
                    </div>

                    <div class="form-group form-check">
                        <input required type="checkbox" class="form-check-input" id="dataCheckbox"
                               data-toggle="tooltip" title="Bestätigen">
                        <label for="dataCheckbox" class="form-check-label">
                            Alle Daten & Konto löschen
                        </label>
                    </div>

                    <button type="submit" class="btn btn-danger" data-toggle="tooltip"
                            title="Konto endgültig löschen">
                        Löschen <i class="bi bi-trash-fill"></i>
                    </button>

                </form>
            </div>
        </div>
    </div>

    <a href="/admin" role="button" class="position-fixed fixed-buttonpos btn btn-secondary" data-toggle="tooltip"
       title="Zurück zur Auswahl">
        <img src="/images/arrow.svg" width="32" height="32" class="my-1" alt="Pfeil nach links, zurück icon">
    </a>
</div>

<script>
    /* Form Validation | Von Bootstrap Dokumentation kopiert */
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    function escapeRegExp(str) {
        return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
    }
</script>
