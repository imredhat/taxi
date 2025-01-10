<?php namespace App\Libraries;



/*******************************************************************************
 *                                                                             *
 * @version  SAMAN Gateway PHP Script                                          *
 * @copyright Copyright (c) 2018.                                              *
 * @author Hasan Shafiei  [www.netparadis.com]                                 *
 *                                                                             *
 *******************************************************************************/

/*
  CREATE TABLE sbpayment (id INT(10) NOT NULL AUTO_INCREMENT,
                          res_num CHAR(20) NOT NULL,
                          ref_num CHAR(20) NOT NULL,
                          total_amont INT NOT NULL,
                          payment INT NOT NULL DEFAULT 0,
                          date_start INT(12) NOT NULL,
                          primary key(id),
                          unique(res_num),
                          index(ref_num));
*/

class SBPayment
{

    public $action  = 'https://sep.shaparak.ir/Payment.aspx';

    public $webMethodURL = 'https://sep.shaparak.ir/payments/referencepayment.asmx?wsdl';

    public $callbackURL = 'https//netparadis.com/example.php'; // Callback URI

    public $totalAmont;

    public $refNum;

    public $resNum;

    protected $payment;

    protected $merchantID;

    protected $password;

    protected $msg = array();
	
    protected $connection;

    protected $errorState = array(
    'Canceled By User'     => 'تراکنش بوسیله خریدار کنسل شده',
    'Invalid Amount'       => 'مبلغ سند برگشتی  از مبلغ تراکنش اصلی بیشتر است',
    'Invalid Transaction'  => 'درخواست برگشت تراکنش رسیده است در حالی که تراکنش اصلی پیدا نمی شود',
    'Invalid Card Number'  => 'شماره کارت اشتباه است',
    'No Such Issuer'       => 'چنین صادر کننده کارتی وجود ندارد',
    'Expired Card Pick Up' => 'از تاریخ انقضای کارت گذشته است',
    'Incorrect PIN'        => 'رمز کارت اشتباه است pin',
    'No Sufficient Funds'  => 'موجودی به اندازه کافی در حساب شما نیست',
    'Issuer Down Slm'      => 'سیستم کارت بنک صادر کننده فعال نیست',
    'TME Error'            => 'خطا در شبکه بانکی',
    'Exceeds Withdrawal Amount Limit'      => 'مبلغ بیش از سقف برداشت است',
    'Transaction Cannot Be Completed'      => 'امکان سند خوردن وجود ندارد',
    'Allowable PIN Tries Exceeded Pick Up' => 'رمز کارت 3 مرتبه اشتباه وارد شده کارت شما غیر فعال اخواهد شد',
    'Response Received Too Late'           => 'تراکنش در شبکه بانکی تایم اوت خورده',
    'Suspected Fraud Pick Up'              => 'اشتباه وارد شده cvv2 ویا ExpDate فیلدهای'
    );

    protected $errorVerify = array(
    '-1'  => 'خطای داخلی شبکه',
    '-2'  => 'سپرده ها برابر نیستند',
    '-3'  => 'ورودی ها حاوی کاراکترهای غیر مجاز میباشد',
    '-4'  => 'کلمه عبور یا کد فروشنده اشتباه است',
    '-5'  => 'خطای بانک اطلاعاتی',
    '-6'  => 'سند قبلا برگشت کامل خورده',
    '-7'  => 'رسید دیجیتالی تهی است',
    '-8'  => 'طول ورودی ها بیشتر از حد مجاز است',
    '-9'  => 'وجود کارکترهای غیر مجاز در مبلغ برگشتی',
    '-10' => 'رسید دیجیتالی حاوی کارکترهای غیر مجاز است',
    '-11' => 'طول ورودی ها کمتر از حد مجاز است',
    '-12' => 'مبلغ برگشتی منفی است',
    '-13' => 'مبلغ برگشتی برای برگشت جزیی بیش از مبلغ برگشت نخورده رسید دیجیتالی است',
    '-14' => 'چنین تراکنشی تعریف نشده است',
    '-15' => 'مبلغ برگشتی به صورت اعشاری داده شده',
    '-16' => 'خطای داخلی سیستم',
    '-17' => 'برگشت زدن تراکنشی که با کارت بانکی غیر از بانک سامان انجام شده',
    '-18' => 'فروشنده نامعتبر است ip address'
    );

