<?php
$this->breadcrumbs['Tests'] = array('index');$this->breadcrumbs[] = $model->name;if(!isset($this->menu) || $this->menu === array()) {
$this->menu=array(
	array('label'=>Yii::t('app', 'Update') , 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Delete') , 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') , 'url'=>array('admin')),
	/*array('label'=>Yii::t('app', 'List') , 'url'=>array('index')),*/
);
}
?>

<h1><?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
array(
                        'name'=>'id', // only admin user can see person id
                        'label'=>'ID',
                        'visible'=>Yii::app()->getModule('user')->isAdmin()
                    ),'name','birthdate','birthtime',array(
                        'name'=>'enabled',
                        'type'=>'boolean'
                    ),'status','slogan',array(
                        'name'=>'content',
                        'type'=>'ntext'
                    ),'created_at','changed_at','modified_at',array(
                        'name'=>'image',
                        'type'=>'image'
                    ),array(
                        'name'=>'email',
                        'type'=>'email'
                    ),array(
                        'name'=>'uri',
                        'type'=>'url'
                    ),)));