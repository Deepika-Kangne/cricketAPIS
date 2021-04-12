<?php
include_once('header.inc.php');
include_once('jwt-api/Country.php');
if (isset($_POST['submit'])) {
    $country = new Country();
    $country->setName($_POST['cc-name']);
    if ($country->insert()) {
        echo '<div class="alert alert-primary" role="alert">
        Recorded Added Successfully...!!!
      </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Something went wrong please try later..!!!
      </div>';
    }
}
?>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Country Form</strong>
                    </div>
                    <div class="card-body">
                        <!-- Credit Card -->
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center">Country Form</h3>
                                </div>
                                <hr>
                                <form action="addCountry.php" method="post" novalidate="novalidate">
                                    <div class="form-group has-success">
                                        <label for="cc-name" class="control-label mb-1">Country Name</label>
                                        <input id="cc-name" name="cc-name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name">
                                        <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit" name='submit' class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Add Country</span>
                                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div> <!-- .card -->

            </div>
            <!--/.col-->
        </div>


    </div><!-- .animated -->
</div><!-- .content -->

<?php include_once('footer.inc.php'); ?>