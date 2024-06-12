<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanModel extends Model
{
    protected $table            = 'pengajuan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'officer_id',
        'items',
        'date_of_filing',
        'status_on_manager',
        'update_status_on_manager',
        'note_from_manager',
        'status_on_finance',
        'update_status_on_finance',
        'note_from_finance',
        'finance_document',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function getPaginatedData($limit, $page, $filter = [])
    {
        $offset = ($page - 1) * $limit;

        $items = $this->where($filter)->orderBy('id', 'DESC')->findAll($limit, $offset);
        $totalItems = $this->countAllResults();

        return [
            'data'          => $items,
            'current_page'  => (int) $page,
            'per_page'      => (int) $limit,
            'total'         => $totalItems,
        ];
    }
}
