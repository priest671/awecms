<?php

$label = $this->pluralize($this->class2name($this->modelClass));
echo "<?php\n";
echo "\$this->breadcrumbs = array(
    Yii::t('app', '$label') => array('index'),
    Yii::t('app', \$model->{$this->getIdentificationColumn()}),
);";
?>
if(!isset($this->menu) || $this->menu === array()) {
$this->menu=array(
	array('label'=>Yii::t('app', 'Update') , 'url'=>array('update', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>Yii::t('app', 'Delete') , 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') , 'url'=>array('admin')),
	/*array('label'=>Yii::t('app', 'List') , 'url'=>array('index')),*/
);
}
?>

<h1><?php echo "<?php echo \$model->{$this->getIdentificationColumn()}; ?>"; ?></h1>

<?php echo '<?php'; ?> $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
<?php
foreach ($this->tableSchema->columns as $column){
    if ($column->isForeignKey) {
    echo "\t\tarray(\n";
			echo "\t\t\t'name'=>'{$column->name}',\n";
			foreach ($this->relations as $key => $relation) {
			if ((($relation[0] == "CHasOneRelation") || ($relation[0] == "CBelongsToRelation")) && $relation[2] == $column->name) {
			$relatedModel = CActiveRecord::model($relation[1]);
                        $identificationColumn = AweCrudCode::getIdentificationColumnFromTableSchema($relatedModel->tableSchema);
			$controller = $this->resolveController($relation);
			$value = "(\$model->{$key} !== null)?";
			$value .= "CHtml::link(\$model->{$key}->$identificationColumn, array('{$controller}/view','{$relatedModel->tableSchema->primaryKey}'=>\$model->{$key}->{$relatedModel->tableSchema->primaryKey})).' '";
			//$value .= ".CHtml::link(Yii::t('app','Update'), array('{$controller}/update','{$relatedModel->tableSchema->primaryKey}'=>\$model->{$key}->{$relatedModel->tableSchema->primaryKey}), array('class'=>'edit'))";
			$value .= ":'n/a'";
			
			echo "\t\t\t'value'=>{$value},\n";
			echo "\t\t\t'type'=>'html',\n";
			}
			}
			echo "\t\t),\n";
    }
    else
        echo $this->getDetailViewAttribute($column);    
}
echo ")));";

echo "?>";
        
	
	foreach (CActiveRecord::model(Yii::import($this->model))->relations() as $key => $relation) {
		
		$controller = $this->resolveController($relation);
		$relatedModel = CActiveRecord::model($relation[1]);
		$pk = $relatedModel->tableSchema->primaryKey;
		
		if ($relation[0] == 'CManyManyRelation' || $relation[0] == 'CHasManyRelation') {
			#$model = CActiveRecord::model($relation[1]);
			#if (!$pk = $model->tableSchema->primaryKey)
			#	$pk = 'id';

			#$suggestedtitle = $this->suggestName($model->tableSchema->columns);
                        $relatedModel = CActiveRecord::model($relation[1]);
                        $identificationColumn = AweCrudCode::getIdentificationColumnFromTableSchema($relatedModel->tableSchema);
			echo '<h2>';
			echo "<?php echo CHtml::link(Yii::t('app','" . ucfirst($key) . "'), array('".$controller."'));?>";
			echo "</h2>\n";
			echo CHtml::openTag('ul');
			echo "
			<?php if (is_array(\$model->{$key})) foreach(\$model->{$key} as \$foreignobj) { \n
					echo '<li>';
					echo CHtml::link(\$foreignobj->{$identificationColumn}, array('{$controller}/view','{$pk}'=>\$foreignobj->{$pk}));\n							
					}
						?>";
			echo CHtml::closeTag('ul');

		}
		if ($relation[0] == 'CHasOneRelation') {
			$relatedModel = CActiveRecord::model($relation[1]);
                        $identificationColumn = AweCrudCode::getIdentificationColumnFromTableSchema($relatedModel->tableSchema);
			if (!$pk = $relatedModel->tableSchema->primaryKey)
				$pk = 'id';
			
			#$suggestedtitle = $this->suggestName($model->tableSchema->columns);
			echo '<h2>';
			echo "<?php echo CHtml::link(Yii::t('app','".$relation[1]."'), array('".$controller."'));?>";
			echo "</h2>\n";
			echo CHtml::openTag('ul');
			echo "<?php \$foreignobj = \$model->{$key}; \n
					if (\$foreignobj !== null) {
					echo '<li>';
					echo '#'.\$model->{$key}->{$pk}.' ';
					echo CHtml::link(\$model->{$key}->{$identificationColumn}, array('{$controller}/view','{$pk}'=>\$model->{$key}->{$pk}));\n							
					}
					?>";
			echo CHtml::closeTag('ul');

		}
	}
?>