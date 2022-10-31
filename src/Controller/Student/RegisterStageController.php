<?php
declare(strict_types=1);

namespace App\Controller\Student;

use App\Model\Field\Stages;
use App\Stage\StageFactory;
use Cake\Cache\Cache;

/**
 * RegisterStage Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 * @property \App\Stage\StageInterface $Stage
 */
class RegisterStageController extends AppStudentController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Students = $this->fetchTable('Students');
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $current_student_id = $this->getCurrentStudent()->id;
        $registerStage = StageFactory::getInstance(Stages::STAGE_REGISTER, $current_student_id);
        $studentStage = $registerStage->getStudentStage(true);

        if ($studentStage->status !== Stages::STATUS_IN_PROGRESS) {
            $this->Flash->warning(__('El Registro no esta activo para realizar cambios'));
            return $this->redirect(['_name' => 'student:home']);
        }
     
        $student = $registerStage->getStudent(true);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->getData());

            if ($this->Students->save($student)) {
                $registerStage->close(Stages::STATUS_SUCCESS);
                $this->Flash->success(__('The student has been saved.'));

                return $this->redirect(['_name' => 'student:home']);
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }

        $this->set(compact('student'));
    }
}
