<?php
$language = TranslateModule::translator();
$languageKey = $language::ID;

$google = !empty(TranslateModule::translator()->googleApiKey) ? true : false;

$this->breadcrumbs = array(
    Yii::t('trans', 'Translate') => array('translate/index'),
    TranslateModule::t('Translate to {lang}', array('{lang}' => $language->acceptedLanguages[$language->getLanguage()])),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Translate') . ' ' . TranslateModule::t('Missing Translations');
$this->menu = array(
    array('label' => TranslateModule::t('Manage Messages'), 'url' => array('edit/index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('translate.edit.index')) ? true : false),
    array('label' => TranslateModule::t('Missing Translations'), 'url' => array('edit/missing'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('translate.edit.missing')) ? true : false),
);
?>
<div class="widget ">

    <div class="widget-header">
        <i class="icon-refresh"></i>
        <h3><?php echo TranslateModule::t('Translate to {lang}', array('{lang}' => $language->acceptedLanguages[$language->getLanguage()])); ?></h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
        <?php
        if ($google) {
            echo CHtml::link(TranslateModule::t('Translate all with google translate'), "#", array('id' => $languageKey . "-google-translateall"));
            echo CHtml::script(
                    "\$('#{$languageKey}-google-translateall').click(function(){
                var messages=[];\$('.{$languageKey}-google-message').each(function(count){
                    messages[count]=$(this).html();
                });" .
                    CHtml::ajax(array(
                        'url' => $this->createUrl('translate/googletranslate'),
                        'type' => 'post',
                        'dataType' => "json",
                        'data' => array(
                            'language' => Yii::app()->getLanguage(),
                            'sourceLanguage' => Yii::app()->sourceLanguage,
                            'message' => 'js:messages'
                        ),
                        'success' => "js:function(response){
                        \$('.{$languageKey}-google-translation').each(function(count){
                            $(this).val(response[count]);
                        });
                        \$('.{$languageKey}-google-button,#{$languageKey}-google-translateall').hide();
                    }",
                        'error' => 'js:function(xhr){alert(xhr.statusText);}',
                    )) . "
                return false;
            });
        ");
            if (Yii::app()->getRequest()->isAjaxRequest) {
                echo CHtml::script("
                $('#" . $languageKey . '-pager' . " a').click(function(){
                    \$dialog=$('#" . $languageKey . '-dialog' . "').load($(this).attr('href'));
                    return false;
                });
            ");
            }
        }
        ?>
        <div class="form">
            <?php echo CHtml::beginForm(); ?>
            <table>
                <thead>
                <th><?php echo MessageSource::model()->getAttributeLabel('category'); ?></th>
                <th><?php echo MessageSource::model()->getAttributeLabel('message'); ?></th>
                <th><?php echo Message::model()->getAttributeLabel('translation'); ?></th>
                <?php echo $google ? CHtml::tag('th') : null; ?>
                </thead>
                <tbody>
                    <?php
                    $this->widget('bootstrap.widgets.TbListView', array(
                        'dataProvider' => new CArrayDataProvider($models),
                        'pager' => array(
                            'id' => $languageKey . '-pager',
                            'class' => 'bootstrap.widgets.TbPager',
                        ),
                        'viewData' => array(
                            'messages' => $messages,
                            'google' => $google,
                        ),
                        'itemView' => '_form',
                    ));
                    ?>
                </tbody>
            </table>
            <?php
            echo TbHtml::submitButton(TranslateModule::t('Translate'), array(
                'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                'size' => TbHtml::BUTTON_SIZE_DEFAULT,
            ));
            ?>
            <?php echo CHtml::endForm() ?>
        </div>
    </div>
</div>