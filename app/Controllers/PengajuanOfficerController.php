<?php

namespace App\Controllers;

use App\Models\PengajuanModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class PengajuanOfficerController extends ResourceController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PengajuanModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $page = $this->request->getGet('page') ?? 1;
        $limit = $this->request->getGet('limit') ?? 10;

        $data = $this->model->getPaginatedData($limit, $page);

        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $data = $this->model->find($id);
        return $this->respond([
            'success' => true,
            'message' => 'Show data success',
            'data' => $data,
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        helper('form');
        $rules = [
            // 'items'             => 'required|array',
            'items.*.item_name' => 'required|string|max_length[150]',
            'items.*.quantity'  => 'required|integer|greater_than[0]'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $items = json_encode($this->request->getVar('items'));

        $data = [
            'officer_id'     => $data = $this->request->decoded->uid,
            'items'          => $items,
            'date_of_filing' => date("Y-m-d H:i:s")
        ];

        $this->model->insert($data);

        return $this->respondCreated([
            'success' => true,
            'message' => 'Create data success',
            'data' => $data,
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        helper('form');
        $rules = [
            // 'items'             => 'required|array',
            'items.*.item_name' => 'required|string|max_length[150]',
            'items.*.quantity'  => 'required|integer|greater_than[0]'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $items = json_encode($this->request->getVar('items'));

        $data = [
            'items'      => $items,
        ];

        $this->model->update($id, $data);

        return $this->respondUpdated([
            'success' => true,
            'message' => 'Update data success',
            'data' => $data,
        ]);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $this->model->delete($id);
        return $this->respondDeleted([
            'success' => true,
            'message' => 'Delete data success',
        ]);
    }
}
