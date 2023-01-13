<?= $this->extend('auth/template/index') ?>

<?= $this->section('content'); ?>

<div class="passwordBox animated fadeInDown">
    <div class="row">

        <div class="col-md-12">
            <div class="ibox-content">

                <h3 class="font-bold"><?= lang('Auth.resetYourPassword') ?></h3>
                <?= view('Myth\Auth\Views\_message_block') ?>
                <p>
                    <?= lang('Auth.enterCodeEmailPassword') ?>
                </p>

                <div class="row">

                    <div class="col-lg-12">
                        <form class="m-t" role="form" action="<?= url_to('reset-password') ?>" method="post">
                            <div class="form-group">
                                <label for="token"><?= lang('Auth.token') ?></label>
                                <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.token') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email"><?= lang('Auth.email') ?></label>
                                <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.email') ?>
                                </div>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="password"><?= lang('Auth.newPassword') ?></label>
                                <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password">
                                <div class="invalid-feedback">
                                    <?= session('errors.password') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass_confirm"><?= lang('Auth.newPasswordRepeat') ?></label>
                                <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm">
                                <div class="invalid-feedback">
                                    <?= session('errors.pass_confirm') ?>
                                </div>
                            </div>

                            <br>

                            <button type="submit" class="btn btn-success btn-block"><?= lang('Auth.resetPassword') ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-6">
            Bank Kalsel- Divisi TSI
        </div>
        <div class="col-md-6 text-right">
            <small>© 2022 ryanhidayat</small>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>