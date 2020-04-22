<?php include_once 'includes/dashboard/head.php' ?>
<?php include_once 'includes/dashboard/slider.php' ?>
<?php require_once('includes/init.php'); ?>

    <div class="page-container">
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap">
                        <h3> Transportation Report</h3>
                    </div>
                </div>
            </div>
        </header>
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <h3 class="title-5 m-b-35">Data Table</h3>

                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                <tr>
                                    <th>Trasnportation ID</th>
                                    <th>Trasnport Name</th>
                                    <th>Reason of Use</th>
                                    <th>Transport Fare</th>
                                    <th>Transport Used Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $transports = Transportation::find_all();
                                foreach ($transports as $transport) {
                                    ?>
                                    <tr class="tr-shadow">

                                        <td><?php echo $transport->id ?></td>
                                        <td>
                                            <?php echo $transport->transport_name ?>
                                        </td>
                                        <td>
                                            <?php echo $transport->reason_use ?>
                                        </td>
                                        <td><?php echo $transport->transport_cost ?></td>
                                        <td>
                                            <?php echo $transport->used_date ?>
                                        </td>

                                        <td>
                                            <div class="table-data-feature">

                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <a class = "action" href="transport_cost_update.php?id=<?php echo $transport->id?>"> <i class="zmdi zmdi-edit"></i></a>
                                                </button>
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <a class = "delete" data-confirm = "Are you want to delete this  item?" href="transport_cost_delete.php?id=<?php echo $transport->id?>"><i class="zmdi zmdi-delete"></i></a>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                <?php } ?>

                                <script>
                                    var deleteLinks = document.querySelectorAll('.delete');

                                    for (var i = 0; i < deleteLinks.length; i++) {
                                        deleteLinks[i].addEventListener('click', function(event) {
                                            event.preventDefault();

                                            var choice = confirm(this.getAttribute('data-confirm'));

                                            if (choice) {
                                                window.location.href = this.getAttribute('href');
                                            }
                                        });
                                    }


                                </script>

                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include_once 'includes/dashboard/footer.php' ?>