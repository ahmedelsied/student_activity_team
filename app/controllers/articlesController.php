<?php
namespace controllers;
use lib\inputfilter;
class articlesController extends abstractController
{
    use inputfilter;
    public $artcs;
    public function defaultAction($params)
    {
        $parmValid = $this->setParams($params,0);
        if($parmValid === true){
            $this->title = 'جميع النشاطات';
            $artcModel = $this->artcModel();
            $this->artcs = $artcModel->getAll();
            $this->loadHeader();
            $this->renderNav();
            $this->_view('articles'.DS.'defaultView');
            $this->loadFooter();
        }    
    }
    public function readAction($params)
    {
        $parmValid = $this->setParams($params,1);
        if($parmValid === true && $this->filterInt($params[0]) == true){
            $artcModel = $this->artcModel();
            if($artcModel->checkIfExist($params[0])){
                $this->artcs = $artcModel->getOneRec($params[0]);  
                $this->title = $this->artcs['title'];
                $this->loadHeader();
                $this->renderNav();
                $this->_view('articles'.DS.'readView');
                $this->loadFooter();
            }else{
                echo 'not Exist';
            }
        }else{
            $this->invalidparamsAction();
        }
    }
}