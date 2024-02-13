<?php

/**
 * @var \App\View\AppView $this
 */

use App\Enum\ActionColor;
use App\Model\Field\StageStatus;

$this->student_id = $studentStage->student_id;
$this->active = null;
$this->extend('/Admin/Common/view_student');

$this->assign('title', __('Estudiante'));
$this->Breadcrumbs->add([
    ['title' => __('Inicio'), 'url' => '/'],
    ['title' => __('Estudiantes'), 'url' => ['controller' => 'Students', 'action' => 'index']],
    ['title' => __('Ver'), 'url' => ['controller' => 'Students', 'action' => 'view', $studentStage->student_id]],
    ['title' => $studentStage->stage_label],
    ['title' => __('Editar')],
]);
?>

<?= $this->Form->create($studentStage) ?>
<div class="card-header">
    <div class="card-title"><?= __('Editar  {0}', $studentStage->stage_label) ?></div>
</div>
<div class="card-body">
    <?= $this->Form->control('status', ['options' => StageStatus::toListLabel()]) ?>
    <ul>
        <li><strong>Pendiente: </strong>description</li>
        <li><strong>En Espera: </strong>description</li>
        <li><strong>En Proceso: </strong>description</li>
        <li><strong>Realizado: </strong>description</li>
        <li><strong>Fallido: </strong>description</li>
        <li><strong>Bloqueado: </strong>description</li>
    </ul>
</div>
<div class="card-footer d-flex">
    <div>
        <?= $this->Button->save([
            'confirm' => __('Esta seguro que desea cambiar el estado? Esto podria traer resultados inesperados.')
        ]) ?>
        <?= $this->Button->confirm([
            'label' => __('Forzar cierre'),
            'url' => ['controller' => 'StudentStages', 'action' => 'forcedClose', $studentStage->id],
            'confirm' => __('Esta seguro que desea cerrar esta etapa? Esto podria traer resultados inesperados.'),
            'actionColor' => ActionColor::SPECIAL,
        ]) ?>
    </div>
    <div class="ml-auto">
        <?= $this->Html->link(__('Cancelar'), ['controller' => 'Students', 'action' => 'view', $studentStage->student_id], ['class' => ActionColor::CANCEL->btn()]) ?>
    </div>
</div>
<?= $this->Form->end() ?>