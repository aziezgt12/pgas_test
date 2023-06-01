<script>
    var hashUrl = window.location.hash;
    controlButtonSaveCHeckbox()



    if (hashUrl == '#users') {
        loadUsers();
    } else if (hashUrl == '#groupUsers') {
        loadGroup();
    } else if (hashUrl == '#menuManagement') {
        getMenuHeader(1)
        loadMenu();
    } else if (hashUrl == '#menuAccess') {
        loadMenuAccess();
    } else {
        loadUsers();
    }




    $(".userLogin").on("click", function() {
        location.href = "#users"
        loadUsers()
    });

    $(".groupUsers").on("click", function() {
        location.href = "#groupUsers"

        loadGroup()
    });

    $(".menuManagement").on("click", function() {
        location.href = "#menuManagement"

        loadMenu()
    });

    $(".menuAccess").on("click", function() {
        location.href = "#menuAccess"

        loadMenuAccess()
    });

    $(".btn-refresh").on("click", function() {
        var groupId = $("#group_id").find(":selected").val();

        getListMenuAccess(groupId)

        getListFactoryAccess(groupId)

        controlButtonSaveCHeckbox(1);

    });

    $(".btn-save-access-menu").on("click", function() {
        var data = $("#formSaveAccessMenu").serialize()

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
                        url: "<?= base_url("C_Setting/saveAccessMenu") ?>",
                        data: data,
                        dataType: "json",
                        beforeSend: function() {
                            $('.btn-save-access-menu').html('Loading...')
                            // $('.btn-save').html('Loading...');
                        },
                        success: function(response) {
                            // console.log(response);
                            setTimeout(() => {
                                if (response.code == 200) {
                                    sw_alert("Success", "Save Menu Access", "success");
                                    setTimeout(() => {
                                        // location.reload()
                                        getListMenuAccess(response.message)
                                        $('.btn-save-access-menu').html('Save');


                                    }, 1000);
                                } else {
                                    sw_alert("Error", String(response.message), "error");
                                    $('.btn-save-access-menu').html('Save');
                                }
                            }, 1000);
                        }
                    });
                });
            },
        });
    });

    $(".btn-save-menu").on("click", function() {
        var data = $("#formSaveMenu").serialize()

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
                        url: "<?= base_url("C_Setting/saveMenu") ?>",
                        data: data,
                        dataType: "json",
                        beforeSend: function() {
                            $('#btnSaveMenu').html('Loading...')
                        },
                        success: function(response) {
                            setTimeout(() => {
                                if (response.code == 200) {
                                    sw_alert("Success", String(response.message), "success");
                                    setTimeout(() => {
                                        location.reload()
                                        // loadMenu()
                                        $('#btnSaveMenu').html('Save');
                                    }, 1000);
                                } else {
                                    sw_alert("Error", String(response.message), "error");
                                    $('#btnSaveMenu').html('Save');
                                }
                            }, 1000);
                        }
                    });
                });
            },
        });
    });

    $(".btn-group-user").on("click", function() {
        var data = $("#formGroupUser").serialize()

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
                        url: "<?= base_url("C_Setting/saveMenuGroupUser") ?>",
                        data: data,
                        dataType: "json",
                        beforeSend: function() {
                            $('#btnSaveGroupUser').html('Loading...')
                        },
                        success: function(response) {
                            setTimeout(() => {
                                if (response.code == 200) {
                                    sw_alert("Success", String(response.message), "success");
                                    setTimeout(() => {
                                        location.reload()
                                        // loadMenu()
                                        $('#btnSaveMenu').html('Save');
                                    }, 1000);
                                } else {
                                    sw_alert("Error", String(response.message), "error");
                                    $('#btnSaveMenu').html('Save');
                                }
                            }, 1000);
                        }
                    });
                });
            },
        });
    });

    $("#menuLevel").on("change", function() {
        var menuLevel = $("#menuLevel").find(":selected").val();

        getMenuHeader(menuLevel)

    });

    $(document).on("click", ".delete-menu", function() {
        var menuId = $(this).attr('data-menuid');
        var menuLevel = $(this).attr('data-menulevel');

        Swal.fire({
            title: 'Are you sure?',
            text: "this will be deleted!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, deleted it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url("C_Setting/deletedMenu") ?>",
                        data: {
                            "menu_level": menuLevel,
                            "menu_id": menuId
                        },
                        dataType: "json",
                        // beforeSend: function() {
                        //     $('#btnSaveMenu').html('Loading...')
                        // },
                        success: function(response) {
                            // console.log(response)
                            setTimeout(() => {
                                if (response.code == 200) {
                                    sw_alert("Success", String(response.message), "success");
                                    setTimeout(() => {
                                        location.reload()
                                        // $('#btnSaveMenu').html('Save');
                                    }, 1000);
                                } else {
                                    sw_alert("Error", String(response.message), "error");
                                    // $('#btnSaveMenu').html('Save');
                                }
                            }, 1000);
                        }
                    });
                });
            },
        });
    });





    function loadUsers() {
        $("#loadListOfUsers").html("<?php foreach ($listOfUsers as $val) : ?><tr>\n\
            <td><?= ucwords($val->userid) ?></td>\n\
            <td><?= ucwords($val->firstname) . " " . ucwords($val->lastname)  ?></td>\n\
            <td><?= ucwords($val->position_name) ?></td>\n\
            <td><?= ucwords($val->user_group_name) ?></td>\n\
            <td><?= $val->mobilenumber ?></td>\n\
            <td><?= $val->factory_name ?></td>\n\
            <td><button class='btn btn-primary btn-sm waves-effect waves-light'><span class='fa fa-edit'></span></button> <button class='btn btn-danger btn-sm waves-effect waves-light'><span class='fa fa-trash'></span></button>\n\</td>\n\
            </tr>\n\
            <?php endforeach ?>\n\
        ");

        $("#tableOfUsers").show();
        $("#tableOfGroupUsers").hide();
        $("#tableOfMenuMangement").hide();
        $("#tableOfMenuAccess").hide();



    }

    function loadGroup() {
        $("#loadListOfGroup").html("<?php foreach ($listOfGroup as $val) : ?>\n\
            <tr>\n\
                <td class='nowrap style='width: 10px;'><?= ucwords($val->user_group_id) ?></td>\n\
                <td class='nowrap style='width: 100px;'><?= ucwords($val->user_group_name) ?></td>\n\
                <td class='nowrap style='width: 20px;'><?= ucwords($val->user_group_remark) ?></td>\n\
                <td class='nowrap style='width: 50px;'><?= $val->not_active == 0 ? "<span class='badge badge-danger'>Active</span>" : "<span class='badge badge-danger'>Not Active</span>" ?></td>\n\
                <td class='nowrap style='width: 10px;'><?= $val->created_by ?></td>\n\
                <td class='nowrap style='width: 10px;'><?= $val->updated_by ?></td>\n\
                <td class='nowrap style='width: 10px;'><button class='btn btn-primary btn-sm waves-effect waves-light'><span class='fa fa-edit'></span></button> <button class='btn btn-danger btn-sm waves-effect waves-light'><span class='fa fa-trash'></span></button>\n\</td>\n\
            </tr>\n\
            <?php endforeach ?>\n\
        ");

        $("#tableOfGroupUsers").show();
        $("#tableOfUsers").hide();
        $("#tableOfMenuMangement").hide();
        $("#tableOfMenuAccess").hide();

    }

    function loadMenu() {

        $("#loadMenuList").html("<ol class='dd-list'>\n\
                                    <?php foreach ($listOfMenu as $val) : ?>\n\
                                        <li class='dd-item' data-id='2' style='position: 'sticky'; top:'0px'; background-color: 'white'>\n\
                                            <div class='dd-handle'><?= $val['hdrId'] . " - " . $val['title'] ?> <span data-menulevel='1' data-menuid='<?= $val['hdrId'] ?>' class='fa fa-trash pull-right pointer delete-menu' style='color: red'></span></div>\n\
                                            <ol class='dd-list'>\n\
                                                <?php foreach ($val['menuLevel2'] as $levl2) : ?>\n\
                                                <li class='dd-item' data-id='3'>\n\
                                                    <div class='dd-handle'><?= $levl2['subMenuId'] . " - " . $levl2['subMenuTitle'] ?> <span data-menulevel='2' data-menuid='<?= $levl2['subMenuId'] ?>' class='fa fa-trash pull-right pointer delete-menu' style='color: red'></span></div>\n\
                                                    <ol class='dd-list'>\n\
                                                    <?php foreach ($levl2['menuLevel3'] as $lvl3) : ?>\n\
                                                        <li class='dd-item' data-id='6'>\n\
                                                            <div class='dd-handle'><?= $lvl3['dtlMenuId'] . " - " . $lvl3['dtlTitle'] ?> <span data-menulevel='3' data-menuid='<?= $lvl3['dtlMenuId'] ?>' class='fa fa-trash pull-right pointer delete-menu' style='color: red'></span></div>\n\
                                                        </li>\n\
                                                        <?php endforeach ?>\n\
                                                    </ol>\n\
                                                </li>\n\
                                                <?php endforeach ?>\n\
                                            </ol>\n\
                                        </li>\n\
                                        <?php endforeach ?>\n\
                                    </ol>");

        $("#tableOfMenuMangement").show();
        $("#tableOfGroupUsers").hide();
        $("#tableOfUsers").hide();
        $("#tableOfMenuAccess").hide();

    }

    function loadMenuAccess() {

        $("#tableOfMenuAccess").show();
        $("#tableOfMenuMangement").hide();
        $("#tableOfGroupUsers").hide();
        $("#tableOfUsers").hide();

    }

    function getListMenuAccess(groupId) {
        $.ajax({
            type: "GET",
            url: "<?= base_url("C_Setting/getMEnuAccess") ?>",
            data: {
                "group_id": groupId
            },
            dataType: "html",
            beforeSend: function() {
                $('#spinner').attr('class', 'spinner-border spinner-border-sm')

            },
            success: function(response) {
                $('#spinner').removeAttr('class', 'spinner-border spinner-border-sm')
                $("#loadMenuAccessList").html(response);
            }
        });
    }

    function getListFactoryAccess(groupId) {
        $.ajax({
            type: "post",
            url: "<?= base_url("C_Setting/getFactoryAccess") ?>",
            data: {
                group_id: groupId
            },
            dataType: "html",
            success: function(response) {
                // console.log(response);
                $(".listFactoryAccess").html(response)
            }
        });
    }

    function getMenuHeader(mnuLevel) {
        // if (isHeader) {
        if (mnuLevel == 3) {
            $(".form-menu-header").show()

            $("#selectMenu").html("<?php foreach ($listOfMenu as $hdr) : ?>\n\
                <optgroup label='<?= $hdr['title'] ?>'>\n\
                <?php foreach ($hdr['menuLevel2'] as $lvl2) : ?>\n\
                    <option value='<?= $lvl2['subMenuId'] ?>'>\n\
                    <?= $lvl2['subMenuTitle'] ?>\n\
                    </option>\n\
                    <?php endforeach ?>\n\
                </optgroup>\n\
                <?php endforeach ?>");
        } else if (mnuLevel == 2) {
            $(".form-menu-header").show()
            $("#selectMenu").html("<?php foreach ($listOfMenu as $hdr) : ?>\n\
                    <option value='<?= $hdr['hdrId'] ?>'><?= $hdr['title'] ?></option>\n\
                <?php endforeach ?>");
        } else {
            $(".form-menu-header").hide()
        }
    }

    function controlButtonSaveCHeckbox(isActive = 0) {
        if (isActive == 1) {
            $("#blankCheckbox").prop("disabled", false);
            $("#btn-save").prop("disabled", false);
        } else {
            $("#blankCheckbox").prop("disabled", true);
            $("#btn-save").prop("disabled", true);
        }
    }
</script>