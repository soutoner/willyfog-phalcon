<?php

namespace App\Db\Seeds\Models;

use App\Helpers\Strings\NameHelper;

abstract class BaseSeeder
{
    /**
     * Number of Faker seeds that will be inserted.
     *
     * @var int
     */
    protected static $n_fake_seeds = 10;

    /**
     * Define specific seeds that are inserted in database here.
     *
     * @var array
     */
    protected static $db_seeds = [];

    /**
     * Define seeds that are not inserted in database here.
     *
     * @var array
     */
    protected static $extra_seeds = [];

    /**
     * Populates the database.
     *
     * @param bool                            $want_fake : Whether to create fake seeds or not.
     * @param Logger|\App\Lib\Logs\HTMLLogger $logger    : Logger to outline the seeding process
     */
    public static function Seed($want_fake = true, \App\Lib\Logs\HTMLLogger $logger = null)
    {
        if (null !== $logger) {
            $logger->info('Executing ' . get_called_class());
        }
        $class = NameHelper::seederToModel(get_called_class());
        if (null !== $logger) {
            $logger->info('----> Seeding db seeds:');
        }
        foreach (static::$db_seeds as $params) {
            $seed = new $class();
            $success = $seed->create($params);
            if (null !== $logger && !$success) {
                $logger->error('!!! Seeded failed: ');
                $logger->pre($seed->getMessages());
                $logger->pre($params);
            }
        }
        if (null !== $logger) {
            $logger->info('----> Db seeds finished');
        }

        if ($want_fake) {
            if (null !== $logger) {
                $logger->info('----> Seeding faker seeds:');
            }
            $faker = \Faker\Factory::create();
            for ($i = 0; $i < static::$n_fake_seeds; $i++) {
                $seed = new $class();
                $params = static::GenerateFake($faker);
                $success = $seed->create($params);
                if (null !== $logger && !$success) {
                    $logger->error('!!! Seeded failed: ');
                    $logger->pre($seed->getMessages());
                    $logger->pre($params);
                }
            }
            if (null !== $logger) {
                $logger->info('----> Fake seeds finished');
            }
        }
        if (null !== $logger) {
            $logger->hr();
        }
    }

    /**
     * Generate fake parameters.
     *
     * @param \Faker\Generator $faker
     *
     * @return
     */
    abstract public static function GenerateFake(\Faker\Generator $faker);

    /**
     * Returns seeds params that are saves in database.
     *
     * @param null $index  : Seed index
     * @param bool $object : Whether to convert array into object
     *
     * @return array
     */
    public static function DbSeeds($index = null, $object = false)
    {
        if ($index !== null) {
            if ($object) {
                return (object) static::$db_seeds[$index];
            } else {
                return static::$db_seeds[$index];
            }
        } else {
            return static::$db_seeds;
        }
    }

    /**
     * Returns seeds params that are not saved in the database.
     *
     * @param null $index  : Seed index
     * @param bool $object : Whether to convert array into object
     *
     * @return array
     */
    public static function ExtraSeeds($index = null, $object = false)
    {
        if ($index !== null) {
            if ($object) {
                return (object) static::$extra_seeds[$index];
            } else {
                return static::$extra_seeds[$index];
            }
        } else {
            return static::$extra_seeds;
        }
    }
}
