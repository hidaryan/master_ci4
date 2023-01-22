<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="col-lg-12">
    <div class="text-left m-t-lg">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Profile User</h5><br>
                        <small>Lengkapi data diri anda</small>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <?= form_open('UserController/saveProfileUser', ['class' => 'formProfileUser', 'role' => 'form']) ?>
                        <?= csrf_field() ?>


                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-5">
                                <input type="text" id="username" name="username" value="<?= user()->username ?>" class="form-control">
                                <div class="invalid-feedback" id="error_username"></div>
                            </div>
                        </div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-5">
                                <input type="text" id="fullname" name="fullname" value="<?= user()->fullname ?>" class="form-control">
                                <div class="invalid-feedback" id="error_fullname"></div>
                            </div>
                        </div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-5">
                                <input type="text" id="email" name="email" value="<?= user()->email ?>" class="form-control">
                                <div class="invalid-feedback" id="error_email"></div>
                            </div>
                        </div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">No Hp</label>
                            <div class="col-sm-5">
                                <input type="text" id="hp" name="hp" value="<?= user()->hp ?>" class="form-control">
                                <div class="invalid-feedback" id="error_hp"></div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <small>Isikan password untuk melakukan perubahan password</small><br>


                        <div class="form-group  row" style="margin-top :20px">
                            <label class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-5">
                                <input type="password" id="password" name="password" value="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" class="form-control">
                                <div class="invalid-feedback" id="error_password"></div>
                            </div>
                        </div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Ulangi Password</label>
                            <div class="col-sm-5">
                                <input type="password" id="password2" name="password2" value="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" class="form-control">
                                <div class="invalid-feedback" id="error_password2"></div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <div class="col-sm-12 text-right col-sm-offset-2">
                                <button class="btn btn-white btn-sm" type="submit">Batal</button>
                                <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>



<?= $this->section('js-content'); ?>

<script>
    $('.formProfileUser').submit(function(e) {

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
                $(".formProfileUser").find('.is-invalid').removeClass("is-invalid");

                if (response.error) {
                    run_validate(response);

                } else {

                    if (response.status == 'gagal') {
                        $('.toast-word').html('');
                        $('.toast-word').html(response.msg);
                        toast2.toast('show');

                    } else if (response.status == 'sukses') {

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