<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
            <!-- <li>
                                <a href="<?= base_url() ?>" class="waves-effect">
                                    <i class="icon-home"></i></span> <span>Beranda</span>
                                </a>
                            </li> -->
                <?php foreach ($listMenu as $item) : ?>
                    <li class="menu-title"><?= $item['title'] ?></li>
                    <?php foreach ($item['menuLevel2'] as $submenu) : ?>
                        <?php if (count($submenu['menuLevel3']) > 0) { ?>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> <?= $submenu['subMenuTitle'] ?> <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <?php foreach ($submenu['menuLevel3'] as $dtlMenu) : ?>
                                        <li><a href="email-inbox.html"><?= $dtlMenu['dtlTitle'] ?></a></li>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="<?= base_url($submenu['subMenuLink']) ?>" class="waves-effect">
                                    <!-- <i class="icon-accelerator"></i><span class="badge badge-success badge-pill float-right">9+</span> <span> Dashboard </span> -->
                                    <i class="icon-accelerator"></i></span> <span> <?= $submenu['subMenuTitle'] ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    <?php endforeach; ?>
                <?php endforeach ?>
                <li>
                    <a href="<?= base_url("C_Auth/logout") ?>" class="waves-effect"><i class="fas fa-power-off"></i><span> Logout <span class="float-right menu-arrow"></span> </span></a>

                </li>


            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->