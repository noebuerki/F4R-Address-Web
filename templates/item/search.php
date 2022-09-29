<div class="d-flex flex-md-row flex-column justify-content-md-center mt-5">
    <div class="row card bg-light mb-2 mx-1 mx-md-0">
        <div class="card-body">
            <p class="card-title">Search by<br>customer number</p>

            <form method="post" action="/item/doSearch" class="needs-validation" novalidate>

                <div class="form-group mb-3">
                    <input required type="Text" placeholder="Customer number" class="form-control" data-toggle="tooltip"
                           title="Enter customer number" name="customerNumberInput" value="<?php echo $customerNumber ?>">
                    <div class="invalid-feedback">Enter customer number</div>
                </div>

                <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Search by customer number">
                    Search <i class="bi bi-arrow-right-short"></i>
                </button>

            </form>
        </div>
    </div>

    <div class="row card bg-light mb-2 mx-1 mx-md-4">
        <div class="card-body">
            <p class="card-title">Search by<br>name</p>

            <form method="post" action="/item/doSearch" class="needs-validation" novalidate>

                <div class="form-group mb-3">
                    <input type="Text" placeholder="First name" class="form-control"
                           data-toggle="tooltip" title="Enter first name" name="firstNameInput" value="<?php echo $firstName ?>">
                    <div class="invalid-feedback">Enter first name</div>
                </div>

                <div class="form-group mb-3">
                    <input type="Text" placeholder="Last name" class="form-control"
                           name="lastNameInput" data-toggle="tooltip" title="Enter last name" value="<?php echo $lastName ?>">
                    <div class="invalid-feedback">Enter last name</div>
                </div>

                <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Search by name">
                    Search <i class="bi bi-arrow-right-short"></i>
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