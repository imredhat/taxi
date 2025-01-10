<?php

namespace App\Controllers;

use Shetabit\Multipay\Invoice;
use Shetabit\Multipay\Payment;

class Pay extends BaseController
{

    public function UserPay()
    {
        echo view('userPay');
    }

    public function UserPayStart()
    {
      
        $name = $this->request->getPost('name');
        $mobile = $this->request->getPost('mobile');
        $amount = $this->request->getPost('amount');
        $description = $this->request->getPost('description');

        $data = [
            'name' => $name,
            'mobile' => $mobile,
            'amount' => $amount,
            'description' => $description,
        ];

        // load the config file from your project
        // $paymentConfig = require('/vendor/shetabit/multipay/config/payment.php');
        $payment = new Payment();

        $invoice = new Invoice;

        // Set invoice amount.
        $invoice->amount(1000);

        $invoice->detail('name', $data['name'])
            ->detail('mobile', $data['mobile'])
            ->detail('amount', $data['amount'])
            ->detail('description', $data['description']);


            $payment->purchase($invoice,function($driver, $transactionId) {
                // We can store $transactionId in database.
                print_r($transactionId);
            });

            


        echo "<pre>";
        print_r($invoice);
        die();

        // $data['payment_id'] = $payment->getPaymentId();

        // $this->sendToBank($data);
    }

}
