<?php
namespace App\Controllers;

use App\Models\TransactionModel;

class Transaction extends BaseController
{

    public function index()
    {

    }

    public function _create()
    {
        $data = [
            'name'     => $this->request->getPost('name'),
            'tel'      => $this->request->getPost('tel'),
            'amount'   => $this->request->getPost('amount'),
            'desc'     => $this->request->getPost('desc'),
            'trans_id' => $this->request->getPost('trans_id'),
            'refid'    => $this->request->getPost('refid'),
            'date_p'   => $this->request->getPost('date_p'),
            'response' => $this->request->getPost('response'),
            'status'   => $this->request->getPost('status'),
            'scan'     => $this->request->getPost('scan'),
        ];

        $transactionModel = new TransactionModel();
        $transactionModel->insert($data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Transaction created successfully']);
    }

    public function _add(){

    }

    public function getAll(){
        
        $tripID = $this->request->getUri()->getSegment(3);
        $transactionModel = new TransactionModel();
        $data['transactions'] = $transactionModel->where('tripID', $tripID)
                             ->where('row_status', 'insert')
                             ->withDeleted()
                             ->findAll();



        return view('modal/TransactionList', $data);
    }

}
