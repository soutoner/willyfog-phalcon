<?php


/**
 * Inherited Methods.
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class FunctionalTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;

    /**
     * Redefined assert to accept array validation messages.
     *
     * @param $condition
     * @param null $message
     *
     * @return mixed
     */
    public function assertTrue($condition, $message = null)
    {
        if ($message !== null && is_array($message) && !empty($message)) {
            $message = print_r($message, true);
        }

        return $this->getScenario()->runStep(new \Codeception\Step\Action('assertTrue', [
            'condition' => $condition,
            'message'   => $message
        ]));
    }
}
