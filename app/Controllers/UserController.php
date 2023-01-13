<?php

namespace App\Controllers;

use App\Models\DatatableModel;
use CodeIgniter\CLI\Console;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;
use App\Models\CabangModel;

use Config\Services;

class UserController extends BaseController
{
    public function index()
    {
        $data = [
            'nav'               => 'manageUser',
            'listCabang'        => $this->getListCabang(),
            'listGroup'         => $this->getListGroup()
        ];



        return view('users/manageUser', $data);
    }

    public function tableUsers()
    {
        if ($this->request->isAJAX()) {

            /*
            SELECT users.id, fullname, username, email, hp, branch, auth_groups.name status FROM users
            JOIN auth_groups_users 
            ON users.id = auth_groups_users.user_id
            JOIN auth_groups 
            ON auth_groups_users.group_id = auth_groups.id
            */


            //konfigurasi table
            $table                  =  'users';
            $column_search_order    = ['users.id', 'fullname', 'username', 'email', 'hp', 'branch', 'auth_groups.name', 'status'];
            $order                  = ['users.id' => 'DESC'];
            $table_join             = array(
                array("auth_groups_users", "users.id = auth_groups_users.user_id"),
                array("auth_groups", "auth_groups_users.group_id = auth_groups.id"),
            );

            $conditions = [
                //'deleted_at' => user()->branch_group
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
                    $row[] = $list->fullname;
                    $row[] = $list->username;
                    $row[] = $list->email;
                    $row[] = $list->hp;
                    $row[] = $list->branch;
                    $row[] = $list->name;
                    $row[] = $list->status;
                    $row[] = $list->id;
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

    /**
     * Attempt to register a new user.
     */
    public function saveRegisterUser()
    {
        if ($this->request->isAJAX()) {
            //create parameter rules validasi
            $rules = [
                'username'     => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
                'email'        => 'required|valid_email|is_unique[users.email]',
                'fullname'     => 'required',
                'hp'           => 'required',
                'branch'       => 'required',
                'groupUser'    => 'required'
            ];

            //cek validasi terlebih dahulu            
            if (!$this->validate($rules)) {
                $msg = ['error' => $this->validator->getErrors()];
            } else {
                //apabila melakukan penambahan user
                if (empty($this->request->getVar('id'))) {
                    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
                    $pass_random = substr(str_shuffle($data), 0, 8);


                    $data_register = [
                        'username'          => $this->request->getVar('username'),
                        'email'             => $this->request->getVar('email'),
                        'fullname'          => $this->request->getVar('fullname'),
                        'hp'                => $this->request->getVar('hp'),
                        'branch'            => $this->request->getVar('branch'),
                        'branch_group'      => $this->getCabangKonsul($this->request->getVar('branch')),
                        'password_default'  => $pass_random,
                        'password'          => $pass_random
                    ];

                    //simpan data user
                    $userModel = model(UserModel::class);
                    $user  = new User($data_register);
                    $user->generateActivateHash();
                    //$user->forcePasswordReset();

                    $userModel = $userModel->withGroup($this->request->getVar('groupUser'));

                    if (!$userModel->save($user)) { //jika user gagal tampilkan error
                        $msg = [
                            'status'    => 'gagal',
                            'msg'       => 'User gagal ditamba22hkan'
                        ];
                    } else { //jika berhasil 
                        //kirim email aktivasi
                        $activator = service('activator');
                        $sent      = $activator->send($user);

                        if (!$sent) {
                            $msg = [
                                'status'    => 'gagal',
                                'msg'       => 'Email aktivasi user gagal dikirim'
                            ];
                        } else {
                            // Success!
                            $msg = [
                                'status'    => 'sukses',
                                'msg'       => 'User berhasil ditambahkan, silahkan cek email ybs'
                            ];
                        }
                    }
                } else { //apabila merubah user
                    $msg = [
                        'status'    => 'sukses',
                        'msg'       => 'User berhasil dirubah'
                    ];
                }
            }
            echo json_encode($msg);
        }
    }




    public function profile()
    {

        $data = [
            'nav'    => 'profileUser'
        ];



        return view('users/profile', $data);
    }
}
