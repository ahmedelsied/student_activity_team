<?php
namespace controllers;
use models\userModel;
use lib\sessionmanger;
use lib\inputfilter;
use lib\helper;
use lib\multibleupload;
use lib\validate;
class adminController extends adminAbstractController
{
    use sessionManger,inputfilter,helper,multibleupload,validate;
    public $adminUser;
    public $article;
    public $talents;
    public $catgs;
    public $catg_id;
    public $talentsActive;
    public $articlesActive;
    private $isSetSession;
    public function __construct()
    {
        if($this->checkSession('username'.sha1(md5('@Ahmed123')))){
            $this->adminUser = $_SESSION['username'.sha1(md5('@Ahmed123'))];
            $this->isSetSession = true;
        }
    }
    public function defaultAction($params)
    {
        $Href = [$this->mainURL,$this->mainURL.'admin/',$this->mainURL.'admin/default'];
        if($this->setParams($params,0)){  
            if($this->isSetSession){
                $this->redirect('../../admin/articles');
            }else{
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $username = $this->filterString($_POST['user']);
                    $pass = $this->hashPass($_POST['pass']);
                    $data = $this->_login($username,$pass);
                    if($data[1] == 1){
                        $this->setSession($username);
                        $this->redirect('../../admin');
                    }else{
                        echo '<div style="width:25%;margin:10px" class="alert alert-danger">البريد الالكتروني أو الرقم السري <strong>غير صحيحين</strong></div>';
                        $this->_defaultView();
                    }
                }else{
                    $this->_defaultView();
                }
            }  
        }else{
            $this->invalidparamsAction();
        }  
    }
    public function logoutAction()
    {
        $this->finishSession();
        $this->redirect('../../admin');
        exit();
    }
    public function articlesAction($params)
    {
        if($this->isSetSession){ 
            $articles = $this->artcModel();
            $catgModel = $this->catgModel();
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['artcID'])){
                $artcID = $this->filterInt($_POST['artcID']) ? $_POST['artcID'] : null;
                $OldImagesFromDb = $articles->getSpec('*','id',$artcID);
                $imgPath = 'C:\xampp\htdocs\AcaWebMvc\public\uploads\articles\\';
                if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
                    if($_SERVER['HTTP_REFERER'] == 'http://acaweb.com:81/admin/articles/?Edit&artcid='.$artcID && isset($_POST['title']) && isset($_POST['details'])){
                        if(!empty($_FILES['images']['name'][0])){
                            $newImages = $this->multipleuploads('images',$imgPath);
                            $old = empty($OldImagesFromDb[0]['images']) ? '' : $OldImagesFromDb[0]['images'].',';
                            $finalImages = $old.$newImages;
                        }else{
                            $newImages = null;
                        }
                        $inserImage = $newImages == null ? $OldImagesFromDb[0]['images'] : $finalImages;
                        $catg = $this->filterInt($_POST['catg']) ? $_POST['catg'] : '';
                        $checkCatg = $catgModel->getSpec('id','id',$catg);
                        $title = $this->filterString($_POST['title']);
                        $details = $this->filterString($_POST['details']);
                        $articles::$tableSchema['title'] = $title;
                        $articles::$tableSchema['details'] = $details;
                        $articles::$tableSchema['cat_id'] = $catg;
                        $articles::$tableSchema['images'] = $inserImage;
                        if($articles->updateRec($artcID)){
                            echo 'التعديل';
                            die();
                        }else{
                            echo 'error';
                            die();
                        }
                        
                    }
                    if($_SERVER['HTTP_REFERER'] == 'http://acaweb.com:81/admin/articles/?Edit&artcid='.$artcID){
                        $deletedImg = $this->filterString($_POST['imgs']);
                        $oldimgsarr = explode(',',$OldImagesFromDb[0]['images']);
                        if (($key = array_search($deletedImg, $oldimgsarr)) !== false) {
                            unset($oldimgsarr[$key]);
                        }
                        $newimgs = implode(',',$oldimgsarr);
                        $articles::$tableSchema['title'] = $OldImagesFromDb[0]['title'];
                        $articles::$tableSchema['details'] = $OldImagesFromDb[0]['details'];
                        $articles::$tableSchema['cat_id'] = $OldImagesFromDb[0]['cat_id'];
                        $articles::$tableSchema['images'] = $newimgs;
                        if(file_exists($imgPath.$deletedImg)){
                            $articles->updateRec($artcID);
                            unlink($imgPath.$deletedImg);
                            echo 'تم';
                        }else{
                            return null;
                        }
                        die();
                    }
                    if($_SERVER['HTTP_REFERER'] == 'http://acaweb.com:81/admin/articles' || $_SERVER['HTTP_REFERER'] == 'http://acaweb.com:81/admin/articles/'){
                        if($OldImagesFromDb[0]['images'] !== ''){
                            $arrimgs = explode(',',$OldImagesFromDb[0]['images']);
                            foreach($arrimgs as $img){
                                unlink($imgPath.$img);
                            }
                        }
                        $articles->deleteRec($_POST['artcID']);
                        die();
                    }
                }
            }
            $this->articlesActive="active";
            $this->loadHeader();
            $this->renderNav();
            if($this->setParams($params,0) && empty($_GET)){
                $this->article = $articles->getAll();
                $this->title="لوحة التـــحكم";
                $this->_view('articles'.DS.'defaultView');
            }elseif(isset($_GET['Edit']) && isset($_GET['artcid']) && empty($_GET['Edit'])){
                if($this->filterInt($_GET['artcid'])){
                    $id = $_GET['artcid'];
                    $check = $articles->getWPK($id);
                    if(!empty($check)){
                        $this->catgs = $catgModel->getAll();
                        $this->catg_id = $articles->getSpec('cat_id','id',$id);
                        $this->title="تعديل المقاله";
                        $this->article = $check;
                        $this->_view('articles'.DS.'editView');
                    }else{
                        echo 'not found';
                    }
                }else{
                    $this->invalidparamsAction();
                }
            }else{
                $this->invalidparamsAction();
            }
            $this->loadFooter();
        }else{
            $this->redirect('../../admin');
        }
    }
    public function talentsAction($params)
    {
        if($this->isSetSession){    
            if($this->setParams($params,0)){
                $this->title="المشتركين";
                $this->talentsActive="active";
                $subscribers = $this->talentModel();
                $this->talents = array_reverse($subscribers->getAll());
                $this->loadHeader();
                $this->renderNav();
                $this->_view('talentsView');
                $this->loadFooter();
            }else{
                $this->invalidparamsAction();
            }
        }else{
            $this->redirect('../../admin');
        }
    }
    
    public function addArticleAction($params)
    {
        if($this->isSetSession){    
            if($this->setParams($params,0)){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $title = $this->filterString($_POST['title']);
                    $details = $this->filterString($_POST['details']);
                    $catg = $this->filterInt($_POST['catg']) && $_POST['catg'] > 0 && $_POST['catg'] <= 6 ? true : false;
                    if($this->inputStringValidate($title,1,100) && $this->inputStringValidate($details,1,10000) && $catg){
                        $imgPath = 'C:\xampp\htdocs\AcaWebMvc\public\uploads\articles\\';
                        $ArtcileModel = $this->artcModel();
                        $ArtcileModel::$tableSchema['title'] = $title;
                        $ArtcileModel::$tableSchema['details'] = $details;
                        $ArtcileModel::$tableSchema['cat_id'] = $catg;
                        $ArtcileModel::$tableSchema['images'] = $this->multipleuploads('images',$imgPath);
                        if($ArtcileModel->insertRec()){
                            echo '<div class="alert alert-success">تمت الاضافه بنجاح</div>';
                            $this->refresh(2,'http://acaweb.com:81/admin');
                        }else {
                            echo 'error';
                        }
                    }else{
                        echo 'sorry';
                    }
                }else{
                    $this->title="اضافة مقاله";
                    $this->articlesActive="active";
                    $catgModel = $this->catgModel();
                    $this->catgs = $catgModel->getAll();
                    $this->loadHeader();
                    $this->renderNav();
                    $this->_view('articles'.DS.'addView');
                    $this->loadFooter();
                }
            }else{
                $this->invalidparamsAction();
            }
        }else{
            $this->redirect('../../admin');
        }
    }
    private function _login($username,$password)
    {
        $user = new userModel;
        $data = $user->login(array($username,$password));
        return $data;
    }
    private function _defaultView()
    {
        $this->title="تسجيل الدخول";
        $this->loadHeader();
        $this->_view('loginView');
        $this->loadFooter();
    }
}