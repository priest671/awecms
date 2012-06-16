<?php
$this->breadcrumbs = array(
    UserModule::t('Users') => array('index'),
    $model->username,
);
$this->menu = array(
    array('label' => UserModule::t('List Users'), 'url' => array('/user')),
    array('label' => UserModule::t('Manage Users'), 'url' => array('/user/admin')),
    array('label' => UserModule::t('Create User'), 'url' => array('/user/admin/create')),
    array('label' => UserModule::t('Manage Profile Fields'), 'url' => array('/user/profileField')),
    array('label' => UserModule::t('Create Profile Field'), 'url' => array('/user/profileField/create')),
);
?>
<h1><?php echo UserModule::t('View User') . ' "' . $model->username . '"'; ?></h1>
<?php
// For all users
$attributes = array(
    'username',
);

$profileFields = ProfileField::model()->forAll()->sort()->findAll();
if ($profileFields) {
    foreach ($profileFields as $field) {
        array_push($attributes, array(
            'label' => UserModule::t($field->title),
            'name' => $field->varname,
            'value' => (($field->widgetView($model->profile)) ? $field->widgetView($model->profile) : (($field->range) ? Profile::range($field->range, $model->profile->getAttribute($field->varname)) : $model->profile->getAttribute($field->varname))),
        ));
    }
}
array_push($attributes, 'create_at', array(
    'name' => 'lastvisit_at',
    'value' => (($model->lastvisit_at != '0000-00-00 00:00:00') ? $model->lastvisit_at : UserModule::t('Not visited')),
        )
);

$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => $attributes,
));
?>
