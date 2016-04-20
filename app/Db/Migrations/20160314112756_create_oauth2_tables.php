<?php

use Phinx\Migration\AbstractMigration;

class CreateOauth2Tables extends AbstractMigration
{
    public function change()
    {
        /**
         * oauth_clients.
         */
        $table = $this->table('oauth_clients', [
            'primary_key'   => ['client_id']
        ]);
        $table->addColumn('client_id', 'string')
            ->addColumn('client_secret', 'string', ['null' => true])
            ->addColumn('redirect_uri', 'string')
            ->addColumn('grant_types', 'string', ['null' => true])
            ->addColumn('scope', 'string', ['null' => true])
            ->addColumn('user_id', 'string', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->create();

        /**
         * oauth_access_tokens.
         */
        $table = $this->table('oauth_access_tokens', [
            'primary_key'   => ['access_token']
        ]);
        $table->addColumn('access_token', 'string')
            ->addColumn('client_id', 'string')
            ->addColumn('user_id', 'string', ['null' => true])
            ->addColumn('expires', 'timestamp')
            ->addColumn('scope', 'string', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->create();

        /**
         * oauth_authorization_codes.
         */
        $table = $this->table('oauth_authorization_codes', [
            'primary_key'   => ['authorization_code']
        ]);
        $table->addColumn('authorization_code', 'string')
            ->addColumn('client_id', 'string')
            ->addColumn('user_id', 'string', ['null' => true])
            ->addColumn('redirect_uri', 'string', ['null' => true])
            ->addColumn('expires', 'timestamp')
            ->addColumn('scope', 'string', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->create();

        /**
         * oauth_refresh_tokens.
         */
        $table = $this->table('oauth_refresh_tokens', [
            'primary_key'   => ['refresh_token']
        ]);
        $table->addColumn('refresh_token', 'string')
            ->addColumn('client_id', 'string')
            ->addColumn('user_id', 'string', ['null' => true])
            ->addColumn('expires', 'timestamp')
            ->addColumn('scope', 'string', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->create();

        /**
         * oauth_users.
         */
        $table = $this->table('oauth_users', [
            'primary_key'   => ['username']
        ]);
        $table->addColumn('username', 'string')
            ->addColumn('password', 'string', ['null' => true])
            ->addColumn('first_name', 'string', ['null' => true])
            ->addColumn('last_name', 'string', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->create();

        /**
         * oauth_scopes.
         */
        $table = $this->table('oauth_scopes');
        $table->addColumn('scope', 'text', ['null' => true])
            ->addColumn('is_default', 'boolean', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->create();

        /**
         * oauth_jwt.
         */
        $table = $this->table('oauth_jwt', [
            'primary_key'   => ['client_id']
        ]);
        $table->addColumn('client_id', 'string')
            ->addColumn('subject', 'string', ['null' => true])
            ->addColumn('public_key', 'string', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', [
                'default'   => 'CURRENT_TIMESTAMP',
                'update'    => 'CURRENT_TIMESTAMP'
            ])
            ->create();
    }
}
