<table>
    <tr>
        <th>
            _____________________
        </th>
        <th>
            _____________________
        </th>
        <th>
            _____________________
        </th>
    </tr>
    <tr>
        <th>
            <?= __('Tutor Académico') ?>
        </th>
        <th>
            <?= __('Tutor Comunitario') ?>
        </th>
        <th>
            <?= __('Estudiante') ?>
        </th>
    </tr>

    <tr>
        <td colspan="3" class="text-right">
            <?= __('CV:{0}', $validationToken ?? $this->App->nan()) ?>
        </td>
    </tr>
</table>