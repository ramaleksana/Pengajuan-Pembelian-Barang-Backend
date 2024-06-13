<?php

namespace App\Controllers;

use App\Models\PengajuanModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class PengajuanManagerController extends ResourceController
{

    protected $model;

    public function __construct()
    {
        $this->model = new PengajuanModel();
    }

    public function index()
    {
        $page = $this->request->getGet('page') ?? 1;
        $limit = $this->request->getGet('limit') ?? 10;

        $data = $this->model->getPaginatedData($limit, $page, ['status_on_manager' => 'Pending', 'status_on_finance' => 'Pending']);

        return $this->respond($data);
    }

    public function show($id = null)
    {
        $data = $this->model->where(['status_on_manager' => 'Pending', 'status_on_finance' => 'Pending'])->find($id);
        return $this->respond([
            'success' => true,
            'message' => 'Show data success',
            'data' => $data,
        ]);
    }

    public function history()
    {
        $page = $this->request->getGet('page') ?? 1;
        $limit = $this->request->getGet('limit') ?? 10;

        $data = $this->model->getPaginatedData($limit, $page, ['status_on_manager' => 'Approved']);

        return $this->respond($data);
    }

    public function decision($id = null)
    {
        helper('form');
        $status = $this->request->getVar('status');
        $note = null;

        $rules = [
            'status' => 'required|in_list[Approved, Rejected]',
        ];

        if ($status == 'Rejected') {
            $rules['note'] = 'required|max_length[250]';
            $note = $this->request->getVar('note');
        }

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $data = [
            'status_on_manager'         => $status,
            'update_status_on_manager'  => date("Y-m-d H:i:s"),
            'note_from_manager'         => $note,
        ];

        $this->model->update($id, $data);

        return $this->respondUpdated([
            'success' => true,
            'message' => 'Update data success',
            'data' => $data,
        ]);
    }
}
