<?php
declare(strict_types=1);

namespace App\Controller\Student;

use App\Controller\AppController;

/**
 * Stages Controller
 *
 * @property \App\Model\Table\StagesTable $Stages
 * @method \App\Model\Entity\Stage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $stages = $this->paginate($this->Stages);

        $this->set(compact('stages'));
    }
}
