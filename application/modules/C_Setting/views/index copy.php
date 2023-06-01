<div class="row">
    <div class="col-12">
        <div class="">
            <div class="">

                <hr>

                <div class="row mt-4 align-items-center">

                    <div class="col-lg-3 userLogin grab">
                        <div class="card mb-4">
                            <div class="card-body">
                                <i class="mdi mdi-account-multiple-plus font-30"></i>
                                <h5 class="font-18 mb-3">User Login Management</h5>
                                <!-- <p class="text-muted mb-0">If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual language.</p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 groupUsers grab">
                        <div class="card mb-4">
                            <div class="card-body">
                                <i class="mdi mdi-account-group font-30"></i>
                                <h5 class="font-18 mb-3">Group Users<i class="fa fa-user-o" aria-hidden="true"></i></h5>
                                <!-- <p class="text-muted mb-0">If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual.</p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 menuManagement grab">
                        <div class="card mb-4">
                            <div class="card-body">
                                <i class="mdi mdi-xbox-controller-menu font-30"></i>
                                <h5 class="mb-3 font-18">Menu Mangement</h5>
                                <!-- <p class="text-muted mb-0">Everyone realizes why a new common language would be desirable one could refuse to pay expensive that translators.</p> -->
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 menuAccessManagement grab">
                        <div class="card mb-4">
                            <div class="card-body">
                                <i class="mdi mdi-lock-open font-30"></i>
                                <h5 class="font-18 mb-3">Menu Access Management</h5>
                                <!-- <p class="text-muted mb-0">If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual.</p> -->
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="card m-b-30">
                    <div class="card-body">

                        <!-- List Of Users -->


                        <div class="row">
                            <div class="col">
                                <h4 class="header-title">List Of Users Login</h4>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary mt-0 float-right">Add New user</button>
                            </div>
                        </div>
                        <hr>

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Full Name</th>
                                    <th>Postion</th>
                                    <th>Group User</th>
                                    <th>Mobile Number</th>
                                    <th>Factory</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php foreach ($listOfUsers as $val) : ?>
                                    <tr>
                                        <td>
                                            <?= ucwords($val->userid) ?>
                                        </td>
                                        <td><?= ucwords($val->firstname) . " " . ucwords($val->lastname)  ?></td>
                                        <td><?= ucwords($val->position_name) ?></td>
                                        <td><?= ucwords($val->user_group_name) ?></td>
                                        <td><?= $val->mobilenumber ?></td>
                                        <td><?= $val->factory_name ?></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm waves-effect waves-light"><span class="fa fa-edit"></span></button>
                                            <button class="btn btn-danger btn-sm waves-effect waves-light"><span class="fa fa-trash"></span></button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                        <!-- End List Of Users -->

                    </div>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->




<?php $this->load->view("_partials/script") ?>