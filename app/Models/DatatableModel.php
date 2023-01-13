<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class DatatableModel extends Model
{
    protected $table;
    protected $column_order;
    protected $column_search;
    protected $order;
    protected $conditions;
    protected $request;
    protected $db;
    protected $dt;

    public function __construct(RequestInterface $request, $table, $table_join, $column_search_order, $order, $conditions)
    {
        parent::__construct();
        $this->table            = $table;
        $this->table_join       = $table_join;
        $this->column_order     = $column_search_order;
        $this->column_search    = $column_search_order;
        $this->order            = $order;
        $this->conditions       = $conditions;

        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }

    private function getDatatablesQuery()
    {

        //create query select 
        $this->dt->select(implode(',', $this->column_search));
        for ($i = 0; $i < count($this->table_join); $i++) {
            $this->dt->join($this->table_join[$i][0], $this->table_join[$i][1]);
        }
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        $this->dt->where($this->conditions);

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }




    public function getDatatables()
    {
        $this->getDatatablesQuery();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFiltered()
    {
        $this->getDatatablesQuery();
        return $this->dt->countAllResults();
    }

    public function countAll()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
}
