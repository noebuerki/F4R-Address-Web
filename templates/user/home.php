<div class="container mb-5">
    <div class="row pt-5">
        <div class="col-sm">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body justify-content-between">
                    <p class="card-title">Number of customers:</p>
                    <?php

                    if ($customers == 0) {
                        echo '<p class="card-text">No customers registered</i></p>';
                    } else {
                        echo '<p class="card-text">' . $customers . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-sm">
            <div class="card text-white bg-info mb-3">
                <div class="card-body justify-content-between">
                    <p class="card-title">Number of items:</p>
                    <?php

                    if ($items == 0) {
                        echo '<p class="card-text">No items registered</i></p>';
                    } else {
                        echo '<p class="card-text">' . $items . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>