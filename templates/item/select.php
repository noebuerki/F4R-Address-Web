<div style="margin-bottom: 100px">

    <div class="container">
        <div class="row row-cols-2 row-cols-md-4 justify-content-center">
            <?php
            foreach ($customers as $customer) {
                echo '
            <div class="col">
                <a href="/item/overview?customerId=' . $customer->id . '" role="button" class="btn btn-primary bg-primary w-100 mb-4">
                        <div class="mb-4 align-items-center" data-toggle="tooltip" title="' . $customer->middleName . '">
                            <div class="d-flex mt-1 mb-2 justify-content-between">
                                <span>' . $customer->customerNumber . '</span>
                                <i class="bi bi-person-square align-self-end"></i>
                            </div>
                            <p>' . $customer->title . ' ' . $customer->firstName . ' ' . $customer->lastName . '</p>
                            <p class="mb-0">' . $customer->street . ' ' . $customer->houseNumber . ',</p>
                            <p class="mb-3">' . $customer->postCode . ' ' . $customer->city . '</p>
                        </div>
                    </a>      
            </div>
                          
            ';
            }
            ?>
        </div>
    </div>

    <div class="container">
        <div class="row position-fixed fixed-buttonpos">

            <a href="/customer/search?firstName=<?php echo $firstName ?>&lastName=<?php echo $lastName ?>"
               role="button" class="btn btn-secondary" data-toggle="tooltip" title="Back to search">
                <img src="/images/arrow.svg" width="32" height="32" class="my-1" alt="Back">
            </a>

        </div>
    </div>

</div>