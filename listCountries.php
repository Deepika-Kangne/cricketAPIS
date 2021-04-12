<?php
include_once('header.inc.php');
include_once('jwt-api/Country.php');
$country = new Country();
?>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Country Table</strong>
                        <a href="addCountry.php" class="btn btn-primary float-right" role="button" aria-disabled="true">Add New Country</a>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="serial">#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($country->getAllCountries())) {
                                    for ($i = 0; $i < count($country->getAllCountries()); $i++) {
                                ?>
                                        <tr>
                                            <td class="serial"><?php echo $country->getAllCountries()[$i]["id"] ?></td>
                                            <td> <span class="name"><?php echo $country->getAllCountries()[$i]["country_name"] ?></span> </td>
                                            <td>
                                                <?php
                                                echo '<a href="editCountry.php?id=' . $country->getAllCountries()[$i]["id"] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                echo '<a href="delete.php?id=' . $country->getAllCountries()[$i]["id"] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<?php include_once('footer.inc.php'); ?>