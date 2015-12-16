<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <?php
        isset(Yii::app()->params['favicon']) ? $favicon = Yii::app()->params['favicon'] : $favicon = 'favicon.ico';
        ?>
        <link rel="icon" href="<?php echo Yii::app()->request->baseUrl . '/images/' . $favicon ?>" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl . '/images/' . $favicon; ?>" type="image/x-icon" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php Yii::app()->bootstrap->register(); ?>
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/cssBootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/cssBootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/google_font.css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" />
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        <?php
        if (isset($this->mainNav)):
            $this->widget('bootstrap.widgets.TbNavbar', array(
                'brandLabel' => '<img class="logo" src="' . Yii::app()->request->baseUrl . '/images/logo.png"> ' . Yii::t('trans', Yii::app()->name) . ' - ' . Yii::app()->params['nama_perusahaan'],
                'collapse' => true,
                'items' => array(
                    array(
                        'class' => 'bootstrap.widgets.TbNav',
                        'items' => array(
                            array('label' => Yii::t('trans', 'Administration'), 'icon' => TbHtml::ICON_COG, 'visible' => !Yii::app()->user->isGuest, 'items' => array(
                                    array('label' => Yii::t('trans', 'Settings'), 'icon' => TbHtml::ICON_COG, 'url' => array('/site/config'), 'visible' => Yii::app()->util->is_authorized('site.config')),
                                    array('label' => Yii::t('trans', 'Manage User'), 'icon' => TbHtml::ICON_LIST_ALT, 'url' => array('/user/index'), 'visible' => Yii::app()->util->is_authorized('user.index')),
                                    array('label' => Yii::t('trans', 'Manage Role'), 'icon' => TbHtml::ICON_LIST_ALT, 'url' => array('/role/admin'), 'visible' => Yii::app()->util->is_authorized('role.admin')),
                                    array('label' => Yii::t('trans', 'Manage Operation'), 'icon' => TbHtml::ICON_LIST_ALT, 'url' => array('/operation/admin'), 'visible' => Yii::app()->util->is_authorized('operation.admin')),
                                    array('label' => Yii::t('trans', 'Manage Backup DB'), 'icon' => TbHtml::ICON_REFRESH, 'url' => array('/backup'), 'visible' => Yii::app()->util->is_authorized('backup.default.index')),
                                    array('label' => Yii::t('trans', 'Manage Translation'), 'icon' => TbHtml::ICON_LIST_ALT, 'url' => array('/translate/edit/index'), 'visible' => Yii::app()->util->is_authorized('translate.edit.index')),
                                    array('label' => Yii::t('trans', 'User Access Log'), 'icon' => TbHtml::ICON_TIME, 'url' => array('/accessLog/index'), 'visible' => Yii::app()->util->is_authorized('accessLog.index')),
//                                    array('label' => Yii::t('trans', 'Help'), 'icon' => TbHtml::ICON_FLAG, 'url' => array('/site/help'))
                                )
                            ),
                            array('label' => User::model()->findByPk(Yii::app()->user->id)->nickname, 'icon' => TbHtml::ICON_USER, 'items' => array(
                                    array('label' => Yii::t('trans', 'Profile'), 'icon' => TbHtml::ICON_USER, 'url' => array('/profile/profile'), 'visible' => Yii::app()->util->is_authorized('profile.profile')),
                                    array('label' => Yii::t('trans', 'Edit Profile'), 'icon' => TbHtml::ICON_EDIT, 'url' => array('/profile/edit'), 'visible' => Yii::app()->util->is_authorized('profile.edit')),
                                    array('label' => Yii::t('trans', 'Change Password'), 'icon' => TbHtml::ICON_COG, 'url' => array('/profile/changePassword'), 'visible' => Yii::app()->util->is_authorized('profile.changePassword')),
                                    array('label' => Yii::t('trans', 'Upload Photo'), 'icon' => TbHtml::ICON_PICTURE, 'url' => array('/profile/changePhoto'), 'visible' => Yii::app()->util->is_authorized('profile.changePhoto')),
                                    (Yii::app()->util->is_authorized('profile.profile') || Yii::app()->util->is_authorized('profile.edit') || Yii::app()->util->is_authorized('profile.changepassword')) ? TbHtml::menuDivider() : array(),
                                    array('label' => Yii::t('trans', 'Login'), 'icon' => TbHtml::ICON_GLOBE, 'url' => Yii::app()->user->loginUrl, 'visible' => Yii::app()->user->isGuest),
                                    array('label' => Yii::t('trans', 'Logout ({user})', array('{user}' => Yii::app()->user->name)), 'icon' => TbHtml::ICON_OFF, 'url' => array('/user/logout'), 'visible' => !Yii::app()->user->isGuest)
                                )
                            ),
                        ),
                        'htmlOptions' => array('pull' => TbHtml::PULL_RIGHT)
                    )
                )
            ));
        endif;
        ?>

        <?php if (isset($this->subNav) || !Yii::app()->user->isGuest): ?>
            <div class="subnavbar">
                <div class="subnavbar-inner">
                    <div class="container">
                        <?php
                        $this->widget('bootstrap.widgets.TbNav', array(
                            'items' => array(
                                array('label' => '<span>' . Yii::t('trans', 'Dashboard') . '</span>', 'visible' => !Yii::app()->user->isGuest, 'url' => array('/site/index')),
                                array('label' => '<span>' . Yii::t('trans', 'Pendaftaran') . '</span>', 'visible' => !Yii::app()->user->isGuest, 'url' => '#', 'items' => array(
                                        array('label' => Yii::t('trans', 'WP Pribadi'), 'visible' => Yii::app()->util->is_authorized('wajibPajak.create'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/wajibPajak/create')),
                                        array('label' => Yii::t('trans', 'WP Badan Usaha'), 'visible' => Yii::app()->util->is_authorized('wajibPajak.create'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/wajibPajak/create?type=2')),
                                        TbHtml::menuDivider(),
                                        array('label' => Yii::t('trans', 'Rekam Data Objek Pajak'), 'visible' => (Yii::app()->util->is_authorized('spt.createHotel') || Yii::app()->util->is_authorized('spt.createRestoran') || Yii::app()->util->is_authorized('spt.createHiburan') || Yii::app()->util->is_authorized('spt.createReklame') || Yii::app()->util->is_authorized('spt.createElectric') || Yii::app()->util->is_authorized('spt.createGalian') || Yii::app()->util->is_authorized('spt.createAir') || Yii::app()->util->is_authorized('spt.createWalet') || Yii::app()->util->is_authorized('spt.createRetribusi') || Yii::app()->util->is_authorized('spt.createBphtb') || Yii::app()->util->is_authorized('spt.createReklameBaru')), 'icon' => TbHtml::ICON_LIST, 'url' => array('/spt/menu')),
                                        array('label' => Yii::t('trans', 'Rekam Laporan Hasil Pemeriksaan (LHP)'), 'visible' => Yii::app()->util->is_authorized('pemeriksaan.create'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/pemeriksaan/create')),
                                        array('label' => Yii::t('trans', 'Cetak Kartu Data'), 'visible' => Yii::app()->util->is_authorized('wajibPajak.kartuData'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/wajibPajak/kartuData')),
                                        TbHtml::menuDivider(),
                                        array('label' => Yii::t('trans', 'Cetak Daftar SPT'), 'visible' => Yii::app()->util->is_authorized('jReport.spt'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/jReport/spt')),
                                        array('label' => Yii::t('trans', 'Cetak Daftar Wajib Pajak'), 'visible' => Yii::app()->util->is_authorized('jReport.wajibPajak'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/jReport/wajibPajak')),
                                        TbHtml::menuDivider(),
                                        array('label' => Yii::t('trans', 'Penutupan Wajib Pajak'), 'visible' => Yii::app()->util->is_authorized('wajibPajak.tutup'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/wajibPajak/tutup')),
                                    )
                                ),
                                array('label' => '<span>' . Yii::t('trans', 'Penetapan') . '</span>', 'visible' => !Yii::app()->user->isGuest, 'url' => '#', 'items' => array(
                                        array('label' => Yii::t('trans', 'Proses Penetapan Pajak'), 'visible' => Yii::app()->util->is_authorized('penetapan.pajak'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/penetapan/pajak')),
                                        array('label' => Yii::t('trans', 'Proses Penetapan LHP'), 'visible' => Yii::app()->util->is_authorized('penetapan.lhp'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/penetapan/lhp')),
                                        TbHtml::menuDivider(),
                                        array('label' => Yii::t('trans', 'Cetak Nota Perhitungan'), 'visible' => Yii::app()->util->is_authorized('penetapan.cetakNotaPerhitungan'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/penetapan/cetakNotaPerhitungan')),
                                        array('label' => Yii::t('trans', 'Cetak Daftar Surat Ketetapan'), 'visible' => Yii::app()->util->is_authorized('penetapan.cetakDaftarPenetapan'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/penetapan/cetakDaftarPenetapan')),
                                        array('label' => Yii::t('trans', 'Cetak Surat Ketetapan'), 'visible' => Yii::app()->util->is_authorized('penetapan.cetakPenetapan'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/penetapan/cetakPenetapan')),
                                    )
                                ),
                                array('label' => '<span>' . Yii::t('trans', 'BKP') . '</span>', 'visible' => !Yii::app()->user->isGuest, 'url' => '#', 'items' => array(
                                        array('label' => Yii::t('trans', 'Rekam Penerimaan Pajak'), 'visible' => Yii::app()->util->is_authorized('setoranPajak.create'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/setoranPajak/create')),
                                        array('label' => Yii::t('trans', 'Rekam Penyetoran ke Bank'), 'visible' => Yii::app()->util->is_authorized('setoranBank.create'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/setoranBank/create')),
                                        TbHtml::menuDivider(),
                                        array('label' => Yii::t('trans', 'Cetak Setoran Pajak'), 'visible' => Yii::app()->util->is_authorized('jReport.setoranPajak'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/jReport/setoranPajak')),
                                    )
                                ),
                                array('label' => '<span>' . Yii::t('trans', 'Pembukuan Pelaporan') . '</span>', 'visible' => !Yii::app()->user->isGuest, 'url' => '#', 'items' => array(
                                        array('label' => Yii::t('trans', 'Rekapitulasi'), 'visible' => (Yii::app()->util->is_authorized('jReport.rekapitulasiHotel') || Yii::app()->util->is_authorized('jReport.rekapitulasiRestoran') || Yii::app()->util->is_authorized('jReport.rekapitulasiHiburan') || Yii::app()->util->is_authorized('jReport.rekapitulasiReklame') || Yii::app()->util->is_authorized('jReport.rekapitulasiElectric') || Yii::app()->util->is_authorized('jReport.rekapitulasiGalian') || Yii::app()->util->is_authorized('jReport.rekapitulasiAir') || Yii::app()->util->is_authorized('jReport.rekapitulasiWalet') || Yii::app()->util->is_authorized('jReport.rekapitulasiRetribusi') || Yii::app()->util->is_authorized('jReport.rekapitulasiBphtb')), 'icon' => TbHtml::ICON_LIST, 'url' => array('/jReport/rekapitulasiMenu')),
                                        array('label' => Yii::t('trans', 'Rekapitulasi Penerimaan'), 'visible' => (Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanHotel') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanRestoran') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanHiburan') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanReklame') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanElectric') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanGalian') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanAir') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanWalet') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanRetribusi') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanBphtb')), 'icon' => TbHtml::ICON_LIST, 'url' => array('/jReport/rekapitulasiPenerimaanMenu')),
                                    )
                                ),
                                array('label' => '<span>' . Yii::t('trans', 'Penagihan') . '</span>', 'visible' => !Yii::app()->user->isGuest, 'url' => '#', 'items' => array(
                                        array('label' => Yii::t('trans', 'Cetak Buku Kendali'), 'visible' => Yii::app()->util->is_authorized('penagihan.bukuKendali'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/penagihan/bukuKendali')),
                                        array('label' => Yii::t('trans', 'Cetak Daftar Tunggakan'), 'visible' => Yii::app()->util->is_authorized('penagihan.daftarTunggakan'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/penagihan/daftarTunggakan')),
                                        array('label' => Yii::t('trans', 'Cetak Surat Teguran'), 'visible' => Yii::app()->util->is_authorized('penagihan.suratTeguran'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/penagihan/suratTeguran')),
                                    )
                                ),
                                array('label' => '<span>' . Yii::t('trans', 'Data Master') . '</span>', 'visible' => !Yii::app()->user->isGuest, 'url' => '#', 'items' => array(
                                        array('label' => Yii::t('trans', 'Bidang Usaha'), 'visible' => Yii::app()->util->is_authorized('bidangUsaha.index'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/bidangUsaha/index')),
                                        array('label' => Yii::t('trans', 'Golongan'), 'visible' => Yii::app()->util->is_authorized('golongan.index'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/golongan/index')),
                                        array('label' => Yii::t('trans', 'Jabatan'), 'visible' => Yii::app()->util->is_authorized('jabatan.index'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/jabatan/index')),
                                        array('label' => Yii::t('trans', 'Jenis Surat'), 'visible' => Yii::app()->util->is_authorized('jenisSurat.index'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/jenisSurat/index')),
                                        array('label' => Yii::t('trans', 'Kecamatan'), 'visible' => Yii::app()->util->is_authorized('kecamatan.index'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/kecamatan/index')),
                                        array('label' => Yii::t('trans', 'Kelurahan'), 'visible' => Yii::app()->util->is_authorized('kelurahan.index'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/kelurahan/index')),
                                        array('label' => Yii::t('trans', 'Kode Rekening'), 'visible' => Yii::app()->util->is_authorized('kodeRekening.index'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/kodeRekening/index')),
                                        array('label' => Yii::t('trans', 'Pangkat'), 'visible' => Yii::app()->util->is_authorized('pangkat.index'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/pangkat/index')),
                                        array('label' => Yii::t('trans', 'Pejabat'), 'visible' => Yii::app()->util->is_authorized('pejabat.index'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/pejabat/index')),
                                        array('label' => Yii::t('trans', 'Wajib Pajak'), 'visible' => Yii::app()->util->is_authorized('wajibPajak.index'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/wajibPajak/index')),
                                    )
                                ),
                                array('label' => '<span>' . Yii::t('trans', 'Report') . '</span>', 'visible' => !Yii::app()->user->isGuest, 'url' => '#', 'items' => array(
                                        array('label' => Yii::t('trans', 'User List'), 'visible' => Yii::app()->util->is_authorized('jReport.userList'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/jReport/userList')),
                                        array('label' => Yii::t('trans', 'User Actvity'), 'visible' => Yii::app()->util->is_authorized('jReport.userActivityList'), 'icon' => TbHtml::ICON_LIST, 'url' => array('/jReport/userActivityList')),
                                    )
                                ),
                            ),
                            'encodeLabel' => false,
                            'htmlOptions' => array(
                                'class' => 'mainNav'
                            )
                        ));
                        ?>
                    </div>
                    <!-- /container --> 
                </div>
                <!-- /subnavbar-inner --> 
            </div>
            <!-- /subnavbar -->
        <?php endif; ?>
        <div class="main-inner">
            <div class="container">
                <?php if (Yii::app()->user->getFlashes(false)): ?>
                    <?php $flashes = Yii::app()->user->getFlashes(false) ?>
                    <?php foreach ($flashes as $k => $v): ?>
                        <?php $msg = explode('|', $v); ?>
                        <div class="alert alert-<?php echo $k; ?> alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><?php echo CHtml::encode($msg[0]); ?></strong>
                            <p><?php echo CHtml::encode($msg[1]); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php echo $content; ?>

            </div>
            <!-- /container --> 
        </div>
        <!-- /extra-inner --> 
        <!-- /extra -->
        <div class="footer">
            <div class="footer-inner">
                <div class="container">
                    <div class="row">
                        <div class="span12"><?php echo Yii::app()->params['copyrightInfo']; ?>
                            <span class="pull-right">
                                <?php
                                $translate = Yii::app()->translate;
                                if ($translate->hasMessages()) {
                                    echo $translate->translateLink('Translate');
                                }
                                ?>
                            </span>
                        </div>
                        <!-- /span12 --> 
                    </div>
                    <!-- /row --> 
                </div>
                <!-- /container --> 
            </div>
            <!-- /footer-inner --> 
        </div>
        <!-- /footer --> 
        <script type="text/javascript">
            jQuery('.nav-collapse').height(0);
            $('form:not(.report)').on('submit', function () {
                $(this).find('button[type=submit]:first').prop('disabled', true);
            });
        </script>
    </body>
</html>
