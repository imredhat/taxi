<?php
namespace App\Controllers;

use App\Models\TransactionModel;

class Transaction extends BaseController
{

    public function index()
    {

    }

    public function create()
    {
        $data = [
            'amount'   => $this->request->getPost('amount'),
            'type'     => $this->request->getPost('trans_type'),
            'userID'   => $this->request->getPost('userID'),
            'date_p'   => $this->request->getPost('date_p'),
            'trans_id' => $this->request->getPost('trans_id'),
            'refid'    => $this->request->getPost('refid'),
            'scan'     => $this->upload_file('scan', "transaction", $this->request->getPost('trip_id')),
            'tripID'   => $this->request->getPost('trip_id'),
            'desc'     => $this->request->getPost('desc'),
        ];


        $data['amount'] = str_replace(',', '', $data['amount']);

        if ($this->request->getPost('trans_type') == 'in') {
            $data['_from'] = 'USER';
            $data['_to']   = 'POT';
            

            $userModel = new \App\Models\UserModel();
            $user      = $userModel->find($this->request->getPost('userID'));

            $data['name'] = $user['name'] . ' ' . $user['lname'];
            $data['tel']  = $user['mobile'];
            $data['userID'] = $user['id'];

        } else {
            $data['_from'] = 'POT';
            $data['_to']   = 'DRIVER';

            $driverModel  = new \App\Models\UserModel();
            $driver       = $driverModel->find($this->request->getPost('userID'));
            $data['name'] = $driver['name'] . ' ' . $driver['lname'];
            $data['tel']  = $driver['mobile'];
            $data['driverID'] = $driver['id'];
        }


        $transactionModel = new TransactionModel();
        $transactionModel->insert($data);

        return $this->response->setJSON(['status' => 'OK', 'message' => 'Transaction created successfully']);
    }

    public function _add()
    {

    }

    public function getAll()
    {

        $tripID               = $this->request->getUri()->getSegment(3);
        $transactionModel     = new TransactionModel();
        $data['transactions'] = $transactionModel
            ->where('tripID', $tripID)
            ->where('row_status', 'insert')
            ->withDeleted()
            ->findAll();

        

        return view('modal/TransactionList', $data);
    }

    public function remove()
    {
        $id = $this->request->getPost('id');
        $transactionModel = new TransactionModel();
        $transaction = $transactionModel
        ->where('id', $id)
        ->withDeleted()
        ->findAll();


        if ($transaction) {
            $transaction['row_status'] = 'delete';
            $transactionModel->update($id, $transaction);
            return $this->response->setJSON(['status' => 'OK', 'message' => 'Transaction removed successfully']);
        } else {
            return $this->response->setJSON(['status' => 'Error', 'message' => 'Transaction not found']);
        }
    }

    private function upload_file($field_name, $type, $DID)
    {
        $file = $this->request->getFile($field_name);
        if (! empty($file)) {
            $config = [
                'uploadPath'   => './uploads/' . $type . "/" . $DID,
                'allowedTypes' => 'jpg|jpeg|png',
                'maxSize'      => 10240,
            ];
            if ($file->isValid()) {
                if (! $file->move($config['uploadPath'])) {
                    $error = ['error' => 'Failed to upload file'];
                    return $error;
                }

                return $file->getName();
            }
        }
    }

}
