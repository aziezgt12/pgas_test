<style>
    .opacity-50 {
        opacity: 0.5;
    }

    .pointer-events-none {
        pointer-events: none;
    }
</style>
<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <!-- <h4 class="mt-0 header-title">List Of Employee</h4> -->
                </div>
                <div class="col-md-6">
                    <button class='btn btn-primary float-right col-md-3 open-modal'>Tambah Data</button>
                </div>
            </div>
                <hr>


               
                <div class="row">
                    <div class="mb-3 col-md-3 ml-3">
                        <label>From Date</label>
                        <input type="date" class="form-control" name="from_date" id="from_date" min="2020-01-01">
                    </div>
                    <div class="mb-3 col-md-3 ml-3">
                        <label>To Date</label>
                        <input type="date" class="form-control" name="to_date" id="to_date" min="2020-01-01">
                    </div>
                    <div class="mb-3 col-md-3 row">
                        <label>Value</label>
                        <select class="form-control select2" id="value" name="value">
                            <option  selected value="">All</option>
                            <?php foreach($listValue as $val): ?>
                            <option value="<?= $val->Value ?>"><?= number_format($val->Value)  ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3 mt-4 ml-1 col-md-3 row">
                        <button class="btn btn-danger btn-sm" onclick="refresh()">Refresh</button>
                    </div>
                    <div class="mb-3 mt-4 ml-1 col-md-12">
                    <table class="datatable table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Value</th>
                        </thead>
                        <tbody id="report-data">
                            
                        </tbody>
                    </table>

                    <a href="<?= base_url('PdfController') ?>" target="_blank" class="btn btn-danger btn-print">Download PDF</a>

                    </div>
                </div>
                

            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name Employee</label>
                        <input type="hidden" class="form-control" name="ID">
                        <input type="text" class="form-control" name="Name" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Department</label>
                        <select class="form-control" name="DepartmentID" >
                            <option disabled selected>...</option>
                            <?php foreach($listDept as $val): ?>
                            <option value="<?= $val->ID ?>"><?= $val->Name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-group-user btn-action" onclick="save()" >Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        getAjax()
  // Event delegation for the "Edit" button click
        $(document).on('click', '.open-modal', function() {
            $("#exampleModalLongTitle").html("Form Create Employee")
        //     $(".btn-action").attr('onclick', 'save()');
            $("#modalForm").modal('show')
            // Get the parent table row (tr)
            var row = $(this).closest('tr');

            // Get the text content of each cell in the row
            var id = row.find('td:eq(0)').text();
            var nama = row.find('td:eq(1)').text();
            var dept = row.find('td:eq(2)').text();
            $('#form-data select[name="DepartmentID"] option').each(function() {
                if ($(this).text() === dept) {
                    $(this).prop('selected', true);
                }
            });

      
            $('#form-data input[name="ID"]').val(id);
            $('#form-data input[name="Name"]').val(nama);
            $('#form-data input[name="DepartmentID"]').val(dept);
    
            return false;
        });
    });

    function refresh()
    {
        var fromDate = 0;
        var toDate = 0;
        var value = 0;

        fromDate = $('#from_date').val().length == 0 ? 0 : $('#from_date').val()
        toDate = $('#to_date').val().length == 0 ? 0 : $('#to_date').val()
        value = $('#value').find(":selected").val().length == 0 ? 0 : $('#value').find(":selected").val()


        $('.btn-print').removeAttr('href');
        $('.btn-print').attr('href', '<?= base_url("PdfController/index/") ?>'+fromDate+'/'+toDate+'/'+value);


        getAjax(fromDate, toDate, value)

    }

    function getAjax(fromDate = null, toDate=null, value=null){
        $.ajax({
            url: '<?php echo base_url('C_Employee/getAjaxReport'); ?>', // Ganti 'controller' sesuai dengan nama controller Anda
            method: 'POST',
            data: { 
                'fromDate': fromDate, 
                'toDate' : toDate, 
                'value' : value 
            },
            dataType: 'html',
            success: function(response) {
                $('#report-data').html(response);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    function save()
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "It will be saved!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url("C_Employee/save") ?>",
                        data: $("#form-data").serialize(),
                        dataType: "json",
                        beforeSend: function() {
                            // $('#spinnerSave').attr('class', 'spinner-border spinner-border-sm')
                            $('.btn-action').html('Loading...');
                            $('.btn-action').attr('disabled', true);
                        },
                        success: function(response) {
                            console.log(response);
                            setTimeout(() => {
                                if (response.code == 200) {
                                    sw_alert("Success", String(response.message), "success");
                                    setTimeout(() => {
                                        location.reload()
                                    }, 1000);
                                } else {
                                    sw_alert("Error", String(response.message), "error");
                                    $('.btn-save').html('Save');
                                }
                                
                            $('.btn-action').html('save');
                            $('.btn-action').attr('disabled', false);
                            }, 1000);


                        },
                        error:  function (jqXHR, textError) { 
                            console.log(jqXHR);
                            console.log(textError);
                         }
                    });
                });
            },
        });
    }

    function deleted(id)
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "It will be deleted!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url("C_Employee/delete") ?>",
                        data: {
                            'id' : id
                        },
                        dataType: "json",
                        beforeSend: function() {
                            // $('#spinnerSave').attr('class', 'spinner-border spinner-border-sm')
                            $('.btn-action').html('Loading...');
                            $('.btn-action').attr('disabled', true);
                        },
                        success: function(response) {
                            console.log(response);
                            setTimeout(() => {
                                if (response.code == 200) {
                                    sw_alert("Success", String(response.message), "success");
                                    setTimeout(() => {
                                        location.reload()
                                    }, 1000);
                                } else {
                                    sw_alert("Error", String(response.message), "error");
                                    $('.btn-save').html('Save');
                                }
                                
                            $('.btn-action').html('save');
                            $('.btn-action').attr('disabled', false);
                            }, 1000);


                        },
                        error:  function (jqXHR, textError) { 
                            console.log(jqXHR);
                            console.log(textError);
                         }
                    });
                });
            },
        });
    }
</script>

<?php $this->load->view("_partials/script") ?>