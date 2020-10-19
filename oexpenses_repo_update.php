<?php include_once 'includes/dashboard/head.php' ?>
<?php include_once 'includes/dashboard/slider.php' ?>


<?php
require_once('includes/init.php');


if(!isset($_GET['id'])) {
    redirect_to(url_for('oexpances_repo.php'));
}
$id = $_GET['id'];
$oexpense = OtherExpenses::find_by_id($id);
if($oexpense == false) {
    redirect_to(url_for('oexpances_repo.php'));
}

if(is_post_request()) {

    // Save record using post parameters
    $args = $_POST['oexpenses'];
    $oexpense->merge_attributes($args);
    $result = $oexpense->save();

    if($result === true) {
        $_SESSION['message'] = 'The Medicine was updated successfully.';

    } else {
        // show errors
    }

} else {

    // display the form

}

?>

<div class="page-container">
    <!-- HEADER DESKTOP-->
    <header class="header-desktop">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="header-wrap">

                </div>
            </div>
        </div>
    </header>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Other Expenses</h3>
                                </div>
                                <hr>
                                <?php
                                if(!isset($oexpense)) {
                                    redirect_to(url_for('oexpances_repo.php'));
                                }
                                ?>
                                <form action="oexpenses_repo_update.php?id=<?php echo $id?>" method="post" novalidate="novalidate">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name of the Expense Element</label>
                                        <input id="cc-pament" name="oexpenses[element_name]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?php echo $oexpense->element_name ?>">
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="cc-name" class="control-label mb-1">Reason of Buying It</label>
                                        <input id="cc-name" name="oexpenses[buying_reason]" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter Reason of Buying It"
                                               autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" value="<?php echo $oexpense->buying_reason ?>">
                                        <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-number" class="control-label mb-1">Amount of Money </label>
                                        <input id="cc-number" name="oexpenses[element_price]" type="tel" class="form-control cc-number identified visa" value="<?php echo $oexpense->element_price ?>" data-val="true"
                                               data-val-required="Please enter Money Amount" data-val-cc-number="Amount of Money"
                                               autocomplete="cc-number">
                                        <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Date</label>
                                                <input id="cc-exp" name="oexpenses[buying_date]" type="date" class="form-control cc-exp" value="<?php echo $oexpense->buying_date ?>" data-val="true" data-val-required="Please enter Date"
                                                       data-val-cc-exp="Please enter a valid month and year" placeholder="MM / YY"
                                                       autocomplete="cc-exp">
                                                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">

                                            <span id="payment-button-amount">Update Other Expenses</span>
                                            <span id="payment-button-sending" style="display:none;">Submiting....</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'includes/dashboard/footer.php' ?>