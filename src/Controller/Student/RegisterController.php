<?php

declare(strict_types=1);

namespace App\Controller\Student;

use App\Controller\Traits\Stage\RegisterProcessTrait;
use Cake\View\CellTrait;

/**
 * Stages Controller
 *
 * @property \App\Model\Table\StudentStagesTable $StudentStages
 */
class RegisterController extends AppStudentController
{
    use RegisterProcessTrait;
    use CellTrait;

    public function initialize(): void
    {
        parent::initialize();
        $this->StudentStages = $this->fetchTable('StudentStages');
        $this->AppUsers = $this->fetchTable('AppUsers');
        $this->Students = $this->fetchTable('Students');
    }

    public function edit()
    {
        $currentStudent = $this->getCurrentStudent();

        [
            'success' => $success,
            'student' => $student
        ] = $this->processEdit($currentStudent->id, true);

        if ($success) {
            return $this->redirect(['_name' => 'student:home']);
        }

        $this->set(compact('student'));
    }
}
