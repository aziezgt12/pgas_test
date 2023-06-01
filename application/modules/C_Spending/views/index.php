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
                    <!-- <div class="mb-3 col-md-4 ml-3">
                        <label>Employee Name</label>
                        <select class="form-control select2" id="name">
                            <option selected  value="">All</option>
                            <?php foreach($list as $val): ?>
                            <option><?= $val->NAME_Employee ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4 row">
                        <label>Department</label>
                        <select class="form-control select2" id="dept">
                            <option  selected value="">All</option>
                            <?php foreach($listDept as $val): ?>
                            <option value="<?= $val->ID ?>"><?= $val->Name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div> -->
                    <!-- <div class="mb-3 mt-4 ml-1 col-md-4 row">
                        <button class="btn btn-danger btn-sm" onclick="refresh()">Refresh</button>
                    </div> -->
                    <div class="mb-3 mt-4 ml-1 col-md-12">
                    <table class="datatable table table-striped table-bordered dt-responsive nowrap table-search" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <th width="10px">No</th>
                            <th>Name Employee</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Value</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="spending-data">
                            
                        </tbody>
                    </table>

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
                        <select class="form-control" name="EmployeeID" >
                            <option disabled selected>...</option>
                            <?php foreach($listEmp as $val): ?>
                            <option value="<?= $val->IDEmployee ?>"><?= $val->NAME_Employee ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Date</label>
                        <input type="date" class="form-control" name="Date" value="<?= date("Y-m-d") ?>" min="2020-01-01">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Value</label>
                        <input type="" class="form-control" name="Value" id="value">
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
 // Mengambil elemen input
        var inputElement = document.getElementById('value');

        // Menambahkan event listener untuk memantau perubahan nilai input
        inputElement.addEventListener('input', function(event) {
        // Mengambil nilai input
        var inputValue = event.target.value;

        // Menghapus koma yang ada pada nilai input
        var sanitizedValue = inputValue.replace(/,/g, '');

        // Mengubah string menjadi angka
        var number = parseFloat(sanitizedValue);

        // Memeriksa apakah input valid sebagai angka
        if (!isNaN(number)) {
            // Memformat angka dengan koma sebagai pemisah ribuan
            var formattedNumber = number.toLocaleString();

            // Mengubah nilai input menjadi angka yang telah diformat
            event.target.value = formattedNumber;
        }
        });


  // Event delegation for the "Edit" button click
        $(document).on('click', '.open-modal', function() {
            $("#exampleModalLongTitle").html("Form Create Employee")
        //     $(".btn-action").attr('onclick', 'save()');
        var groupId = "<?= $this->session->userdata("groupId") ?>";

        if(groupId == 2)
        {
            Swal.fire("Error", "Hanya admin Yang bisa melakukan delete atau update", 'warning');
            return false;
        }
            $("#modalForm").modal('show')
            // Get the parent table row (tr)
            var row = $(this).closest('tr');

            // Get the text content of each cell in the row
            var id = row.find('td:eq(5)').text();
            var emp = row.find('td:eq(1)').text();
            var value = row.find('td:eq(6)').text();
            var date = row.find('td:eq(7)').text();
            alert(id)
            
            $('#form-data select[name="EmployeeID"] option').each(function() {
                if ($(this).text() === emp) {
                    $(this).prop('selected', true);
                }
            });

      
            $('#form-data input[name="ID"]').val(id);
            $('#form-data input[name="Date"]').val(date);
            $('#form-data input[name="Value"]').val(value);
    
            return false;
        });
    });

    function refresh()
    {
        var name = $('#name').find(":selected").val()
        var dept = $('#dept').find(":selected").val()

        getAjax(name, dept)

    }

    function getAjax(name = null, dept=null){

        $.ajax({
            url: '<?php echo base_url('C_Spending/getAjax'); ?>', // Ganti 'controller' sesuai dengan nama controller Anda
            method: 'POST',
            data: { 
                'employeeName': name, 
                'deptId' : dept 
            },
            dataType: 'html',
            success: function(response) {
                $('#spending-data').html(response);
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
                        url: "<?= base_url("C_Spending/save") ?>",
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
                    var groupId = "<?= $this->session->userdata("groupId") ?>";

                    if(groupId == 2)
                    {
                        Swal.fire("Error", "Hanya admin Yang bisa melakukan delete atau update", 'warning');
                        return false;
                    }
                    $.ajax({
                        type: "post",
                        url: "<?= base_url("C_Spending/delete") ?>",
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