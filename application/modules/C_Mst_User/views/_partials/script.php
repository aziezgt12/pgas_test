<script>
    $(document).on("click", ".btn-refresh", function() {
        getAllAcontainerAcceptanse($(".filterOutward").serialize())
    });




    $(document).on("click", ".btn-save", function() {
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
                        url: "<?= base_url("C_ContainerAcceptanse/save") ?>",
                        data: $("#saveAcceptanse").serialize(),
                        dataType: "json",
                        beforeSend: function() {
                            // $('#spinnerSave').attr('class', 'spinner-border spinner-border-sm')
                            $('.btn-save').html('Loading...');
                        },
                        success: function(response) {
                            console.log(response);
                            setTimeout(() => {
                                if (response.code == 200) {
                                    sw_alert("Success", String(response.message), "success");
                                    setTimeout(() => {
                                        location.reload()
                                    }, 3000);
                                } else {
                                    sw_alert("Error", String(response.message), "error");
                                    $('.btn-save').html('Save');
                                }
                            }, 3000);
                        }
                    });
                });
            },
        });
    });

    // List Container Yang sudah diterima atau outstanding
    function getAllAcontainerAcceptanse(param) {
        $.ajax({
            type: "post",
            url: "<?= base_url("C_ContainerAcceptanse/getAllAjax") ?>",
            data: param,
            // dataType: "html",
            beforeSend: function() {
                $('#spinner').attr('class', 'spinner-border spinner-border-sm')
            },
            success: function(response) {
                console.log(response)
                try {
                    sw_alert("Error", String(jQuery.parseJSON(response).message), "error");
                    $('#spinner').removeAttr('class', 'spinner-border spinner-border-sm')

                } catch (error) {
                    setTimeout(function() {
                        $(".loadOutward").html(response)
                        $('#spinner').removeAttr('class', 'spinner-border spinner-border-sm')
                    }, 2000);
                }

            }
        });
    }
</script>