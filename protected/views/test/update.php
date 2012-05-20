<?php
$this->breadcrumbs['Tests'] = array('index');
$this->breadcrumbs[$model->name] = array('view','id'=>$model->id);
$this->breadcrumbs[] = Yii::t('app', 'Update');

if(!isset($this->menu) || $this->menu === array())
$this->menu=array(
	array('label'=>Yii::t('app', 'Delete') , 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
	//array('label'=>Yii::t('app', 'Manage') , 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('app', 'Update');?> <?php echo $model->name; ?> </h1>
<?php
$this->renderPartial('_form', array(
			'model'=>$model));
?>