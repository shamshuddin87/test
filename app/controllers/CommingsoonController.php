<?php

class CommingsoonController extends ControllerBase
{
    public function initialize()
    {
        $getlan    = $this->elements->getTranslation();
        
        $this->tag->setTitle($getlan['websitetitle']);
        parent::initialize();
    }

    public function indexAction()
    {
        
    }

}
