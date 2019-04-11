<?php
/**
 * User: root
 * Date: 15/04/16
 * Time: 10:12
 */
namespace Controllers\Pages;
use Library\Security\Protector;
use Illuminate\Database\Capsule\Manager as DB;
use Library\DAO\Tables;
use Models\GenericModel;
use Respect\Rest\Routable;
use eTraits;

class Admin implements Routable {
    use eTraits\Response;

    public function __construct($url, $blade, $request, $options, $id = null){
        $this->blade = $blade;
        $this->url = $url;
        $this->dbname = $options['dbname'];
        $this->installtype = $options['installtype'];
        $this->crud = $options['crud'];
        $this->graph = $options['graph'];
        $this->id = $id;
    }

    public function get( ) {
        $user = Protector::getUser();

        $tblObj = Tables::sortTablesByRows($this->dbname);

        $tObj = new GenericModel();
        $tObj->setTable($this->graph);
        $topTableData = $tObj->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
        ->orderBy('id', 'desc')
        ->groupby('year','month')
        ->limit(100)
        ->get();

        $obj = new GenericModel();
        $obj->setTable('log');
        $query = $obj::orderBy('id', 'desc')->limit(5)->get();



        echo $this->blade->view()
            ->make('Admin/dashboard')
            ->with('tblobj', $tblObj)
            ->with('user', $user)
            ->with('topTableData', $topTableData)
            ->with('logs', $query)
            ->render();
    }

    public function post( ) {
        $u = ['status' => 'there is nothing here'];
        $this->json($u);
    }

    public function put ( ) {

    }
}