    public $style = array('TableBorderColor' => '',
                          'TableBGColor'     => '',
                          'PageBGColor'      => '',
                          'PageBorderColor'  => '',
                          'TitleFont'        => '',
                          'TitleColor'       => '',
                          'TitleSize'        => '',
                          'TextFont'         => '',
                          'TextColor'        => '',
                          'TextSize'         => '',
                          'TypeTextColor'    => '',
                          'TypeTextColor'    => '',
                          'TypeTextSize'     => '',
                          'LogoURI'          => ''
                          );

    function __construct($mID = '',$pass = '' , $connection)
    {
        $this->merchantID = $mID;
        $this->password   = $pass;
        $this->connection   = $connection;

    }

    protected function createResNum()
    {
        do{
            $m = md5(microtime());
            $resNum = substr($m,0,20);
            $search = mysqli_query($this->connection,"SELECT res_num FROM sbpayment WHERE res_num = '$resNum'");
            if( mysqli_num_rows($search) < 1 ) {
                break;
            }
        }while( true );
        $this->resNum = $resNum;
    }

    protected function searchResNum( $resNum )
    {
        $search = mysqli_query($this->connection, "select * FROM SBPayment WHERE res_num='$resNum'");
        if ( mysqli_num_rows( $search ) < 1 ) {
            return false;
        }
        return mysql_fetch_assoc( $search );
    }

    protected function searchRefNum( $refNum )
    {
        $search = mysqli_query($this->connection, "select * FROM SBPayment WHERE ref_num = '$refNum'" );
        if ( mysqli_num_rows( $search ) < 1 ) {
            return false;
        }
        return mysql_fetch_assoc( $search );
    }

    protected function saveBankInfo( $payment )
    {
        $this->payment = $payment;
        return mysqli_query($this->connection, "UPDATE sbpayment SET ref_num = '$this->refNum' ,payment = '$payment' WHERE res_num = '$this->resNum'" ) or $this->setMsg(mysql_error());
    }

    public function saveStoreInfo( $totalAmont )
    {
        if( $totalAmont == '' ) {
            $this->setMsg( "Error: TotalAmont" );
            return false;
        }
        $time = time();
        $this->totalAmont = $totalAmont;
        $this->createResNum();
        return mysqli_query($this->connection, "INSERT INTO sbpayment SET res_num = '$this->resNum', total_amont = '$this->totalAmont', date_start = $time" ) or $this->setMsg(mysqli_error($this->connection));
    }

     public function receiverParams( $resNum = '' , $refNum = '' ,$state = '' )
    {
        if( ( empty($state) or empty($resNum) or strlen($refNum) != 20 ) or $state != 'OK' ) {
            if(isset($this->errorState[$state])) {
                $this->setMsg( 'state',$state );
            } else {
                $this->setMsg("error state");
            }
            return false;
        }

        $searchResNum = $this->searchResNum( $resNum );

        if( is_array( $searchResNum ) ) {
            if( $searchResNum['payment'] > 0) {
                $this->setMsg( "لطفا به قسمت رهگیری سفازش مراجعه کنید" );
                return false;
            }
        } else {
            $this->setMsg("همچین تراکنشی در سمت فروشنده تعریف نشده");
            return false;
        }

        $this->refNum     = $refNum;
        $this->resNum     = $resNum;
        $this->totalAmont = $searchResNum['total_amont'];

        return $this->lastCheck();
    }


