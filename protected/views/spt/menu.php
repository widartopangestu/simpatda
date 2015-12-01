<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Pilih Jenis Pajak / Retribusi');
$this->breadcrumbs = array(
    Yii::t('trans', 'SPTPD') => array('index'),
    Yii::t('trans', 'Pilihan Pajak / Retribusi')
);
?>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/pages/dashboard.css" rel="stylesheet">         
<div class="shortcuts"> 
    <?php if (Yii::app()->util->is_authorized('spt.createHotel')): ?>
        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createHotel" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-hotel.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Hotel'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('spt.createRestoran')): ?>
        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createRestoran" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-restoran.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Restoran'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('spt.createHiburan')): ?>
        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createHiburan" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-hiburan.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Hiburan'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('spt.createReklame')): ?>
        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createReklame" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-reklame.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Reklame'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('spt.createElectric')): ?>
        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createElectric" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-electric.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Penerangan Jalan / Genset'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('spt.createGalian')): ?>
        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createGalian" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-galian.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Bahan Mineral Bukan Logam dan Batuan'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('spt.createAir')): ?>
        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createAir" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-retribusi.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Air Bawah Tanah'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('spt.createWalet')): ?>
        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createWalet" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-walet.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Sarang Burung Walet'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('spt.createRetribusi')): ?>
        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createRetribusi" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-retribusi.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Retribusi'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('spt.createBphtb')): ?>
        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createBphtb" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-bphtb.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'BPHTB'); ?></span> </a>
    <?php endif; ?>
    <?php if (Yii::app()->util->is_authorized('spt.createReklameBaru')): ?>
        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createReklameBaru" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-reklame.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pajak Reklame Baru'); ?></span> </a>
        <?php endif; ?>
</div>
<!-- /shortcuts --> 