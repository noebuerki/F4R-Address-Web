<div class="d-flex justify-content-center mt-5 mx-1 mx-md-0">
    <div class="card bg-light mb-2 mx-1 mx-md-0">
        <div class="card-body">
            <p class="card-title">New item</p>

            <form method="post" action="/item/doCreate" class="needs-validation container" novalidate>

                <input hidden name="customerIdInput" value="<?php echo $customerId ?>">

                <div class="row">
                    <div class="col-sm">
                        <div class="form-group mb-3">
                            <input required type="Number" min="0" placeholder="Storage number" class="form-control"
                                   data-toggle="tooltip" title="Enter storage number" name="storageNumberInput" id="storageNumberInput" onfocusout="checkStorageNumber(this.value)">
                            <div class="invalid-feedback" id="storageNumberInputFeedback">Enter storage number</div>
                        </div>

                        <div class="form-group mb-3">
                            <input required type="Text" placeholder="Name" class="form-control" data-toggle="tooltip"
                                   title="Enter name" name="nameInput">
                            <div class="invalid-feedback">Enter name</div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="btn-group w-100" role="group" aria-label="In storage">
                                <input required type="radio" class="btn-check" name="inStorageInput" value="1"
                                       onclick="adjustRequiredDates(this.value)"
                                       title="Select if item in storage" id="inStorageInput1" autocomplete="off"
                                       checked>
                                <label class="btn btn-outline-primary" for="inStorageInput1">Here</label>

                                <input required type="radio" class="btn-check" name="inStorageInput" value="0"
                                       onclick="adjustRequiredDates(this.value)"
                                       title="Select if item in storage" id="inStorageInput2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="inStorageInput2">Away</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm">
                        <div class="form-group mb-3">
                            <input required type="Number" placeholder="Value" class="form-control"
                                   data-toggle="tooltip" title="Enter value" name="valueInput"
                                   onfocusout="calculatePrice(this.value)">
                            <div class="invalid-feedback">Enter value</div>
                        </div>

                        <div class="form-group mb-3">
                            <input required type="Number" placeholder="Price" class="form-control"
                                   data-toggle="tooltip" title="Enter price" name="priceInput" id="priceInput">
                            <div class="invalid-feedback">Enter price</div>
                        </div>

                        <div class="form-group mb-3">
                            <input required type="Date" placeholder="Drop of date" class="form-control" format="dd.mm.yyyy"
                                   data-toggle="tooltip" title="Enter drop of date" name="dropOfDateInput">
                            <div class="invalid-feedback">Enter drop of date</div>
                        </div>

                        <div class="form-group mb-3">
                            <input disabled type="Date" placeholder="Pickup date" class="form-control" format="dd.mm.yyy"
                                   data-toggle="tooltip" title="Enter pickup date" name="pickupDateInput"
                                   id="pickupDateInput">
                            <div class="invalid-feedback">Enter pickup date</div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Save item">
                    Save <i class="bi bi-arrow-right-short"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row position-fixed fixed-buttonpos">

        <a href="/item/overview?customerId=<?php echo $customerId ?>"
           role="button" class="btn btn-secondary" data-toggle="tooltip" title="Back to overview">
            <img src="/images/arrow.svg" width="32" height="32" class="my-1" alt="Back">
        </a>

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

    function adjustRequiredDates(value) {
        value = value == 0 ? true : false;
        var pickupDateInput = document.getElementById("pickupDateInput");
        pickupDateInput.required = value
        pickupDateInput.disabled = !value;
        if (!value) {
            pickupDateInput.value = "";
        }

    }

    function checkStorageNumber(value) {
        fetch('/item/doCheckStorageNumber', {
            method: 'POST',
            body: JSON.stringify({CustomerId: <?php echo $customerId ?>, StorageNumber: value}),
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            console.log(data);
            let field = document.getElementById("storageNumberInput");
            if (!data) {
                document.getElementById("storageNumberInputFeedback").innerText = "Storage number taken";
                field.setCustomValidity("Taken");
            } else {
                document.getElementById("storageNumberInputFeedback").innerText = "Enter storage number";
                field.setCustomValidity("");
            }
        });
    }

    function calculatePrice(value) {
        fetch('/item/doCalculatePrice', {
            method: 'POST',
            body: JSON.stringify({Value: value}),
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            document.getElementById("priceInput").value = data;
        });
    }
</script>