    protected function lastCheck()
    {
        if( empty($this->resNum) or strlen($this->refNum) != 20 ) {
            $this->setMsg( "Error: resNum or refNum is empty" );
            return false;
        }
        //web method verify transaction
        $verify     = $this->verifyTrans();

        if( $verify > 0 ) {
            if( $verify == $this->totalAmont ) {

                $this->saveBankInfo( $verify );
                $this->setMsg("پرداخت با موفقیت انجام شد  لطفا کد رهگیری را یادداشت کنید");
                $this->setMsg( "$this->resNum"." : کد رهگیری " );
                return true;


            } elseif( $verify > $this->totalAmont ) {

                //web method partial reverse transaction
                $revAmont = $verify - $this->totalAmont;
                $reverse  = $this->reverseTrans( $revAmont );

                $this->setMsg("کاربر گرامی  مبلغ پرداختی بیش از مبلغ درخواستی است");
                if( $reverse == 1 ) {
                    $this->setMsg("مابقی مبلغ پرداخت شده به حساب شما برگشت خورده");
                    $this->saveBankInfo( $this->totalAmont );
                } else {
                    $this->setMsg( 'verify',$reverse );
                    $this->setMsg( "ما بقی مبلغ پرداختی شما در اینده ای نزدیک به حساب شما برگشت خواهد خورد " );
                    $this->saveBankInfo( $verify );
                }
                $this->setMsg("پرداخت با موفقیت انجام شد  لطفا کد رهگیری را یادداشت کنید");
                $this->setMsg( "$this->resNum"." : کد رهگیری " );
                return true;


            } elseif( $verify < $this->totalAmont ) {

                //web method full reverse transaction
                $rev     = $this->reverseTrans( $verify );
                $this->setMsg("مبلغ پرداختی شما کمتر از مباغ سفارش است ");
                if( $rev == 1 ) {
                    $this->setMsg("کل مبلغ پرداختی به حساب شما برگشت خورده");
                    $this->saveBankInfo( 0 );
                } else {
                    $this->setMsg("در اینده ای نزدیک کل مبلغ پرداختی به حساب شما برگشت خواهد خورد لطفا برای پی گیری کد رهگیری را یادداشت کنید");
                    $this->setMsg( "$this->resNum"." : کد رهگیری " );
                    $this->setMsg( 'verify',$rev );
                    $this->saveBankInfo( $verify );
                }
                return false;
            }
            //Error transaction
        } elseif ( $verify < 0 or $verify == false ) {
            $this->setMsg( "کاربر گرامی مشکلی در تایید  پرداخت پیش امده" );
            $this->setMsg( 'verify',$verify );
            $this->saveBankInfo( 0 );
            return false;
        }
    }
   protected function verifyTrans()
    {
        if(empty($this->refNum) or empty($this->merchantID) ) {
            return false;
        }
        $soapClient = new soapclient( $this->webMethodURL,'wsdl' );
        $soapProxy  = $soapClient->getProxy();
        $result     = false;

        for( $a=1;$a<6;++$a ) {
            $result  = $soapProxy->verifyTransaction( $this->refNum,$this->merchantID );
            if( $result != false ) {
                break;
            }
        }
        return $result;
    }

    protected function reverseTrans( $revNumber )
    {
        if( $revNumber <= 0 or empty($this->refNum) or empty($this->merchantID) or empty($this->password) ) {
            return false;
        }
        $soapClient = new soapclient( $this->webMethodURL,'wsdl' );
        $soapProxy  = $soapClient->getProxy();
        $result     = false;

        for( $a=1;$a<6;++$a ) {
            $result     = $soapProxy->reverseTransaction( $this->refNum,$this->merchantID,$this->password,$revNumber );
            if( $result != false )
                break;
        }
        return $result;
    }

    public function sendParams()
    {

        if ( $this->totalAmont <= 0 or empty($this->action) or empty($this->callbackURL) or empty($this->resNum) or empty($this->merchantID) ) {
            $this->setMsg( "Error: function sendParams()" );
            return false;
        }
        $form  = "<html>";
        $form .= "<body onLoad=\"document.forms['sendparams'].submit();\" >";
        $form .= "<form name=\"sendparams\" method=\"POST\" action=\"$this->action\" enctype=\"application/x-www-form-urlencoded\" >\n";
        foreach ( $this->style as $key=>$val ) {
            if( $val != '' ) {
                $form .= "<input type=\"hidden\" name=\"$key\" value=\"$val\" />\n";
            }
        }
        $form .= "<input type=\"hidden\" name=\"Amount\" value=\"$this->totalAmont\" />\n";
        $form .= "<input type=\"hidden\" name=\"ResNum\" value=\"$this->resNum\" />\n";
        $form .= "<input type=\"hidden\" name=\"MID\" value=\"$this->merchantID\" />\n";
        $form .= "<input type=\"hidden\" name=\"callbackURL\" value=\"$this->callbackURL\" />\n";
        $form .= "</form>";
        $form .= "</body>";
        $form .= "</html>";

        print $form;
    }

    protected function setMsg($type='',$index='')
    {
        if ( $type == 'state' and isset( $this->errorState[$index] ) ) {
            $this->msg[] = $this->errorState[$index];

        } elseif( $type == 'verify' and isset($this->errorVerify[$index]) ) {
            $this->msg[] = $this->errorVerify[$index];

        } elseif( $type != 'verify' and $type != 'state') {
            $this->msg[] = "$type";
        }
    }

    public function getMsg($dis='')
    {
        if( count($this->msg) == 0 ) return array();
        if( $dis == 'display' ) {
            $msg  = "<ul>\n";
            foreach ( $this->msg as $v ) { $msg .= "<li> $v </li>\n"; }
            $msg .= "</ul>\n";
            return print $msg;
        }
        return $this->msg;
    }
}


?>