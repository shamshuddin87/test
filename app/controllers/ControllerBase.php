<?php
use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;
class ControllerBase extends Controller
{

    protected function initialize()
    {

        //$this->tag->prependTitle('Phoenix Peth | ');
        $this->view->setTemplateAfter('main');
        $this->validationcommon->initminifiedjscript();
        //$this->initminifiedcsscript();
        
        $getlan    = $this->elements->getTranslation();
        $this->view->breadcrumtitle = $getlan['breadcrumtitle'];
        $this->view->breadcrumaction = $getlan['breadcrumaction'];
        //echo '<pre>'; print_r($t['breadcrumtitle']); exit;
        
        
        
            
        //$myfile = fopen("testfile.txt", "w")
    }

    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
        return $this->dispatcher->forward(
            array(
                'controller' => $uriParts[0],
                'action' => $uriParts[1],
                'params' => $params
            )
        );
    }
    
    
    public function initminifiedcsscript()
    {
        /*$timestampfile = time();
        $this->assets->collection('commoncss')
        ->addCss('css/deool/materialize.css')
        ->addCss('css/deool/font-awesome.min.css')
        ->addCss('css/deool/custom-style.css')
        ->addCss('css/deool/scrollbarhidden.css')
        ->addCss('css/deool/style.css')
        ->join(true)
        ->setTargetPath('css/minified/phoenixpeth.css')
        ->setTargetUri('css/minified/phoenixpeth.css?var='.$timestampfile)
        ->addFilter(new Phalcon\Assets\Filters\Cssmin());*/


    }
}
