<?php

namespace App\Controllers;

use App\Models\DatatableModel;
use CodeIgniter\CLI\Console;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;
use App\Models\CabangModel;
use App\Models\DisposisiModel;
use App\Models\DocumentModel;
use Config\Services;

class NdeController extends BaseController
{
    public function index()
    {
        $data = [
            'nav'               => 'inbox',
            'listCabang'        => $this->getListCabang(),
            'listGroup'         => $this->getListGroup()
        ];



        return view('nde/inbox', $data);
    }

    public function tableOutbox()
    {
        if ($this->request->isAJAX()) {

            /*
                SELECT * FROM md_dokument WHERE AKSES_DARI = 'TSI' AND STATUS = 'complete'
            */


            //konfigurasi table
            $table                  =  'md_dokument';
            $column_search_order    = ['TANGGAL_SURAT', 'NOMOR_SURAT', 'SUBJECT', 'DARI', 'KEPADA', 'TEMBUSAN', 'GROUP_SURAT', 'REF'];
            $order                  = ['md_dokument.ID' => 'DESC'];
            $table_join             = array(
                //array("auth_groups_users", "users.id = auth_groups_users.user_id"),
                //array("auth_groups", "auth_groups_users.group_id = auth_groups.id"),
            );

            $conditions = [
                'AKSES_DARI' => user()->branch_group, 'STATUS' => 'complete'
            ];

            $request = Services::request();
            $datatable = new DatatableModel($request, $table, $table_join, $column_search_order, $order, $conditions);

            if ($request->getMethod(true) === 'POST') {
                $lists = $datatable->getDatatables();
                $data = [];
                $no = $request->getPost('start');
                foreach ($lists as $list) {
                    $no++;
                    $row = [];
                    $row[] = $no;
                    $row[] = $list->TANGGAL_SURAT;
                    $row[] = $list->NOMOR_SURAT;
                    $row[] = $list->SUBJECT;
                    $row[] = $list->DARI;
                    $row[] = $list->KEPADA;
                    $row[] = $list->TEMBUSAN;
                    $row[] = $list->GROUP_SURAT;
                    $row[] = $list->REF;
                    $data[] = $row;
                }

                $output = [
                    'draw' => $request->getPost('draw'),
                    'recordsTotal' => $datatable->countAll(),
                    'recordsFiltered' => $datatable->countFiltered(),
                    'data' => $data
                ];

                echo json_encode($output);
            }
        } else {
            $data = [
                'title' => 'Error Pages'
            ];
            return view('errors/html/error_404', $data);
        }
    }

    public function tableInbox()
    {
        if ($this->request->isAJAX()) {

            /*
                SELECT * FROM md_dokument_akses A
                LEFT JOIN md_dokument B 
                ON A.ID = B.ID WHERE A.UNIT = 'TSI'
            */


            //konfigurasi table
            $table                  =  'md_dokument_akses';
            $column_search_order    = ['TANGGAL_SURAT', 'NOMOR_SURAT', 'SUBJECT', 'DARI', 'KEPADA', 'TEMBUSAN', 'GROUP_SURAT', 'REF'];
            $order                  = ['md_dokument.ID' => 'DESC'];
            $table_join             = array(
                array("md_dokument", "md_dokument_akses.ID = md_dokument.ID"),
                //array("auth_groups", "auth_groups_users.group_id = auth_groups.id"),
            );

            $conditions = [
                'UNIT' => user()->branch_group
            ];

            $request = Services::request();
            $datatable = new DatatableModel($request, $table, $table_join, $column_search_order, $order, $conditions);

            if ($request->getMethod(true) === 'POST') {
                $lists = $datatable->getDatatables();
                $data = [];
                $no = $request->getPost('start');
                foreach ($lists as $list) {
                    $no++;
                    $row = [];
                    $row[] = $no;
                    $row[] = $list->TANGGAL_SURAT;
                    $row[] = $list->NOMOR_SURAT;
                    $row[] = $list->SUBJECT;
                    $row[] = $list->DARI;
                    $row[] = $list->KEPADA;
                    $row[] = $list->TEMBUSAN;
                    $row[] = $list->REF;
                    $data[] = $row;
                }

                $output = [
                    'draw' => $request->getPost('draw'),
                    'recordsTotal' => $datatable->countAll(),
                    'recordsFiltered' => $datatable->countFiltered(),
                    'data' => $data
                ];

                echo json_encode($output);
            }
        } else {
            $data = [
                'title' => 'Error Pages'
            ];
            return view('errors/html/error_404', $data);
        }
    }

    public function getNdeByID()
    {
        if ($this->request->isAJAX()) {

            $ref          = $this->request->getVar('ref');

            //get data NDE
            $NDE                = new DocumentModel();
            $data               = $NDE->find($ref);

            //get data Disposisi
            //$NDE                = new DisposisiModel();
            //$dataDisposisi      = $NDE->where('ID_SURAT', $data['ID'])->findAll();

            //$data['disposisi']  =  $dataDisposisi;
            echo json_encode($data);
        }
    }

    public function getNdeDisposisi()
    {
        if ($this->request->isAJAX()) {

            $ref          = $this->request->getVar('ref');

            //get data NDE
            $NDE                = new DocumentModel();
            $data               = $NDE->find($ref);

            //get data Disposisi
            $DISPOS              = new DisposisiModel();
            $dataDisposisi      = $DISPOS->where('ID_SURAT', $data['ID'])->findAll();

            $data['disposisi']  =  $dataDisposisi;
            echo json_encode($data);
        }
    }




    public function inbox()
    {

        $data = [
            'nav'               => 'inbox',
            'title'             => 'Surat Masuk',
            'listCabang'        => $this->getListCabang(),
            'listGroup'         => $this->getListGroup()
        ];


        return view('nde/inbox', $data);
    }

    public function outbox()
    {

        $data = [
            'nav'               => 'outbox',
            'title'             => 'Surat Keluar',
            'listCabang'        => $this->getListCabang(),
            'listGroup'         => $this->getListGroup()
        ];


        return view('nde/outbox', $data);
    }

    public function pdf()
    {

        $data = [
            'nav'               => 'outbox',
            'title'             => 'Surat Keluar',
            'listCabang'        => $this->getListCabang(),
            'listGroup'         => $this->getListGroup()
        ];


        return view('nde/pdf', $data);
        //return $this->response->download('pdf/example.pdf', null);
    }

    public function download_attchment($loc_thn, $loc_bln, $loc_tgl, $namafile)
    {
        return $this->response->download('migrations/attachments/' . $loc_thn . '/' . $loc_bln . '/' . $loc_tgl . '/' . $namafile, null);
    }

    public function download_nde($loc_thn, $loc_bln, $loc_tgl, $namafile)
    {
        return $this->response->download('migrations/pdf/' . $loc_thn . '/' . $loc_bln . '/' . $loc_tgl . '/' . $namafile, null);
    }
}
