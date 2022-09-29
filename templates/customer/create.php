<div class="d-flex flex-row justify-content-center mt-5">
    <div class="card bg-light mb-3">
        <div class="card-body">

            <form method="post" action="/customer/doCreate" class="needs-validation container" novalidate>
                <div class="row">
                    <div class="column-sm">
                        <div class="form-group mb-3">
                            <input required type="Number" min="0" placeholder="Customer number" class="form-control"
                                   data-toggle="tooltip" title="Enter customer number" name="customerNumberInput" id="customerNumberInput" onfocusout="checkCustomerNumber(this.value)">
                            <div class="invalid-feedback" id="customerNumberInputFeedback">Enter customer number</div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="btn-group w-100" role="group" aria-label="Storage space">
                                <input required type="radio" class="btn-check" name="storageSpaceInput" value="2"
                                       title="Select storage space" id="storageSpaceInput1" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="storageSpaceInput1">2</label>

                                <input required type="radio" class="btn-check" name="storageSpaceInput" value="5"
                                       title="Select storage space" id="storageSpaceInput2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="storageSpaceInput2">5</label>

                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <input required type="Text" placeholder="Title" class="form-control" data-toggle="tooltip"
                                   title="Enter title" name="titleInput">
                            <div class="invalid-feedback">Enter title</div>
                        </div>

                        <div class="form-group mb-3">
                            <input required type="Text" placeholder="First name" class="form-control"
                                   data-toggle="tooltip" title="Enter first name" name="firstNameInput">
                            <div class="invalid-feedback">Enter first name</div>
                        </div>

                        <div class="form-group mb-3">
                            <input required type="Text" placeholder="Last name" class="form-control"
                                   data-toggle="tooltip" title="Enter last name" name="lastNameInput">
                            <div class="invalid-feedback">Enter last name</div>
                        </div>
                    </div>

                    <div class="column-sm">
                        <div class="form-group mb-3">
                            <input type="Text" placeholder="Middle name" class="form-control"
                                   data-toggle="tooltip" title="Enter middle name" name="middleNameInput">
                            <div class="invalid-feedback">Enter middle name</div>
                        </div>

                        <div class="form-group mb-3">
                            <input required type="Text" placeholder="Street" class="form-control" data-toggle="tooltip"
                                   title="Enter street" name="streetInput">
                            <div class="invalid-feedback">Enter street</div>
                        </div>

                        <div class="form-group mb-3">
                            <input required type="Text" placeholder="House number" class="form-control"
                                   data-toggle="tooltip" title="Enter house number" name="houseNumberInput">
                            <div class="invalid-feedback">Enter house number</div>
                        </div>

                        <div class="form-group mb-3">
                            <input required type="Text" placeholder="Post code" class="form-control"
                                   data-toggle="tooltip" title="Enter post code" name="postCodeInput">
                            <div class="invalid-feedback">Enter post code</div>
                        </div>

                        <div class="form-group mb-3">
                            <input required type="Text" placeholder="City" class="form-control" data-toggle="tooltip"
                                   title="Enter city" name="cityInput">
                            <div class="invalid-feedback">Enter city</div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Save customer">
                    Save <i class="bi bi-arrow-right-short"></i>
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

    function checkCustomerNumber(value) {
        console.log(value);
        fetch('/customer/doCheckCustomerNumberAvailable', {
            method: 'POST',
            body: JSON.stringify({CustomerNumber: value}),
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            console.log(data);
            let field = document.getElementById("customerNumberInput")
            if (!data) {
                document.getElementById("customerNumberInputFeedback").innerText = "Customer number taken";
                field.setCustomValidity("Taken");
            } else {
                document.getElementById("customerNumberInputFeedback").innerText = "Enter customer number";
                field.setCustomValidity("");
            }
        });
    }
</script>