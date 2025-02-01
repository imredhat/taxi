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


    public function fixCallDate(){
        $tripModel = new TripsModel();
        $trips = $tripModel->findAll();

        foreach ($trips as $trip) {
            $createdAt = $trip['created_at'];
            $persianDate = $this->convertToPersianDate($createdAt);

            $tripModel->update($trip['id'], [
            'call_date' => $persianDate,
            ]);
        }

        echo "DONE";
        }

        private function convertToPersianDate($date)
        {
        $timestamp = strtotime($date);
        $persianDate = \IntlDateFormatter::create(
            'fa_IR@calendar=persian',
            \IntlDateFormatter::SHORT,
            \IntlDateFormatter::NONE,
            'Asia/Tehran',
            \IntlDateFormatter::TRADITIONAL
        )->format($timestamp);

        $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $persianDate = str_replace($persianDigits, $englishDigits, $persianDate);
        $persianDateParts = explode('/', $persianDate);
        foreach ($persianDateParts as &$part) {
            if (strlen($part) == 1) {
            $part = '0' . $part;
            }
        }
        $persianDate = implode('/', $persianDateParts);

        return $persianDate;
        }
    }


