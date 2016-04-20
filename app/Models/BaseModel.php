<?php

namespace App\Models;

use App\Http\Response\DataInterface;
use App\Helpers\Strings\NameHelper;
use App\Exceptions\ResourceNotFoundException;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;

/**
 * Class BaseModel.
 */
class BaseModel extends Model implements DataInterface
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string (timestamp)
     */
    public $created_at;

    /**
     * @var string (datetime)
     */
    public $updated_at;

    public function initialize()
    {
        $this->addBehavior(
            new Timestampable(
                [
                    'beforeCreate' => [
                        'field'  => [
                            'created_at',
                            'updated_at',
                        ],
                        'format' => 'Y-m-d H:i:s'
                    ]
                ]
            )
        );
        $this->addBehavior(
            new Timestampable(
                [
                    'beforeUpdate' => [
                        'field'  => 'updated_at',
                        'format' => 'Y-m-d H:i:s'
                    ]
                ]
            )
        );
    }

    /**
     * Replace/translate default messages generated by the ORM.
     *
     * @return array
     */
    public function getMessages()
    {
        foreach (parent::getMessages() as $message) {
            switch ($message->getType()) {
                case 'PresenceOf':
                    $message->setMessage('The field ' . $message->getField() . ' is required');
                    break;
                case 'Uniqueness':
                    $message->setMessage('The field ' . $message->getField() . ' must be unique');
                    break;
                case 'Email':
                    $message->setMessage('The field ' . $message->getField() . ' must contain a valid email');
                    break;
                case 'Url':
                    $message->setMessage('The field ' . $message->getField() . ' must contain a valid url');
                    break;
                case 'InclusionIn':
                    $message->setMessage('The field ' . $message->getField() . ' must contain a value in [' . implode(',', $message->getDomain()) . ']');
                    break;
                case 'DateValidator':
                    $message->setMessage('The field ' . $message->getField() . ' must contain a valid date.');
                    break;
                case 'TimestampValidator':
                    $message->setMessage('The field ' . $message->getField() . ' must contain a valid timestamps.');
                    break;
            }
        }

        return parent::getMessages();
    }

    /**
     * FindFirst that throws an ResourceNotFound exception.
     *
     * @param null $parameters
     *
     * @throws ResourceNotFoundException
     *
     * @return Model
     */
    public static function findFirstOrFail($parameters = null)
    {
        $result = parent::findFirst($parameters);
        $class_name = NameHelper::namespaceToClassName(get_called_class());

        if (empty($result)) {
            throw new ResourceNotFoundException($class_name . ' not found');
        } else {
            return $result;
        }
    }

    /**
     * Return actual data to be hold by the response.
     *
     * @return \stdClass | array
     */
    public function getData()
    {
        return $this->toArray();
    }

    /**
     * Return pagination info if available.
     *
     * @return \stdClass | array
     */
    public function getPaginationInfo()
    {
        return;
    }
}
