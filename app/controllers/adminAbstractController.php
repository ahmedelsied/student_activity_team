<?php
namespace controllers;
use lib\frontController;
use models\catgModel;
use models\artcModel;
use models\subsModel;
use models\talentModel;
class adminAbstractController
{
    public $catgs;
    public $activeCatg;
    protected $linkStyle;
    protected $script;
    protected $title;
    protected $mainURL;
    public function __construct()
    {
        $this->mainURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
    }
    protected function loadHeader()
    {
        $this->loadTemp('admin/templateHeader');
    }
    protected function artcModel()
    {
        $artcModel = new artcModel();
        return $artcModel;
    }
    protected function catgModel()
    {
        $catgModel = new catgModel();
        return $catgModel;
    }
    protected function subsModel()
    {
        $subsModel = new subsModel();
        return $subsModel;
    }
    protected function talentModel()
    {
        $talentModel = new talentModel();
        return $talentModel;
    }
    protected function renderNav()
    {
        $this->loadTemp('admin/nav');
    }
    protected function loadFooter()
    {
        echo '<script>document.title = "'.$this->title.'"</script>';
        $this->loadTemp('admin/appFooter');
        $this->loadTemp('admin/templateFooter');
    }
    public function _view($view)
    {
        require_once APP_PATH.'views'. DS . 'admin' . DS . $view . '.php';
    }
    public function loadTemp($temp)
    {
        require_once TEMPENG . DS . $temp.'.php';
    }
    public function setParams($params,$count)
    {
        if(count($params) != $count){
            return false;
        }else{
            return true;
        }
    }
    public function invalidparamsAction()
    {
        echo 'Invalid Params';
    }
}