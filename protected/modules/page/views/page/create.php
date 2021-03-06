<?php
$this->breadcrumbs = array(
    Yii::t('app', 'Pages') => array('/page'),
    Yii::t('app', 'Create'),
);
if (!isset($this->menu) || $this->menu === array())
    $this->menu = array(
        array('label' => Yii::t('app', 'All Pages'), 'url' => array('/page')),
        array('label' => Yii::t('app', 'Create New Page')),
        array('label' => Yii::t('app', 'Manage Pages'), 'url' => array('/page/page/manage')),
        array('label' => Yii::t('app', 'All Contents'), 'url' => array('/page/page/content')),
    );
?>

<h1> Create New Page </h1>
<?php
$this->renderPartial('_form', array(
    'page' => $page,
    'buttons' => 'create'));
?>