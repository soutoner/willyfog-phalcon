<?php

namespace App\Helpers\Strings;

class NameHelper
{
    /**
     * Extracts class name even with namespace.
     *
     * @param $namespace : Full path to class with namespace
     * @param null   $remove     : Word to be removed from the class name
     * @param string $substitute
     *
     * @return string
     */
    public static function namespaceToClassName($namespace, $remove = null, $substitute = '')
    {
        $full_class = explode('\\', $namespace);
        $class_name = end($full_class);

        if ($remove !== null) {
            $class_name = str_replace($remove, $substitute, $class_name);
        }

        return $class_name;
    }

    /**
     * Converts class name into table name.
     *
     * @param string $class_name
     * @param string $remove     : String that must be removed from class name
     *
     * @return string
     */
    public static function tableNameFromClassName($class_name, $remove = null)
    {
        $class_name = self::namespaceToClassName($class_name);

        if ($remove !== null) {
            return strtolower(str_replace($remove, '', $class_name));
        } else {
            return strtolower($class_name);
        }
    }

    /**
     * Return full path to a Model class from a Seeder class.
     *
     * @param $seeder
     *
     * @return string
     */
    public static function seederToModel($seeder)
    {
        return 'App\\' . str_replace('Seeder', '', implode('\\', array_slice(explode('\\', $seeder), 3)));
    }

    /**
     * Returns version from path to class.
     *
     * TODO: handle errors.
     *
     * @param $class_name
     *
     * @return string
     */
    public static function versionFromClassName($class_name)
    {
        preg_match('/V[0-9]/', $class_name, $match);

        return $match[0];
    }
}
