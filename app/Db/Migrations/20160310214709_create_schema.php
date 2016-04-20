<?php

use Phinx\Migration\AbstractMigration;

class CreateSchema extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        /**
         * admin.
         */
        $table = $this->table('admin');
        $table->addColumn('email', 'string')
            ->addColumn('digest', 'string')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex(['email'], ['unique' => true])
            ->create();

        /**
         * log_grant.
         */
        $table = $this->table('log_grant');
        $table->addColumn('admin_id', 'integer')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->addForeignKey('admin_id', 'admin', 'id')
            ->create();

        /**
         * access_token.
         */
        $table = $this->table('access_token');
        $table->addColumn('access_token', 'string')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex(['access_token'], ['unique' => true])
            ->create();

        /**
         * country.
         */
        $table = $this->table('country');
        $table->addColumn('name', 'string')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex(['name'], ['unique' => true])
            ->create();

        /**
         * city.
         */
        $table = $this->table('city');
        $table->addColumn('name', 'string')
            ->addColumn('country_id', 'integer')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex(['name'], ['unique' => true])
            ->create();

        /**
         * centre.
         */
        $table = $this->table('centre');
        $table->addColumn('name', 'string')
            ->addColumn('city_id', 'integer')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->create();

        /**
         * log_grant_permitted_centre.
         */
        $table = $this->table('log_grant_permitted_centre', [
            'primary_key'   => ['log_grant_id', 'centre_id']
        ]);
        $table->addColumn('log_grant_id', 'integer')
            ->addColumn('centre_id', 'integer')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex(['log_grant_id', 'centre_id'], ['unique' => true])
            ->create();

        /**
         * access_token_grants_centre.
         */
        $table = $this->table('access_token_grants_centre', [
            'primary_key'   => ['access_token_id', 'centre_id']
        ]);
        $table->addColumn('access_token_id', 'integer')
            ->addColumn('centre_id', 'integer')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex(['access_token_id', 'centre_id'], ['unique' => true])
            ->create();

        /**
         * degree.
         */
        $table = $this->table('degree');
        $table->addColumn('name', 'string')
            ->addColumn('centre_id', 'integer')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->create();

        /**
         * student.
         */
        $table = $this->table('student');
        $table->addColumn('nif', 'string')
            ->addColumn('name', 'string')
            ->addColumn('surname', 'string')
            ->addColumn('email', 'string')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex(['nif'], ['unique' => true])
            ->addIndex(['email'], ['unique' => true])
            ->create();

        /**
         * recognizer.
         */
        $table = $this->table('recognizer');
        $table->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->create();

        /**
         * subject.
         */
        $table = $this->table('subject');
        $table->addColumn('name', 'string')
            ->addColumn('degree_id', 'integer')
            ->addColumn('recognizer_id', 'integer', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->create();

        /**
         * coordinator.
         */
        $table = $this->table('coordinator');
        $table->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->create();

        /**
         * coordinator_coord_centre.
         */
        $table = $this->table('coordinator_coord_centre', [
                'primary_key' => ['coordinator_id', 'centre_id']
            ]);
        $table->addColumn('coordinator_id', 'integer')
            ->addColumn('centre_id', 'integer')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex(['coordinator_id', 'centre_id'], ['unique' => true])
            ->create();

        /**
         * professor.
         */
        $table = $this->table('professor');
        $table->addColumn('name', 'string')
            ->addColumn('surname', 'string')
            ->addColumn('nif', 'string')
            ->addColumn('email', 'string')
            ->addColumn('coordinator_id', 'integer', ['null' => true])
            ->addColumn('recognizer_id', 'integer', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex(['email'], ['unique' => true])
            ->addIndex(['coordinator_id'], ['unique' => true])
            ->addIndex(['recognizer_id'], ['unique' => true])
            ->addIndex(['nif'], ['unique' => true])
            ->create();

        /**
         * request.
         */
        $table = $this->table('request');
        $table->addColumn('student_id', 'integer')
            ->addColumn('recognizer_id', 'integer', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->create();

        /**
         * student_enrolled_degree.
         */
        $table = $this->table('student_enrolled_degree', [
            'primary_key' => ['student_id', 'degree_id']
        ]);
        $table->addColumn('student_id', 'integer')
            ->addColumn('degree_id', 'integer')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex(['student_id', 'degree_id'], ['unique' => true])
            ->create();

        /**
         * subject_equivalent_subject.
         */
        $table = $this->table('subject_equivalent_subject', [
            'primary_key' => ['subject_id', 'subject_id_eq']
        ]);
        $table->addColumn('subject_id', 'integer')
            ->addColumn('subject_id_eq', 'integer')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex(['subject_id', 'subject_id_eq'], ['unique' => true])
            ->create();

        /**
         * equivalences.
         */
        $table = $this->table('equivalence', [
            'primary_key' => ['subject_id', 'subject_id_eq']
        ]);
        $table->addColumn('subject_id', 'integer')
            ->addColumn('subject_id_eq', 'integer')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex(['subject_id', 'subject_id_eq'], ['unique' => true])
            ->create();

        /**
         * login
         */
        $table = $this->table('login');
        $table->addColumn('role_id', 'integer')
            ->addColumn('admin_id', 'integer', ['null' => true])
            ->addColumn('student_id', 'integer', ['null' => true])
            ->addColumn('professor_id', 'integer', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->create();

        /**
         * role
         */
        $table = $this->table('role');
        $table->addColumn('name', 'string')
            ->addColumn('level', 'integer')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex(['name'], ['unique' => true])
            ->addIndex(['level'], ['unique' => true])
            ->create();

    }
}
