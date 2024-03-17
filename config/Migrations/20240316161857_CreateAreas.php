<?php
declare(strict_types=1);

use App\Traits\CommonMigrationsTrait;
use Migrations\AbstractMigration;

class CreateAreas extends AbstractMigration
{
    use CommonMigrationsTrait;

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('areas');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('abbr', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('logo', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table = $this->setAuditFields($table);
        $table->create();

        $table = $this->table('programs');
        $table->addColumn('area_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table = $this->setAuditFields($table);
        $table->update();
    }
}
