<div class="d-flex justify-content-center mt-5 mx-1 mx-md-0">
    <div class="card bg-light mb-2 mx-1 mx-md-0">
        <div class="card-body">
            <p class="card-title">Delete by<br>customer number</p>

            <form method="post" action="/customer/doDelete" class="needs-validation container" novalidate>
                <div class="form-group mb-3">
                    <input required type="Number" min="0" placeholder="Customer number" class="form-control"
                           data-toggle="tooltip" title="Enter customer number" name="customerNumberInput">
                    <div class="invalid-feedback">Enter customer number</div>
                </div>

                <div class="form-group form-check mb-3">
                    <input required type="checkbox" class="form-check-input" id="dataCheckbox" data-toggle="tooltip"
                           title="Confirm">
                    <label for="dataCheckbox" class="form-check-label">
                        Delete customer & affiliated items
                    </label>
                </div>

                <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Delete customer permanently">
                    Delete <i class="bi bi-trash-fill"></i>
                </button>
            </form>
        </div>
    </div>
</div>

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
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>