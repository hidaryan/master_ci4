<?= $this->extend('auth/template/index') ?>

<?= $this->section('content'); ?>

<div class="passwordBox animated fadeInDown">
    <div class="row">

        <div class="col-md-12">
            <div class="ibox-content">

                <h3 class="font-bold"><?= lang('Auth.forgotPassword') ?></h3>
                <?= view('Myth\Auth\Views\_message_block') ?>
                <p>
                    <?= lang('Auth.enterEmailForInstructions') ?>
                </p>

                <div class="row">

                    <div class="col-lg-12">
                        <form class="m-t" role="form" action="<?= url_to('forgot') ?>" method="post">
                            <div class="form-group">
                                <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.email') ?>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success block full-width m-b"><?= lang('Auth.sendInstructions') ?></button>

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