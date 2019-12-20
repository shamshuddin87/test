<?php

class ErrorsController extends ControllerBase
{
    public function initialize()
    {
        $getlan    = $this->elements->getTranslation();
        
        $this->tag->setTitle($getlan['websitetitle']);
        parent::initialize();
    }

    public function show404Action()
    {
        
    }

    public function show401Action()
    {

    }

    public function show500Action()
    {

    }
}
