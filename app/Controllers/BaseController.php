<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\CabangModel;
use Myth\Auth\Models\GroupModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['auth', 'form', 'url', 'text'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        $this->nama = "Ryan Hidayat";
    }

    protected function getListCabang()
    {
        $cabangModel  = new CabangModel();
        $listCabang = $cabangModel->findAll();
        return json_encode($listCabang);
    }

    protected function getListGroup()
    {
        $groupModel = new GroupModel();
        $listGroup = $groupModel->find();
        return json_encode($listGroup);
    }

    protected function getCabangKonsul($kd_cab)
    {
        $cabangModel  = new CabangModel();
        $cabKonsul = $cabangModel->select(['cab_konsul'])->where('kd_cab', $kd_cab)->first();

        return $cabKonsul['cab_konsul'];
    }
}
