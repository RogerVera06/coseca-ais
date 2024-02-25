<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class AddAuditoryFieldsToTutors extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('tutors');
        $table->addColumn('created', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ]);
        $table->addColumn('created_by', 'uuid', [
            'null' => true,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ]);
        $table->addColumn('modified_by', 'uuid', [
            'null' => true,
        ]);
        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('deleted_by', 'uuid', [
            'null' => true,
        ]);
        $table->update();
    }
}