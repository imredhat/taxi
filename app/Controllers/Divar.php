<?php
namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Divar extends BaseController
{
    public function index()
    {
        // تنظیمات اولیه
        $base_url  = "https://www.sheypoor.com/api/v10.0.0/search/babol/real-estate";
        $phone_url = "https://www.sheypoor.com/api/v10.0.0/listings/{id}/number";
        $cookies   = [
            "_ga=GA1.1.1456751730.1737186360",
            "provinces=",
            "cities=",
            "provinceID=27",
            "province=mazandaran",
            "cityID=952",
            "city=babol",
            "geo=city",
            "saved_items=%5B%5D",
            "access_token=Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsInR5cGUiOiJBQ0NFU1MifQ.eyJhdWQiOlsic2hleXBvb3IiXSwiZXhwIjoxNzM3MTg3NDUxLCJpYXQiOjE3MzcxODY4NTEsImlzcyI6InNoZXlwb29yIiwianRpIjoiZTdiNWM0OTQtNDViNC00YTU2LWI3ZmEtZjM1MjAwZGJlNDg4IiwibmJmIjoxNzM3MTg2ODUxLCJ1c2VySWQiOiI2NjI3MyJ9.5wFqX9TQZ0hpXusOzlbhby8wXVX7eHpsdujf1jcKs14",
            "refresh_token=Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsInR5cGUiOiJSRUZSRVNIIn0.eyJhdWQiOlsic2hleXBvb3IiXSwiZXhwIjoxNzQ0OTYyODUxLCJpYXQiOjE3MzcxODY4NTEsImlzcyI6InNoZXlwb29yIiwianRpIjoiZjQ3Mjg3YzAtYWVhZC00YzlhLWJmMzUtMjc3NWM3NmZkODE0IiwibmJmIjoxNzM3MTg2ODUxLCJ1c2VySWQiOiI2NjI3MyJ9.nEEeiUglBM-z8vohe-gIFsc3abr18BNZNgcmdBwi0LI",
            "user_logged_in=1",
            "_ga_RVTCLF1865=GS1.1.1737186359.1.1.1737187027.36.0.0",
        ];
        $cookie_string = implode("; ", $cookies);

        // جمع‌آوری داده‌ها
        $all_data = [];
        for ($page = 1; $page <= 5; $page++) { // برای 5 صفحه اول
                                                   // echo "Fetching data from page $page...\n";
            $listings = $this->fetchData($page, $cookie_string, $base_url);
            foreach ($listings as $listing) {

                // echo json_encode($listing['type']);

                // die();

                // if ($listing['type'] == 'special') {
                //     foreach ($listing['items'] as $L1) {

                //         $listing_id        = $listing['id'];
                //         $title             = $listing['title'];
                //         $price             = $listing['price'];
                //         $shopLogo          = $L1['shopLogo'] ?? 'N/A';
                //         $telephone         = $L1['telephone'] ?? 'N/A';
                //         $business_category = $L1['categories'][0]['name'] ?? 'N/A';
                //         $ads_category      = $L1['categories'][1]['name'] ?? 'N/A';
                //         $cat               = "special";
                //         $phone             = $this->getPhoneNumber($listing_id, $cookie_string, $phone_url);

                //         $all_data[] = [
                //             'ID'               => $listing_id,
                //             'Title'            => $title,
                //             'Price'            => $price,
                //             'Phone'            => $phone,
                //             'ShopLogo'         => $shopLogo,
                //             'Telephone'        => $telephone,
                //             'BusinessCategory' => $business_category,
                //             'AdsCategory'      => $ads_category,
                //             "CAT"              => $cat, 
                //         ];

                //     }
                // }



                if ($listing['type'] == 'normal') {

                  

                        $listing_id        = $listing['id'];
                        $title             = $listing['attributes']['title'];
                        $price             = $listing['attributes']['price'][0]['amount'] -> amount ?? 'N/A';
                        $shopLogo          = $listing['attributes']['shopLogo'] ?? 'N/A';
                        $telephone         = $listing['attributes']['telephone'] ?? 'N/A';
                        $business_category = $listing['attributes']['categories'][0]['name'] ?? 'N/A';
                        $ads_category      = $listing['attributes']['categories'][1]['name'] ?? 'N/A';
                        $cat               = "normal";
                        $phone             = $this->getPhoneNumber($listing_id, $cookie_string, $phone_url);


                        print_r($this->getPhoneNumber($listing_id, $cookie_string, $phone_url));
                        die();
                       
                    

                        $all_data= [
                            'ID'               => $listing_id,
                            'Title'            => $title,
                            'Price'            => $price,
                            'Phone'            => $phone,
                            'ShopLogo'         => $shopLogo,
                            'Telephone'        => $phone,
                            'BusinessCategory' => $business_category,
                            'AdsCategory'      => $ads_category,
                            "CAT"              => $cat, 
                        ];



                        echo json_encode($all_data);
                        die();

                    }

                }
                   

            
        }

        print_r($all_data);
        die();

        // ایجاد فایل اکسل
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Title');
        $sheet->setCellValue('C1', 'Price');
        $sheet->setCellValue('D1', 'Phone');

        $row = 2;
        foreach ($all_data as $data) {
            $sheet->setCellValue('A' . $row, $data['ID']);
            $sheet->setCellValue('B' . $row, $data['Title']);
            $sheet->setCellValue('C' . $row, $data['Price']);
            $sheet->setCellValue('D' . $row, $data['Phone']);
            $row++;
        }

        // ذخیره فایل اکسل
        $writer = new Xlsx($spreadsheet);
        $writer->save(WRITEPATH . 'uploads/sheypoor_data.xlsx');

        echo "داده‌ها با موفقیت در فایل اکسل ذخیره شدند.\n";
    }

    // تابع برای دریافت شماره موبایل
    private function getPhoneNumber($listing_id, $cookie_string, $phone_url)
    {
        $url = str_replace("{id}", $listing_id, $phone_url);
        $ch  = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie_string);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        return $data;
    }

    // تابع برای دریافت داده‌ها از صفحه
    private function fetchData($page, $cookie_string, $base_url)
    {
        $url = $base_url . "?f=442512713n&p=" . $page;
        $ch  = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie_string);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);

        return $data['data'] ?? [];
    }
}
