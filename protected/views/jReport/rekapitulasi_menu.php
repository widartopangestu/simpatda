<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Pilih Jenis Pajak / Retribusi');
$this->breadcrumbs = array(
    Yii::t('trans', 'Rekapitulasi'),
);
?>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/pages/dashboard.css" rel="stylesheet">         
<div class="shortcuts"> 
    <?php if (Yii::app()->util->is_authorized('jReport.rekapitulasiHotel')): ?>
    <a href="<?php echo Yii::app()->createUrl('jReport/rekapitulasi', array('pajak'=> Spt::PARENT_HOTEL)); ?>" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-hotel.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Hotel'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('jReport.rekapitulasiRestoran')): ?>
        <a href="<?php echo Yii::app()->createUrl('jReport/rekapitulasi', array('pajak'=> Spt::PARENT_RESTORAN)); ?>" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-restoran.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Restoran'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('jReport.rekapitulasiHiburan')): ?>
        <a href="<?php echo Yii::app()->createUrl('jReport/rekapitulasi', array('pajak'=> Spt::PARENT_HIBURAN)); ?>" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-hiburan.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Hiburan'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('jReport.rekapitulasiReklame')): ?>
        <a href="<?php echo Yii::app()->createUrl('jReport/rekapitulasi', array('pajak'=> Spt::PARENT_REKLAME)); ?>" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-reklame.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Reklame'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('jReport.rekapitulasiElectric')): ?>
        <a href="<?php echo Yii::app()->createUrl('jReport/rekapitulasi', array('pajak'=> Spt::PARENT_ELECTRIC)); ?>" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-electric.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Penerangan Jalan / Genset'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('jReport.rekapitulasiGalian')): ?>
        <a href="<?php echo Yii::app()->createUrl('jReport/rekapitulasi', array('pajak'=> Spt::PARENT_GALIAN)); ?>" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-galian.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Bahan Mineral Bukan Logam dan Batuan'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('jReport.rekapitulasiAir')): ?>
        <a href="<?php echo Yii::app()->createUrl('jReport/rekapitulasi', array('pajak'=> Spt::PARENT_AIR)); ?>" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-retribusi.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Air Bawah Tanah'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('jReport.rekapitulasiWalet')): ?>
        <a href="<?php echo Yii::app()->createUrl('jReport/rekapitulasi', array('pajak'=> Spt::PARENT_WALET)); ?>" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-walet.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Sarang Burung Walet'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('jReport.rekapitulasiRetribusi')): ?>
        <a href="<?php echo Yii::app()->createUrl('jReport/rekapitulasi', array('pajak'=> Spt::PARENT_RETRIBUSI)); ?>" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-retribusi.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Retribusi'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('jReport.rekapitulasiBphtb')): ?>
        <a href="<?php echo Yii::app()->createUrl('jReport/rekapitulasi', array('pajak'=> Spt::PARENT_BPHTB)); ?>" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-bphtb.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'BPHTB'); ?></span> </a>
        <?php endif; ?>
</div>
<!-- /shortcuts --> 