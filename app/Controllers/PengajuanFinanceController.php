<?php

namespace App\Controllers;

use App\Models\PengajuanModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class PengajuanFinanceController extends ResourceController
{

    protected $model;

    public function __construct()
    {
        $this->model = new PengajuanModel();
    }

    public function index()
    {
        //
    }

    public function decision($id = null)
    {
        helper('form');
        $status = $this->request->getVar('status');
        $note = null;
        $filename = null;

        $rules = [
            'status' => 'required|in_list[Approved, Rejected]',
        ];

        if ($status == 'Rejected') {
            $rules['note'] = 'required|max_length[250]';
            $note = $this->request->getVar('note');
        } else if ($status == 'Approved') {
            $rules['file'] = [
                'label' => 'Image File',
                'rules' => 'uploaded[file]|is_image[file]|mime_in[file,image/jpg,image/jpeg,image/png]|max_size[file,2048]',
            ];
        }

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        if ($status == 'Approved') {
            $file = $this->request->getFile('file');

            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads', $newName);

                $filename = $file->getName();
            }
        }

        $data = [
            'status_on_finance'         => $status,
            'update_status_on_finance'  => date("Y-m-d H:i:s"),
            'note_from_finance'         => $note,
            'finance_document'          => $filename,
        ];

        $this->model->update($id, $data);

        return $this->respondUpdated([
            'success' => true,
            'message' => 'Update data success',
            'data' => $data,
        ]);
    }
}
