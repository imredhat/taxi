<?php
namespace App\Controllers;
use App\Libraries\GroceryCrud;
use App\Models\BankModel;
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
            'bank_id'     => $this->request->getPost('bank_id'),
        ];

        $data['amount'] = str_replace(',', '', $data['amount']);

        if ($this->request->getPost('trans_type') == 'in') {
            $data['_from'] = 'USER';
            $data['_to']   = 'POT';

            $userModel = new \App\Models\UserModel();
            $user      = $userModel->find($this->request->getPost('userID'));

            $data['name']   = $user['name'] . ' ' . $user['lname'];
            $data['tel']    = $user['mobile'];
            $data['userID'] = $user['id'];

        } else {
            $data['_from'] = 'POT';
            $data['_to']   = 'DRIVER';

            $driverModel      = new \App\Models\DriverModel();
            $driver           = $driverModel->find($this->request->getPost('userID'));
            $data['name']     = $driver['name'] . ' ' . $driver['lname'];
            $data['tel']      = $driver['mobile'];
            $data['driverID'] = $driver['did'];
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
        $data['transactions'] = $transactionModel -> TripTrans( $tripID );

        return view('modal/TransactionList', $data);
    }

    public function remove()
    {
        $id               = $this->request->getPost('id');
        $transactionModel = new TransactionModel();
        $transaction      = $transactionModel
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

    public function All()
    {
       
        $crud = new GroceryCrud();    

        $crud->setLanguage("Persian");
        $crud->setTheme('bootstrap');
        $crud->setTable('user_transaction');
        $crud->setSubject('تراکنش', 'تراکنش‌ها');
        $crud->unsetEdit();
        $crud->unsetAdd();
        $crud->unsetDelete();
        $crud->columns(['id', 'name','type','amount', 'desc', 'date_p', 'scan', 'tripID','trans_id','bank_id']);
        $crud->fields(['name', 'tel', 'amount', 'desc', 'trans_id', 'refid', 'date_p', 'response', 'status', 'scan', '_from', '_to', '_for', 'tripID', 'row_status', 'userID', 'driverID', 'type']);
        
        $crud->where('row_status', 'insert');
        
        $crud->displayAs('id', "شناسه");
        $crud->displayAs('name', "پرداخت کننده / دریافت کننده");
        $crud->displayAs('tel', "تلفن");
        $crud->displayAs('amount', "مقدار");
        $crud->displayAs('desc', "توضیحات");
        $crud->displayAs('trans_id', "شناسه تراکنش");
        $crud->displayAs('refid', "شناسه مرجع");
        $crud->displayAs('date_p', "تاریخ");
        $crud->displayAs('response', "پاسخ");
        $crud->displayAs('status', "وضعیت");
        $crud->displayAs('scan', "رسید پرداخت");
        $crud->displayAs('_from', "از");
        $crud->displayAs('_to', "به");
        $crud->displayAs('_for', "برای");
        $crud->displayAs('tripID', "شناسه سفر");
        $crud->displayAs('row_status', "وضعیت ردیف");
        $crud->displayAs('userID', "شناسه کاربر");
        $crud->displayAs('driverID', "شناسه راننده");
        $crud->displayAs('type', "نوع");
        $crud->displayAs('deleted_at', "تاریخ حذف");
        $crud->displayAs('trans_type', "نوع تراکنش");
        $crud->displayAs("bank_id","نام حساب");

        $crud->setRelation('bank_id', 'bnks', 'title');

        $crud->fieldType('status', 'dropdown', ['1' => 'فعال', '0' => 'غیرفعال']);
        $crud->fieldType('type', 'dropdown', ['in' => 'دریافتی از مسافر', 'out' => 'پرداختی به راننده ', 'refund' => 'استرداد به مشتری ']);

        

        $this->UploadCallback($crud, 'scan');

        $crud->callbackColumn('tripID', function ($value, $row) {
            return $value + 1000;
        });

        $crud->callbackColumn('amount', function ($value, $row) {
            return number_format($value, 0, '', ',') . ' تومان';
        });




        $output = $crud->render();

        echo view('parts/header');
        echo view('parts/side');
        echo view('trans', (array) $output);
        echo view('parts/footer_crud');

    }



     public function AllDated()
    {
       
        $crud = new GroceryCrud();    

        $crud->setLanguage("Persian");
        $crud->setTheme('bootstrap');
        $crud->setTable('user_transaction');
        $crud->setSubject('تراکنش', 'تراکنش‌ها');
        $crud->unsetEdit();
        $crud->unsetAdd();
        $crud->unsetDelete();
        $crud->columns(['id', 'name','type','amount', 'desc', 'date_p', 'scan', 'tripID','trans_id','bank_id']);
        $crud->fields(['name', 'tel', 'amount', 'desc', 'trans_id', 'refid', 'date_p', 'response', 'status', 'scan', '_from', '_to', '_for', 'tripID', 'row_status', 'userID', 'driverID', 'type']);
        
        $from_date = $this->request->getGet('from_date');
        $to_date = $this->request->getGet('to_date');

        // $from_date = $this->request->getGet('from_date') ?? "1400/01/01";
        // $to_date = $this->request->getGet('to_date') ?? "9999/01/01";
        
        
        // echo $to_date;
        //     die();

        $crud->where('row_status', 'insert');
        $crud->where('date_p >=',  $from_date);
        $crud->where('date_p <=',  $to_date);
        
        $crud->displayAs('id', "شناسه");
        $crud->displayAs('name', "پرداخت کننده / دریافت کننده");
        $crud->displayAs('tel', "تلفن");
        $crud->displayAs('amount', "مقدار");
        $crud->displayAs('desc', "توضیحات");
        $crud->displayAs('trans_id', "شناسه تراکنش");
        $crud->displayAs('refid', "شناسه مرجع");
        $crud->displayAs('date_p', "تاریخ");
        $crud->displayAs('response', "پاسخ");
        $crud->displayAs('status', "وضعیت");
        $crud->displayAs('scan', "رسید پرداخت");
        $crud->displayAs('_from', "از");
        $crud->displayAs('_to', "به");
        $crud->displayAs('_for', "برای");
        $crud->displayAs('tripID', "شناسه سفر");
        $crud->displayAs('row_status', "وضعیت ردیف");
        $crud->displayAs('userID', "شناسه کاربر");
        $crud->displayAs('driverID', "شناسه راننده");
        $crud->displayAs('type', "نوع");
        $crud->displayAs('deleted_at', "تاریخ حذف");
        $crud->displayAs('trans_type', "نوع تراکنش");
        $crud->displayAs("bank_id","نام حساب");

        $crud->setRelation('bank_id', 'bnks', 'title');

        $crud->fieldType('status', 'dropdown', ['1' => 'فعال', '0' => 'غیرفعال']);
        $crud->fieldType('type', 'dropdown', ['in' => 'دریافتی از مسافر', 'out' => 'پرداختی به راننده ']);

        

        $this->UploadCallback($crud, 'scan');

        $crud->callbackColumn('tripID', function ($value, $row) {
            return $value + 1000;
        });

        $crud->callbackColumn('amount', function ($value, $row) {
            return number_format($value, 0, '', ',') . ' تومان';
        });




        $output = $crud->render();

        echo view('parts/header');
        echo view('parts/side');
        echo view('trans', (array) $output);
        echo view('parts/footer_crud');

    }

    public function UpdateDB()
    {
        $db = \Config\Database::connect();
        $db->query('ALTER TABLE `request` ADD `notified` INT NOT NULL AFTER `isAccepted`;');

        $db->query("CREATE TABLE `bnks` (
            `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `title` varchar(100) DEFAULT NULL,
            `bank_name` varchar(100) DEFAULT NULL,
            `holder_name` varchar(100) DEFAULT NULL,
            `card_number` varchar(100) DEFAULT NULL,
            `shaba` varchar(100) DEFAULT NULL,
            `active` enum('0','1') DEFAULT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;");

        $db->query('ALTER TABLE `trips` ADD `bank` INT NOT NULL AFTER `dsc`;');
    }

    public function UploadCallback($crud, $field)
    {

        $crud->callbackColumn($field, function ($row, $data) use ($field) {
            if(!empty($data -> $field)) {
                return '<a href="'.base_url('uploads/transaction/' . $data->tripID . '/' .  $data->scan).'" target="_blank"> <img src="' . base_url('uploads/transaction/' . $data->tripID . '/' .  $data->scan) . '" width="100" height="200"></a>';
            } else {
                return '';
            }
        });


        $crud->callbackEditField($field, function ($row, $pid) use ($field) {

            if (! empty($row)) {
                return '<img src="' . base_url('uploads/transaction/' . $pid . '/' . $row) . '" width="500" height="500"> <a class="cls" href="' . base_url(relativePath: "RD/") . $field . '/' . $pid . '" ><img src="' . base_url('assets/images/close.png') . '" width="25" /> </a>';
            } else {
                return ' <input name="' . $field . '" id="file-upload" type="file"> ';
            }
        });

        $crud->callbackBeforeUpdate(function ($stateParameters) {

            $fields = ['scan'];
            foreach ($fields as $field) {
                $file = $this->request->getFile($field);
                if (isset($file)) {
                    if (! file_exists(base_url('uploads/transaction/' . $stateParameters->primaryKeyValue . '/' . $file->getName()))) {
                        if ($file->isValid()) {
                            $file->move('uploads/transaction/' . $stateParameters->primaryKeyValue, $file->getName());
                            $stateParameters->data[$field] = $file->getName();
                        }
                    }
                }
            }

            return $stateParameters;
        });

        $crud->callbackBeforeInsert(function ($stateParameters) use ($field) {
            $file = $this->request->getFile('ax');
            if (isset($file)) {
                if (! file_exists(base_url('uploads/transaction/' . $file->getName()))) {
                    if ($file->isValid()) {
                        $file->move('uploads/transaction/', $file->getName());
                        $stateParameters->data['ax'] = $file->getName();
                    }
                }
            }

            $scan = $this->request->getfile('scan_melli');
            if (isset($scan)) {
                if (! file_exists(base_url('uploads/transaction/' . $scan->getName()))) {
                    if ($scan->isValid()) {
                        $scan->move('uploads/transaction/', $scan->getName());
                        $stateParameters->data['scan_melli'] = $scan->getName();
                    }
                }
            }

            return $stateParameters;
        });

        return $crud;
    }


}
