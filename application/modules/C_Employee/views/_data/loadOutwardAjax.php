<div class="card m-b-30">
    <div class="card-body" id="tableOfUsers">

        <div class="row">
            <div class="col">
                <h4 class="header-title">List Of Container Outward</h4>
            </div>
        </div>
        <hr>
        <form id="saveAcceptanse">
            <?php if ($containerNotReceived) echo getAlertBs('warning', "$containerNotReceived containers have not been received"); ?>
            <?php if (strlen($message) > 0) echo getAlertBs('info', $message); ?>

            <div class="vertical-scroll" style="width: 100%;">
                <table class="table table-bordered table-fixed">
                    <thead>
                        <th style="width: 1;" align="center">
                            <div class="form-check" style="text-align: center;">
                                <input <?= $disabledButton ?> id="checkAll" class="form-check-input position-static" type="checkbox">
                            </div>
                        </th>
                        <th>Seq Id</th>
                        <th>Stuffing</th>
                        <th>Container Type</th>
                        <th>Container Number</th>
                        <th>Supplier</th>
                        <th>Customer</th>
                        <th>Boking Ref</th>
                    </thead>
                    <tbody>
                        <?php foreach ($getOutward['contLocalDetail'] as $key => $val) : ?>
                            <input type="hidden" name="contid" value="<?= $val->contid ?>">
                            <tr style="line-height: 1px !important;">
                                <td width="1" align="center">
                                    <div class="form-check ml-10 pb-10 mt-0">
                                        <?php

                                        $checked = "";

                                        foreach ($containerReceived as $received) {
                                            if ($received->id == $val->id) {
                                                $checked = "checked";
                                            }
                                        } ?>
                                        <input <?= $disabledButton ?> <?= $checked ?> class="form-check-input position-static" name="det_id[]" value="<?= $val->id ?>" style="line-height: 1px;" type="checkbox" id="blankCheckbox" aria-label="...">
                                    </div>
                                </td>
                                <td align="center"><?= $key + 1 ?></td>
                                <td><?= $val->stuffing_name ?></td>
                                <td><?= $val->container_type ?></td>
                                <td><?= $val->container_number ?></td>
                                <td><?= $val->name_supp ?></td>
                                <td><?= $val->customer_name ?></td>
                                <td><?= $val->reff ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <hr>
            <button type="button" <?= $disabledButton ?> class="btn btn-danger mt-3 btn-save">Save</button>
        </form>


    </div>
</div>

<script>
    $("#checkAll").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
        // alert("test")
    });
</script>