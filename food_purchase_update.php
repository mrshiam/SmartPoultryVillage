<?php include_once 'includes/dashboard/head.php' ?>
<?php include_once 'includes/dashboard/slider.php' ?>
<?php require_login(); ?>


<?php
require_once('includes/init.php');


if(!isset($_GET['id'])) {
    redirect_to(url_for('food_purchase_repo.php'));
}
$id = $_GET['id'];
$food = FoodPurchase::find_by_id($id);
if($food == false) {
    redirect_to(url_for('food_purchase_repo.php'));
}

if(is_post_request()) {

    // Save record using post parameters
    $args = $_POST['food'];
    $food->merge_attributes($args);
    $result = $food->save();

    if($result === true) {
        $session->message('Food Purchase Details Updated successfully.');
        redirect_to(url_for('food_purchase_repo.php'));

    } else {
        // show errors
    }

} else {

    // display the form

}

?>

    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <?php if($session->is_logged_in()) {
            $id = $session->user_id
            ?>
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <?php $user = User::find_by_id($id)?>
                            <h4>
                                <i class="fa fa-university" aria-hidden="true" style="margin-right: 5px;"></i>Farm Name:   <?php echo $user->farm_name ?>
                            </h4>
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="content">
                                        <a class="js-acc-btn" href="#"><?php echo $user->full_name ?></a>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="info">
                                            <h5 class="name">
                                                <a href="#"><?php echo $user->full_name ?></a>
                                            </h5>
                                            <span class="email"><?php echo $user->email_address ?></span>
                                        </div>
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="user_details.php?id=<?php echo $id ?>">
                                                    <i class="zmdi zmdi-account"></i>Account</a>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__footer">
                                            <a href="logout.php">
                                                <i class="zmdi zmdi-power"></i>Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        <?php } ?>
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
                                        <h3 class="text-center title-2">Food Purchase Update</h3>
                                        <?php echo display_errors($food->errors); ?>
                                    </div>
                                    <hr>
                                    <?php
                                    if(!isset($food)) {
                                        redirect_to(url_for('food_purchase_repo.php'));
                                    }
                                    ?>



                                    <form action="food_purchase_update.php?id=<?php echo $id?>" method="post" novalidate="novalidate">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Food Label Name</label>

                                            <select name="food[food_id]" id="ck_batch" class="form-control">
                                                <?php
                                                $fooditems = Food::find_all();
                                                foreach ($fooditems as $fooditem) {

                                                    ?>
                                                    <option value="<?php echo $fooditem->id;?> <?php if($fooditem->id == $food->food_id) echo 'selected="selected"'?>"><?php echo $fooditem->food_name; ?></option>


                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group has-success">
                                                    <label for="food_amount" class="control-label mb-1">Amount of Food</label>
                                                    <input id="food_amount" name="food[food_amount]" type="text" class="form-control cc-name valid" data-val="true" placeholder="kg" data-val-required="Please enter the name on card"
                                                           autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error"  value="<?php echo $food->food_amount ?>">
                                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="food_price" class="control-label mb-1">Price of Food</label>
                                                    <input id="food_price" name="food[food_price]" type="tel" class="form-control cc-number identified visa" value="<?php echo $food->food_price ?>" data-val="true"
                                                           data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                                                           autocomplete="cc-number">
                                                    <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="food_unit" class="control-label mb-1">Food Unit Price</label>
                                                <div class="input-group">
                                                    <input id="food_unit_price" name="food[food_unit_price]" type="tel" class="form-control cc-cvc" onclick="Calculate()" value="<?php echo $food->food_unit_price ?>" data-val="true" data-val-required="Please enter the security code"
                                                           data-val-cc-cvc="Please enter a valid security code" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Purchase Date</label>
                                                    <input id="cc-exp" name="food[purchase_date]" type="date" class="form-control cc-exp" value="<?php echo $food->purchase_date ?>" data-val="true" data-val-required="Please enter the card expiration"
                                                           data-val-cc-exp="Please enter a valid month and year" placeholder="MM / YY"
                                                           autocomplete="cc-exp">
                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="x_card_code" class="control-label mb-1">Retailer Name</label>
                                                <div class="input-group">
                                                    <input id="x_card_code" name="food[retailer_name]" type="tel" class="form-control cc-cvc" value="<?php echo $food->retailer_name ?>" data-val="true" data-val-required="Please enter the security code"
                                                           data-val-cc-cvc="Please enter a valid security code" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                <span id="payment-button-amount">Submit</span>
                                                <span id="payment-button-sending" style="display:none;">Submiting....</span>
                                            </button>
                                        </div>
                                    </form>
                                    <script>
                                        function Calculate()
                                        {
                                            var foodAmount = document.getElementById('food_amount').value;
                                            var foodPrice = document.getElementById('food_price').value;
                                            document.getElementById('food_unit_price').value=parseInt(foodPrice) /      parseInt(foodAmount);

                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once 'includes/dashboard/footer.php' ?>