<?php
/**
 * @var \App\View\AppView $this
 * @var array $reports
 */
?>

<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title"><?= __('Cantidad de estudiantes por Etapa / Estatus') ?></h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th><?= __('Etapa / Estatus') ?></th>
                    <?php foreach ($statuses as $status) : ?>
                        <th class="text-center"><?= $this->App->badge($status) ?></th>
                    <?php endforeach; ?>
                    <th class="text-center"><?= $this->Html->tag('span', __('Total'), ['class' => 'badge badge-dark']) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stages as $stage) : ?>
                    <tr>
                        <td class="text-bold"><?= $stage->label() ?></td>
                        <?php $sum = 0 ?>
                        <?php foreach ($statuses as $status) : ?>
                            <td class="text-center"><?= $reports[$stage->value][$status->value] ?? 0 ?></td>
                            <?php $sum += $reports[$stage->value][$status->value] ?? 0 ?>
                        <?php endforeach; ?>
                        <td class="text-center"><?= $sum ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>