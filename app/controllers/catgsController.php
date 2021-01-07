<?php
namespace controllers;
use lib\inputfilter;
class catgsController extends abstractController
{
    use inputfilter;
    public $article;
    public function defaultAction($params)
    {
        $parmValid = $this->setParams($params,1);
        if($parmValid === true && $this->filterInt($params[0]) == true){
            $catgs = $this->catgModel();
            if($catgs->checkIfExist($params[0])){
                $this->activeCatg = $params[0];
                $this->loadHeader();
                $this->renderNav();
                $this->article = $catgs->getJOIN('articles','*','articles.cat_id',$params[0]);
                $this->_view('catgs'.DS.'defaultView');
                $this->loadFooter();
            }else{
                echo 'not exist';
            }
        }else{
            $this->invalidparamsAction();
        }
    }
}