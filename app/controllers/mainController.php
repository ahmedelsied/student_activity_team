<?php
namespace controllers;
use lib\helper;
use lib\validate;
use lib\inputFilter;
class mainController extends abstractController
{
    use helper,inputFilter,validate;
    public $artcs;
    public function defaultAction($params)
    {
        $parmValid = $this->setParams($params,0);
        if($parmValid === true){
            $this->title = 'الرئيسيه';
            $artc = $this->artcModel();
            $this->artcs = $artc->getLimit(3);
            $this->loadHeader();
            $this->renderNav();
            $this->_view('index'.DS.'defaultView');
            $this->loadFooter();
        }else{
            $this->invalidparamsAction();
        }
    }
    public function subscribersAction()
    {
        $Href = [$this->mainURL,$this->mainURL.'main',$this->mainURL.'main/default'];
        if($_SERVER['REQUEST_METHOD'] == 'POST' &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' &&
        isset($_POST['email']) &&
        in_array($_SERVER['HTTP_REFERER'],$Href)){
            $this->_newsubscriber();
        }else{
            $this->redirect('../');
        }
    }
    public function participantsAction()
    {
        $Href = [$this->mainURL,$this->mainURL.'main',$this->mainURL.'main/default'];
        if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['HTTP_X_REQUESTED_WITH'] &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' &&
        (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['talent'])) &&
        in_array($_SERVER['HTTP_REFERER'],$Href)
        ){
            $this->_newparticipants();
        }else{
            $this->redirect('../');
        }
    }
    private function _newparticipants()
    {
        
        $name = $this->filterString($_POST['name']);
        $phone = $this->filterInt($_POST['phone']);
        $talentStr = $this->filterString($_POST['talent']);
        if($this->inputStringValidate($name,1,18) && $this->inputStringValidate($talentStr,4,20)){
            $talent = $this->talentModel();
            if($talent->checkIfExist($phone) == 0){
                $talent::$tableSchema['name'] = $name;
                $talent::$tableSchema['phone'] = $phone;
                $talent::$tableSchema['cat_type'] = $talentStr;
                $talent->insertRec();
                $msg = ['لقد تلقينا طلبك وسنتواصل معك في أقرب وقت!','success'];
            }else{
                $msg = ['هذا الرقم موجود من قبل','success'];
            }
        }else{
            $msg = ['يرجى ادخال البيانات بشكل صحيح','danger'];
        }
        echo '<div class="suc-msg alert alert-'.$msg[1].'">'.$msg[0].'</div>';
    }
    private function _newsubscriber()
    {
        
        $email = $_POST['email'];
        $filteredEmail = $this->filterEmail($email);
        $msg = $this->emailValidate($filteredEmail);
        if($msg[1] == 'success'){
            $subsModel = $this->subsModel();
            $subsModel::$tableSchema['email'] = $filteredEmail;
            if($subsModel->checkIfExist($filteredEmail) == 0){
                $subsModel->insertRec();
                $msg[0] = 'تم الاشتراك بنجاح!';
            }else{
                $msg[0] = 'تم الاشتراك من قبل!';
            }
        }else{
            $msg[0] = 'يرجى كتابة بريد الكتروني صالح';
        }
        echo '<div class="suc-msg alert alert-'.$msg[1].'">'.$msg[0].'</div>';
    }
}