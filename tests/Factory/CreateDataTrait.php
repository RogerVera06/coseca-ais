<?php
declare(strict_types=1);

namespace App\Test\Factory;

use App\Model\Field\UserRole;
use Cake\Datasource\EntityInterface;
use Cake\I18n\FrozenDate;
use Cake\ORM\Locator\LocatorAwareTrait;

trait CreateDataTrait
{
    use LocatorAwareTrait;

    protected function createProgram(array $options = [], int $times = 1)
    {
        $option_lapses = $options['lapses'] ?? [];
        unset($options['lapses']);
        $lapses = LapseFactory::make($option_lapses, $option_lapses['times'] ?? 1);

        $option_tenants = $options['tenants'] ?? [];
        unset($options['tenants']);
        $tenants = TenantFactory::make($option_tenants, $option_tenants['times'] ?? 1)
            ->with('Lapses', $lapses);

        $option_interest_areas = $options['interest_areas'] ?? [];
        unset($options['interest_areas']);
        $interest_areas = InterestAreaFactory::make($option_interest_areas, $option_interest_areas['times'] ?? 6);

        return ProgramFactory::make($options ?? [], $times)
            ->with('Tenants', $tenants)
            ->with('InterestAreas', $interest_areas);
    }

    protected function createInstitution(array $options = [], bool $persist = true)
    {
        if (empty($options['tenant_id'])) {
            throw new \InvalidArgumentException('tenant_id is required');
        }

        // logic here

        return [
            'institution' => null,
            'institution_project' => null,
        ];
    }

    protected function createStudent(array $options = [], int $times = 1)
    {
        if (empty($options['tenant_id'])) {
            throw new \InvalidArgumentException('tenant_id is required');
        }

        if (empty($options['user_id'])) {
            throw new \InvalidArgumentException('user_id is required');
        }

        return StudentFactory::make($options ?? [], $times);
    }

    protected function createUser(array $options = [], int $times = 1)
    {
        return AppUserFactory::make($options ?? [], $times);
    }

    protected function setDefaultLapseDates(int $lapse_id)
    {
        return $this->fetchTable('LapseDates')->saveDefaultDates($lapse_id);
    }

    protected function getRecord(string $repository, int $id): EntityInterface
    {
        return $this->fetchTable($repository)->get($id);
    }

    protected function getRecordByOptions(string $repository, array $options): EntityInterface
    {
        return $this->fetchTable($repository)->find()->where($options)->firstOrFail();
    }

    protected function loadInto($entities, array $contain)
    {
        if (is_array($entities)) {
            $table = $this->fetchTable($entities[0]->getSource());
        } else {
            $table = $this->fetchTable($entities->getSource());
        }

        return $table->loadInto($entities, $contain);
    }

    protected function addRecord(string $repository, array $data = []): EntityInterface
    {
        $table = $this->fetchTable($repository);
        $entity = $table->newEntity($data);

        return $table->saveOrFail($entity);
    }

    protected function updateRecord(EntityInterface $entity, array $data = []): EntityInterface
    {
        $table = $this->fetchTable($entity->getSource());
        $entity = $table->patchEntity($entity, $data);

        return $table->saveOrFail($entity);
    }

    protected function deleteRecord(EntityInterface $entity)
    {
        $table = $this->fetchTable($entity->getSource());

        return $table->deleteOrFail($entity);
    }

    protected function getRecordExists(string $repository, $id): bool
    {
        return $this->fetchTable($repository)->exists(['id' => $id]);
    }

    protected function createUserWithAdminRole()
    {
        return $this->createUser(['role' => UserRole::ADMIN->value])->persist();
    }

    protected function createUserWithUserRole()
    {
        return AppUserFactory::make(['role' => UserRole::STUDENT->value])
            ->with('Students', ['tenant_id' => $this->tenant_id])
            ->persist();
    }

    // Enviar datos a una url tipo post
    protected function sendDataForm(string $url, $id, array $data = [])
    {
        return $this->post((string)$url. $id, $data);
    }

    public function getLapsesDatesStatus($lapses_date)
    {
        $lapseDateModifed = $this->getRecord('LapseDates', $lapses_date->id);
        /** @var \App\Model\Entity\LapseDates  $lapseDateModifed */
        return $lapseDateModifed->getStatus();
    }
}
