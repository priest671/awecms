<div class="form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
    </p>

    <?php
    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'zero-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    ));

    echo $form->errorSummary($model);
    ?>
    
        <div class="row">
            <?php echo $form->labelEx($model,'name'); ?>
            <?php echo CHtml::activeCheckBoxList($model, 'name', array(
			'one' => Yii::t('app', 'One') ,
			'two' => Yii::t('app', 'Two') ,
			'three' => Yii::t('app', 'Three') ,
			'five' => Yii::t('app', 'Five') ,
)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div><!-- row -->
        <div class="row nm_row">
<label for="pages"><?php echo Yii::t('app', 'Pages'); ?></label>
<?php echo \CHtml::checkBoxList('Zero[pages]', array_map('Awecms::getPrimaryKey',$model->pages),
            CHtml::listData(Page::model()->findAll(),'id', 'title'),
            array('attributeitem' => 'id', 'checkAll' => 'Select All')); ?></div>

    <?php
        echo CHtml::submitButton(Yii::t('app', 'Save'));
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => 'javascript:history.go(-1)'));
$this->endWidget(); ?>
</div> <!-- form -->