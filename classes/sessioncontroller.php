<?php
require_once 'classes/session.php';
require_once 'models/usermodel.php';
class SessionController extends Controller{
    private $userSession;
    private $email;
    private $userid;

    private $session;
    private $sites;

    private $user;

    function __construct(){
        parent::__construct();
        $this->init();
    }
    function init(){
        //crear nueva sesion
        $this->session=new Session();

        $json=$this->getJSONFileConfig();
        
        $this->sites=$json['sites'];
        $this->defaultSites=$json['default-sites'];

        $this->validateSession();
    }
    private function getJSONFileConfig(){
        //asignamos el contenido de access a una variable
        $string = file_get_contents('config/access.json');
        $json = json_decode($string, true);
        return $json;
    }
    public function validateSession(){
        error_log('SESSIONCONTROLLER::validateSession');
        //si existe la sesion
        if($this->existsSession()){
            $role = $this->getUserSessionData()->getRole();
            error_log("sessionController::validateSession(): email:" . $this->user->getEmail() . " - role: " . $this->user->getRole());
            //validar si la pagina a la que accedera es publica
            if($this->isPublic()){
                $this->redirectDefaultSiteByRole($role);
                error_log( "SessionController::validateSession() => sitio público, redirige al main de cada rol" );

            }else{
                if($this->isAuthorized($role)){
                    error_log( "SessionController::validateSession() => autorizado, lo deja pasar" );

                    //dejarlo pasar
                }else{
                    error_log( "SessionController::validateSession() => no autorizado, redirige al main de cada rol" );
                    $this->redirectDefaultSiteByRole($role);
                }

            }
        }else{
            //no existe la sesion
            if($this->isPublic()){
                error_log('SessionController::validateSession() public page');
                //dejar entrar
            }else{
                error_log('SessionController::validateSession() redirect al login');
                header('Location: ' . constant('URL') . '');

            }
        }
    }

    function existsSession(){
        if(!$this->session->exists()) return false;
        if($this->session->getCurrentUser() == NULL) return false;
        $userid = $this->session->getCurrentUser();

        if($userid) return true;

        return false;
    }

    function getUserSessionData(){
        $id = $this->session->getCurrentUser();
        $this->user=new UserModel();
        $this->user->get($id);
        return $this->user;
    }

    function isPublic(){
        $currentURL=$this->getCurrentPage();
        //remplazamos
        error_log("sessionController::isPublic(): currentURL => " . $currentURL);
        $currentURL=preg_replace("/\?.*/","",$currentURL);

        for($i=0; $i < sizeof($this->sites); $i++){
            if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['access'] === 'public'){
                return true;
            }
        }
        return false;
    }
    function getCurrentPage(){
        //Solicitar link URL donde estamos posicionados
        $actualLink=trim("$_SERVER[REQUEST_URI]");
        //Separar lo obtenido y lo guarda como un arreglo
        $url=explode("/",$actualLink);
        error_log('SESSIONCONTROLLER::getCurrentPage ->'. $url[2]);
        //retornamos la posicion 2
        return $url[2];
    }
    private function redirectDefaultSiteByRole($role){
        $url = '';
        for($i=0; $i < sizeof($this->sites); $i++){
            if($this->sites[$i]['role'] == $role){
                $url = '/' . $this->sites[$i]['site'];
            break;
            }
        }
        header('location:' . constant('URL') . $url);

    }
    private function isAuthorized($role){
        $currentURL=$this->getCurrentPage();
        //remplazamos
        $currentURL=preg_replace("/\?.*/","",$currentURL);

        for($i=0; $i < sizeof($this->sites); $i++){
            if($currentURL = $this->sites[$i]['site'] && $this->sites[$i]['role']==$role){
                return true;
            }
        }
        return false;
    }

    function initialize($user){
        //coloca variables en la sesion
        $this->session->setCurrentUser($user->getId());
        $this->authorizeAccess($user->getRole());
    }

    function authorizeAccess($role){
        switch($role){
            case 'user':
                $this->redirect($this->defaultSites['user'], []);
                break;
            case 'admin':
                $this->redirect($this->defaultSites['admin'], []);
                break;
        }
    }
    function logout() {
        $this->session->closeSession();
    }
}
?>