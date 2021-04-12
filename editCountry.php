<?php
include_once('header.inc.php');
include_once('jwt-api/Country.php');

$cname = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = $_GET['id'];
    $country = new Country();
    $country->setId($_GET['id']);
    $countryData = $country->getCustomerDetailsById();
    if (!empty($countryData)) {
        $cname = $countryData['country_name'];
    } else {
        $country->setName($_GET['cc-name']);
        if ($country->update()) {
            echo '<div class="alert alert-primary" role="alert">
            Recorded Updated Successfully...!!!
        </div>';
            header("Location: http://example.com/myOtherPage.php");
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Something went wrong please try later..!!!
        </div>';
        }
    }
}

if (isset($_POST['id']) && $_POST['id'] != '') {
    $id = $_POST['id'];
    $country = new Country();
    $country->setId($_POST['id']);
    $country->setName($_POST['cc-name']);
    if ($country->update()) {
        $cname = $_POST['cc-name'];
        echo '<div class="alert alert-primary" role="alert">
            Recorded Updated Successfully...!!!
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
                        <strong class="card-title">Update Country Form</strong>
                    </div>
                    <div class="card-body">
                        <!-- Credit Card -->
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center">Update Country Form</h3>
                                </div>
                                <hr>
                                <form action="editCountry.php?id=<?php echo $id ?>" method="post" novalidate="novalidate">
                                    <div class="form-group has-success">
                                        <label for="cc-name" class="control-label mb-1">Country Name</label>
                                        <input id="cc-name" name="cc-name" type="text" value="<?php echo $cname  ?>" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name">
                                        <input id="id" name="id" type="hidden" value="<?php echo $id  ?>">
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