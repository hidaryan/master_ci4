<?= $this->extend('layout/template'); ?>

<?= $this->section('css-content'); ?>



<?= $this->endSection(); ?>

<?= $this->section('content'); ?>


<div class="row">
    <div class="col-lg">
        <div class="ibox">
            <div class="ibox-title" style="margin-bottom:2px">
                <h5>Daftar User</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>

            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-8 b-r" id="div_table">
                        <table id="table_data" class="table table-striped table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Hp</th>
                                    <th>Cabang</th>
                                    <th>Group</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                    <div class="col-sm-4" style="padding:0px" id="div_action">

                        <div class="ibox-title">
                            <h3 class="titleForm"></h3>
                            <div class="ibox-tools">
                                <button class="btn btn-default btn-circle btn-xs" type="button" onclick="hideAct1()"><i class="fa fa-times"></i>
                                </button>
                            </div>

                        </div>

                        <div class="ibox-content border-0">

                            <?= form_open('UserController/saveRegisterUser', ['class' => 'formRegisterUser', 'role' => 'form']) ?>
                            <?= csrf_field() ?>
                            <input type="hidden" id="id" name="id">

                            <div class="form-group">
                                <label for="fullname">Nama</label>
                                <input type="text" id="fullname" name="fullname" placeholder="" class="form-control">
                                <div class="invalid-feedback" id="error_fullname"></div>
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" placeholder="" class="form-control">
                                <div class="invalid-feedback" id="error_username"></div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" placeholder="" class="form-control">
                                        <div class="invalid-feedback error_email"></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="hp">HP</label>
                                        <input type="number" id="hp" name="hp" placeholder="" class="form-control">
                                        <div class="invalid-feedback error_hp"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch">Group</label><br>
                                        <select data-placeholder="Pilih" id="groupUser" name="groupUser" class="form-control chosen-select">
                                            <option selected="selected" disabled>pilih</option>
                                        </select>
                                        <div class="invalid-feedback error_groupUser"></div>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch">Cabang</label><br>
                                        <select id="branch" name="branch" class="form-control chosen-select ">
                                            <option selected="selected" disabled>pilih</option>

                                        </select>
                                        <div class="invalid-feedback error_branch"></div>
                                    </div>
                                </div>
                            </div>




                            <div class="hr-line-dashed"></div>

                            <button class="btn btn-success btn-rounded btn-outline float-right m-t-n-xs btnsimpan" type="submit" style="margin-left:8px"><i class="fa fa-save"></i>&nbsp;&nbsp;<span class="bold">Save</span></button>
                            <a class="btn btn-default btn-rounded btn-outline float-right m-t-n-xs btncancel" onclick="hideAct1()"><i class="fa fa-times"></i>&nbsp;&nbsp;<span class="bold">Cancel</span></a>

                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js-content'); ?>

<script>
    $(document).ready(function() {

        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-xs action';

        hideAct1();

        var table = $('#table_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php base_url() ?>/userController/tableUsers",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [],
                "orderable": false,
            }, ],
            "scrollX": true,
            "scrollY": '600px',
            "scrollCollapse": false,
            "columns": [{
                    'targets': 0,
                    "width": "5%"
                    //  "render": function(data) {
                    //      return '<img class="rounded-circle" src="img/profile/' + data + '" class="avatar" width="50" height="50"/>';
                    //  }

                },
                {
                    'targets': 1,
                    "width": "15%"
                },
                {
                    'targets': 2,
                    "width": "10%"
                },
                {
                    'targets': 3,
                    "width": "10%"
                },
                {
                    'targets': 4,
                    "width": "15%"
                },
                {
                    'targets': 5,
                    "width": "20%"
                },
                {
                    'targets': 6,
                    "width": "10%"
                },
                {
                    'targets': 7,
                    "width": "10%"
                },
                {
                    'targets': 8,
                    "width": "10%"
                },
            ],
            "dom": '<"html5buttons"B>lTfgitp',
            "buttons": [{
                    extend: 'excelHtml5',
                    text: '<button class="btn btn-success btn-xs" type="button"><i class="fa fa-file-excel-o"></i></button>',
                    titleAttr: 'Excel'
                },
                {
                    extend: 'print',
                    text: '<button class="btn btn-success btn-xs" type="button"><i class="fa fa-print"></i></button>',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                },
                {
                    text: '<button class="btn btn-success btn-xs" type="button"><i class="fa fa-plus"></i>&nbsp;Add User</button>',
                    action: function(e, dt, node, config) {
                        showAct1();
                    }
                }
            ]
        });

        //menambahkan strle pada button datatable
        $('.action').css("border-style", "none");
        $('.action').css("padding", "2px");

        //add option pada select cabang
        var listCabang = <?= $listCabang ?>;
        for (i = 0; i < listCabang.length; i++) {
            $('#branch').append('<option value="' + listCabang[i].kd_cab + '">' + listCabang[i].kd_cab + ' - ' + listCabang[i].nama_cab + '</option>');
        }
        $('#branch').trigger("chosen:updated");

        //add option pada select group
        var listGroup = <?= $listGroup ?>;
        for (i = 0; i < listGroup.length; i++) {
            $('#groupUser').append('<option value="' + listGroup[i].name + '">' + listGroup[i].name + '</option>');
        }
        $('#groupUser').trigger("chosen:updated");


    });

    function hideAct1() {
        //alert('s');
        $('#div_action').hide("fast");
        $("#div_table").removeClass("col-sm-8 b-r");
        $("#div_table").addClass("col-sm-12");
    }

    function showAct1() {
        $('.titleForm').text("Registrasi Data User");
        $('#div_action').show("fast");
        $('#div_table').removeClass("col-sm-12");
        $('#div_table').addClass("col-sm-8 b-r");
    }

    function hideAct2() {
        $('#div_action').hide("fast");
        $("#div_table").removeClass("col-sm-8");
        $("#div_table").addClass("col-sm-12");
    }

    function showAct2() {
        $('#div_action').show("fast");
        $("#div_table").removeClass("col-sm-12");
        $("#div_table").addClass("col-sm-8");
    }

    $('.formRegisterUser').submit(function(e) {

        let toast1 = $('.toast1');
        toast1.toast({
            delay: 5000,
            animation: true
        });
        let toast2 = $('.toast2');
        toast2.toast({
            delay: 5000,
            animation: true
        });

        e.preventDefault();
        $.ajax({
            type: "post",
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnsimpan').attr('disable', 'disabled');
                $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btnsimpan').removeAttr('disable');
                $('.btnsimpan').html('<i class="fa fa-save" disabled></i>&nbsp;&nbsp;<span class="bold">Simpan</span>');
            },
            success: function(response) {
                //reset form apabila sebelumnya adaerror
                $(".formRegisterUser").find('.is-invalid').removeClass("is-invalid");

                if (response.error) {
                    run_validate(response);

                } else {

                    if (response.status == 'gagal') {
                        $('.toast-word').html('');
                        $('.toast-word').html(response.msg);
                        toast2.toast('show');

                    } else if (response.status == 'sukses') {
                        //eset_form();
                        //remove_validate();
                        $('.toast-word').html('');
                        $('.toast-word').html(response.msg);
                        toast1.toast('show');

                    }

                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>

<?= $this->endSection(); ?>