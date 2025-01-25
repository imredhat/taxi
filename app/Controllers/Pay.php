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

        $name        = $this->request->getPost('name');
        $mobile      = $this->request->getPost('mobile');
        $amount      = $this->request->getPost('amount');
        $description = $this->request->getPost('description');

        $data = [
            'name'        => $name,
            'mobile'      => $mobile,
            'amount'      => $amount,
            'description' => $description,
        ];

        // load the config file from your project
        $paymentConfig = require '../vendor/shetabit/multipay/config/payment.php';

        $payment = new Payment($paymentConfig);
        $invoice = new Invoice();

        // Set invoice amount.

        $amount = filter_var($amount, FILTER_SANITIZE_NUMBER_INT);

        $invoice->amount($amount);

        $invoice->detail('name', $data['name'])
            ->detail('mobile', $data['mobile'])
            ->detail('amount', $data['amount'])
            ->detail('description', $data['description']);

        // return $payment->purchase(
        //     (new Invoice)->amount(1000),
        //     function ($driver, $transactionId) {
        //         // Store transactionId in database.
        //         // We need the transactionId to verify payment in the future.
        //     }
        // )->pay()->render();


        $res = $payment -> purchase($invoice)->pay() -> render();

        print_r($res);



        // $amount= intval($request->input('amount'));
        //     $transaction_user = TransactionUser::create([
        //         'user_id'=>$userId,
        //         'amount' =>$amount
        //     ]);
        //     $invoice=new Invoice();
        //     $invoice->amount($amount);
        //     $res = Payment::purchase($invoice,function ($transaction_id) use ($transaction_user){
        //         $transaction_user->update([
        //             'transaction_id'=>$transaction_id
        //         ]);
        //     })->pay()->render();
        //     return $res;

        // $data['payment_id'] = $payment->getPaymentId();

        // $this->sendToBank($data);
    }

    public function Check()
    {

        print_r($_POST);
        die();
        $amount         = $this->request->getPost('amount');
        $transaction_id = $this->request->getPost('transactionId');

        $payment = new Payment();

        try {
            $receipt = $payment->amount($amount)->transactionId($transaction_id)->verify();

            // You can show payment referenceId to the user.
            echo $receipt->getReferenceId();

        } catch (InvalidPaymentException $exception) {

            echo $exception->getMessage();
        }

    }

}
