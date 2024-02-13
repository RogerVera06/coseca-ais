<?php

/**
 * @var \App\View\AppView $this
 */

$this->active = 'tracking';
$this->extend('/Admin/Common/view_student');

$this->assign('title', __('Estudiante'));
$this->Breadcrumbs->add([
    ['title' => __('Inicio'), 'url' => '/'],
    ['title' => __('Estudiantes'), 'url' => ['controller' => 'Students', 'action' => 'index']],
    ['title' => __('Ver'), 'url' => ['controller' => 'Students', 'action' => 'view', $student->id]],
    ['title' => __('Seguimiento')],
]);

?>

<div class="card-body"><?= $trackingView->render() ?></div>