<?php

namespace App\ViewModels;

class ActionResultViewModel
{
    public bool $auth;
    public string $lastAction;
    public bool $status;
    public string $mainMessage;
    public array $actionsToDo;
    public string $messageToContinue;
    public string $linkToContinue;

    /**
     * @param bool $auth
     * @param string $lastAction
     * @param bool $status
     * @param string $mainMessage
     * @param array $actionsToDo
     * @param string $messageToContinue
     * @param string $linkToContinue
     */
    public function __construct(
        bool $auth,
        string $lastAction,
        bool $status,
        string $mainMessage,
        array $actionsToDo,
        string $messageToContinue,
        string $linkToContinue
    ) {
        $this->auth = $auth;
        $this->lastAction = $lastAction;
        $this->status = $status;
        $this->mainMessage = $mainMessage;
        $this->actionsToDo = $actionsToDo;
        $this->messageToContinue = $messageToContinue;
        $this->linkToContinue = $linkToContinue;
    }


}
