<?php
/**
 * User: root
 * Date: 15/04/16
 * Time: 10:12
 */
namespace Controllers\Pages;
use eTraits\Response;
use Respect\Rest\Routable;
use Library\Security\Protector;
use Models\GenericModel;

class Login implements Routable {
    use Response;

    public function __construct($url, $blade, $request, $options){
        $this->blade = $blade;
    }

    public function get( ) {
        echo $this->blade->view()->make('Pages/login')->render();
    }

    public function post( ) {
        $data = json_decode(file_get_contents('php://input'));
        $data = $data->pdata;
        $email    = $data->email;
        $password = $data->senha;
        $remember = isset($data->remember) ? $data->remember : false;

        $u = new GenericModel();
        $u->setTable('users');
        $user = $u::where('email', $email)->orderBy('id', 'desc')->take(1)->get();

        if(count($user)>0) {
            $hash = $user[0]->password;
            if (Protector::verifyhash($password, $hash)) {
                $userObj = [];
                $userObj['name']     = $user[0]->name;
                $userObj['email']    = $user[0]->email;
                $userObj['birthday'] = $user[0]->birthday;
                $userObj['id']       = $user[0]->id;
                $_SESSION['user'] = $userObj;
                $_SESSION['is_logged'] = 1;
                $_SESSION['lang'] = $data->lang;
                $msg = ['error'=>0, 'msg'=>'Sucesso - Redirecionando.', 'user'=>$userObj];
                $this->json($msg);
            }else{
                session_destroy();
                $msg = ['error'=>1, 'msg'=>'Senha Incorreta.'];
                $this->json($msg);
            }
        }else{
            session_destroy();
            $msg = ['error'=>2, 'msg'=>'Usuário não encontrado.'];
            $this->json($msg);
        }
    }

}