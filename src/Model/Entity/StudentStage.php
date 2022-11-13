<?php
declare(strict_types=1);

namespace App\Model\Entity;

use App\Model\Field\Stages;
use App\Stage\StageFactory;
use App\Stage\StageInterface;
use Cake\ORM\Entity;

/**
 * StudentStage Entity
 *
 * @property int $id
 * @property int $student_id
 * @property string $stage
 * @property int $lapse_id
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Lapse $lapse
 */
class StudentStage extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'student_id' => true,
        'stage' => true,
        'lapse_id' => true,
        'status' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
        'student' => true,
        'lapse' => true,
    ];

    /**
     * @param string|null $stage
     * @return StageInterface
     */
    public function getStageInstance(): StageInterface
    {
        return StageFactory::getInstance($this);
    }

    protected $_virtual = [
        'stage_label',
    ];

    protected function _getStageLagel()
    {

        debug(Stages::getStageInfo($this->stage));
        exit();

        return Stages::getStageInfo($this->stage)[Stages::DATA_LABEL];
    }

}
