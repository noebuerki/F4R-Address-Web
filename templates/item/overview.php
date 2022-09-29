<div class="d-flex justify-content-center mt-5 mx-1 mx-md-0">

    <div class="card bg-light align-self-center mb-4">
        <div class="card-body">
            <p class="card-text">
                <?php
                echo $customer->customerNumber;
                ?>
            </p>
            <p class="card-text">
                <?php
                echo $customer->title . " " . $customer->firstName . " " . $customer->lastName . "<br>" . $customer->middleName;
                ?>
            </p>
            <p class="card-text">
                <?php
                echo $customer->street . " " . $customer->houseNumber . ", " . $customer->postCode . " " . $customer->city;
                ?>
            </p>
        </div>
    </div>
</div>
<div class="d-flex flex-column justify-content-md-center mx-md-5">
    <div class="row row-cols-2 row-cols-md-3 justify-content-center mb-3 mx-1 mx-md-0">
        <?php
        foreach ($items as $item) {
            $item->dropOfDate = date_format(date_create($item->dropOfDate), "d.m.Y");
            $item->pickupDate = $item->pickupDate == null ? "NA" : date_format(date_create($item->pickupDate), "d.m.Y");
            echo '
            <div class="col">
                <a href="/item/update?itemId=' . $item->id . '" role="button" class="btn btn-primary bg-primary w-100 mb-4">
                        <div class="mb-4 align-items-center w-auto" data-toggle="tooltip" title="Value: ' . $item->value . ', Price: ' . $item->price . '">
                            <div class="d-flex mt-1 mb-2 justify-content-between">
                                <span>' . $item->storageNumber . '</span>
                                <i class="bi bi-pencil-square align-self-end"></i>
                            </div>
                            <p>' . $item->name . '</p>
                            <p class="mb-0">' . $item->dropOfDate . '</p>
                            <p class="mb-3">' . $item->pickupDate . '</p>
                        </div>
                    </a>      
            </div>';
        }
        ?>
    </div>
</div>

<div class="container">
    <div class="position-fixed fixed-buttonpos">
        <div class="row mb-3">
            <a href="/document/labels?customerId=<?php echo $customer->id ?>"
               role="button" class="me-3 col btn btn-secondary" data-toggle="tooltip" title="Print labels">
                <img src="/images/label.svg" width="32" height="32" class="my-1" alt="Labels">
            </a>

            <a href="/document/invoice?customerId=<?php echo $customer->id ?>"
               role="button" class="me-3 col btn btn-secondary" data-toggle="tooltip" title="Print receipt">
                <img src="/images/receipt.svg" width="32" height="32" class="my-1" alt="Receipt">
            </a>
        </div>

        <div class="row">
            <a href="/customer/search"
               role="button" class="me-3 col btn btn-secondary" data-toggle="tooltip" title="Back to search">
                <img src="/images/arrow.svg" width="32" height="32" class="my-1" alt="Back">
            </a>

            <a href="/item/create?customerId=<?php echo $customer->id ?>"
               role="button" class="me-3 col btn btn-secondary" data-toggle="tooltip" title="Create item">
                <img src="/images/add.svg" width="32" height="32" class="my-1" alt="Create item">
            </a>
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

