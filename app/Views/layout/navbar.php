<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <div class="row">
                        <div class="col-xs-4">
                            <?php
                            if (user()->user_image == 'name.jpg') {
                                $name       = explode(" ", user()->fullname);
                                $initial    = "";
                                $i = 0;
                                foreach ($name as $w) {
                                    if ($i == 2) {
                                        break;
                                    }
                                    $initial .= mb_substr($w, 0, 1);
                                    $i++;
                                }
                            ?>
                                <div class="avatar-circle">
                                    <span class="initials"><?= $initial ?></span>
                                </div>

                            <?php
                            } else {
                            ?>
                                <img alt="image" class="rounded-circle" src="img/profile_small.jpg" />
                            <?php
                            }
                            ?>

                        </div>
                        <div class="col">
                            <span class="text-white block m-t-xs font-bold"><?= user()->fullname  ?></span>
                            <span class="badge badge-pill badge-secondary"><?= user()->branch  ?></span>
                        </div>
                    </div>




                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li <?= (current_url(true)->getSegment(1) == '' ? 'class="active"' : ''); ?>>
                <a href="/"><i class="fa fa-home"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li <?= (current_url(true)->getSegment(1) == 'nde' ? 'class="active"' : ''); ?>>
                <a href="index.html"><i class="fa fa-archive"></i> <span class="nav-label">Arsip NDE</span> <span class="fa arrow"></span></a>

                <ul class="nav nav-second-level collapse">
                    <li <?= ($nav == 'inbox') ? 'class="active"' : ''; ?>><a href="<?= base_url('/nde/inbox') ?>">Surat Masuk</a></li>
                    <li <?= ($nav == 'outbox') ? 'class="active"' : ''; ?>><a href="<?= base_url('/nde/outbox') ?>">Surat Keluar</a></li>
                </ul>
            </li>


            <?php if (has_permission('users')) : ?>
                <li <?= (current_url(true)->getSegment(1) == 'user' ? 'class="active"' : ''); ?>>
                    <a href="index.html"><i class="fa fa-users"></i> <span class="nav-label">Pengeloaan User</span> <span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level collapse">
                        <?php if (has_permission('manageUser')) : ?><li <?= ($nav == 'manageUser') ? 'class="active"' : ''; ?>><a href="<?= base_url('/user') ?>">Daftar User</a></li><?php endif; ?>
                        <?php if (has_permission('profileUser')) : ?><li <?= ($nav == 'profileUser') ? 'class="active"' : ''; ?>><a href="<?= base_url('/user/profile') ?>">Profile</a></li><?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>

    </div>
</nav>