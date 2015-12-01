<?php
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Home');
$this->breadcrumbs = array(
    Yii::t('trans', 'Dashboard')
);
?>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/pages/dashboard.css" rel="stylesheet"> 
<div class="row">
    <div class="span8">
                <div class="shortcuts"> 
                    <?php if (Yii::app()->util->is_authorized('wajibPajak.create')): ?>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/wajibPajak/create" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-pend_p.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pendaftaran WPWR Pribadi'); ?></span> </a>
                    <?php endif; ?>
                    <?php if (Yii::app()->util->is_authorized('wajibPajak.create')): ?>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/wajibPajak/create?type=2" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-pend_bu.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pendaftaran WPWR BU'); ?></span> </a>
                    <?php endif; ?>
                    <?php if (Yii::app()->util->is_authorized('spt.createHotel') || Yii::app()->util->is_authorized('spt.createRestoran') || Yii::app()->util->is_authorized('spt.createHiburan') || Yii::app()->util->is_authorized('spt.createReklame') || Yii::app()->util->is_authorized('spt.createElectric') || Yii::app()->util->is_authorized('spt.createGalian') || Yii::app()->util->is_authorized('spt.createAir') || Yii::app()->util->is_authorized('spt.createWalet') || Yii::app()->util->is_authorized('spt.createRetribusi') || Yii::app()->util->is_authorized('spt.createBphtb') || Yii::app()->util->is_authorized('spt.createReklameBaru')): ?>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/menu" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-menulist.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Pendataan SPT'); ?></span> </a>
                    <?php endif; ?>
                    <?php if (Yii::app()->util->is_authorized('spt.createHotel')): ?>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createHotel" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-lhp.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'LHP'); ?></span> </a>
                    <?php endif; ?>
                    <?php if (Yii::app()->util->is_authorized('spt.createHotel')): ?>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createHotel" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-penetapan.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Penetapan Pajak/Retribusi'); ?></span> </a>
                    <?php endif; ?>
                    <?php if (Yii::app()->util->is_authorized('spt.createHotel')): ?>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createHotel" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-penetapan_stprd.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Penetapan STPD/STRD'); ?></span> </a>
                    <?php endif; ?>
                    <?php if (Yii::app()->util->is_authorized('spt.createHotel')): ?>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createHotel" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-setoran.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Penerimaan(Setoran)'); ?></span> </a>
                    <?php endif; ?>
                    <?php if (Yii::app()->util->is_authorized('spt.createHotel')): ?>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/spt/createHotel" class="shortcut"><img src="<?php echo Yii::app()->baseUrl; ?>/images/shortcut-icons/icon-48-setoran_bank.png" /><span class="shortcut-label"><?php echo Yii::t('trans', 'Setoran ke Bank'); ?></span> </a>
                    <?php endif; ?>
                <!-- /shortcuts --> 
            </div>
    </div>
    <!-- /span6 -->
    <div class="span3">        
        <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-user"></i>
                <h3><?php echo Yii::t('trans', 'User Information');?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="well-small">
                    <?php
                    $this->widget('zii.widgets.CDetailView', array(
                        'htmlOptions' => array(
                            'class' => 'table table-striped table-condensed table-hover',
                        ),
                        'data' => $user,
                        'attributes' => array(
                            'username',
                            'email',
                            'fullname',
//                            'phone_1',
//                            array(
//                                'name' => 'status',
//                                'type' => 'raw',
//                                'value' => CHtml::encode($user->statusText),
//                            ),
                            array(
                                'name' => 'role_id',
                                'type' => 'raw',
                                'value' => $user->roleName,
                            ),
                            array(
                                'name' => 'last_login',
                                'type' => 'raw',
                                'value' => Yii::app()->format->timeago($user->last_login),
                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>
            <!-- /widget-content --> 
        </div>
        <!-- /widget -->
    </div>
    <!-- /span6 --> 
</div>