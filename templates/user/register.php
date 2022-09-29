<div class="d-flex flex-row justify-content-center mt-5">
    <div class="card bg-light mb-3">
        <div class="card-body">

            <form method="post" action="/user/doCreate" class="needs-validation" novalidate>

                <div class="form-group">
                    <input required type="text" data-toggle="tooltip" title="Benutzername eingeben"
                           placeholder="Benutzername" class="form-control" id="usernameInput" name="usernameInput"
                           maxlength="20" onfocusout="checkUsername(this.value)">
                    <p class="invalid-feedback" id="feedback">

                    </p>
                </div>

                <div class="form-group">
                    <input required type="email" data-toggle="tooltip" title="E-Mail eingeben" placeholder="E-Mail"
                           class="form-control" name="emailInput"
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="100">
                    <div class="invalid-feedback">Ungültiges Format</div>
                </div>

                <div class="form-group">
                    <input required type="password" data-toggle="tooltip" title="Passwort eingeben"
                           placeholder="Passwort" class="form-control"
                           name="passwordInput" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}" maxlength="50"
                           oninput="form.passwordRepeatInput.pattern = escapeRegExp(this.value)">
                    <div class="invalid-feedback">Passwort ungültig</div>
                </div>

                <div class="form-group">
                    <input required id="passwordRepeatInput" data-toggle="tooltip" title="Passwort wiederholen"
                           type="password" placeholder="Passwort Wiederholen"
                           class="form-control" name="passwordRepeatInput" pattern="" maxlength="50">
                    <div class="invalid-feedback">Passwort nicht gleich</div>
                </div>

                <div class="form-group form-check">
                    <input required type="checkbox" class="form-check-input" id="dataCheckbox" data-toggle="tooltip"
                           title="Bestätigen">
                    <label for="dataCheckbox" class="form-check-label">
                        Ich akzeptiere die Datenschutzerklärung
                    </label>
                </div>

                <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Registrieren">
                    Registrieren <i class="bi bi-arrow-right-short"></i>
                </button>

            </form>
        </div>
    </div>
</div>

<button type="button" class="btn btn-secondary mt-5 registerspace" data-toggle="modal"
        data-target="#PWHelp" title="Anforderungen anzeigen">
    <i class="bi bi-clipboard-check"></i> Anforderungen
</button>

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
                    Deine Benutzername darf:<br>
                    - Keine Leerzeichen enthalten<br><br>

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
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="tooltip"
                        title="Anforderungen ausblenden">Ok
                </button>
            </div>
        </div>
    </div>
</div>

<div class="mt-5">
    <a href="/user/login" class="align-self-end" data-toggle="tooltip" title="Zum Login">
        <p>Schon Registriert?<br>Zurück zum Login</p>
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
                    checkUsername(document.getElementById("usernameInput").value);
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

    function checkUsername(value) {
        fetch('/user/checkUsername', {
            method: 'POST',
            body: JSON.stringify({Username: value}),
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            let field = document.getElementById("usernameInput")
            if (!data) {
                document.getElementById("feedback").innerText = "Benutzername bereits vergeben";
                field.setCustomValidity("Taken");
            } else if (!field.value.match(/^[^\s]+$/)) {
                document.getElementById("feedback").innerText = "Benutzername ungültig";
                field.setCustomValidity("Not matched");
            } else {
                document.getElementById("feedback").innerText = "";
                field.setCustomValidity("");
            }
        });
    }

    function escapeRegExp(str) {
        return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
    }

    function Modal() {
        $('#PWHelp').modal('show');
    }
</script>