<?php

declare(strict_types=1);

namespace App\Controller\Traits;

use Cake\ORM\Locator\LocatorAwareTrait;

trait DocumentsTrait
{
    use LocatorAwareTrait;

    public function initialize(): void
    {
        parent::initialize();
    }

    public function format007($adscription_id = null)
    {
        $this->StudentAdscriptions = $this->fetchTable('StudentAdscriptions');

        $adscription = $this->StudentAdscriptions->find()
            ->find('withInstitution')
            ->find('withTracking')
            ->find('withStudents')
            ->find('withTutor')
            ->where(['StudentAdscriptions.id' => $adscription_id])
            ->firstOrFail();

        $this->viewBuilder()->setClassName('CakePdf.Pdf');

        $trackingInfo = $this->StudentAdscriptions->Students->getStudentTrackingInfoByAdscription([$adscription->id]);
        $validationToken = $this->StudentAdscriptions->createValidationToken($adscription->id);

        $this->set(compact('adscription', 'trackingInfo', 'validationToken'));
        $this->render('/Documents/format007');
    }
}
