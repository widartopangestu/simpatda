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
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/pages/signin.css" rel="stylesheet" type="text/css" />
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
                        'items' => $this->mainNav,
                        'htmlOptions' => array('pull' => TbHtml::PULL_RIGHT)
                    )
                )
            ));
        endif;
        ?>
        <?php echo $content; ?>

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
