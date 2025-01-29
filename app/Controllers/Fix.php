<?php
namespace App\Controllers;

use App\Models\TripsModel;
use App\Models\UserModel;

class Fix extends BaseController
{

    public function fixPassengerID()
    {
        $tripModel = new TripsModel();
        $userModel = new UserModel();

        $trips = $tripModel->findAll();

        foreach ($trips as $trip) {

            if ($trip['passenger_id'] > 0) {
                $user = $userModel->where('id', $trip['passenger_id'])->first();

                if ($user) {
                    $tripModel->update($trip['id'], [
                        'passenger_id'   => $user['id'],
                        'passenger_name' => $user['name'].' '.$user['lname'],
                        'passenger_tel'  => $user['mobile'],
                    ]);
                }
            } else {
                $passengerTel = $trip['passenger_tel'];
                $user         = $userModel->where('mobile', $passengerTel)->first();

                if ($user) {
                    $tripModel->update($trip['id'], [
                        'passenger_id'   => $user['id'],
                        'passenger_name' => $user['name'].' '.$user['lname'],
                        'passenger_tel'  => $user['mobile'],
                    ]);
                }
            }

        }

        echo "DONE";

    }

}
