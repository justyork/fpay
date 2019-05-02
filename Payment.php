<?

/**
 * Class Payment
 */
class Payment
{
    private $paymentString;
    private $errors = [];

    private $cost = null;
    private $wallet = null;
    private $code = null;

    private $reg_cost = '~([\d]+[,][\d]{2})~';
    private $reg_wallet = '~([\d]{14})~';
    private $reg_code = '~([\d]{4})~';

    /**
     * Payment constructor.
     * @param $inputPaymentString
     */
    public function __construct($inputPaymentString)
    {
        $this->paymentString = $inputPaymentString;
        $this->executePaymentString();
    }

    /** Return cost
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /** Return wallet
     * @return mixed
     */
    public function getWallet()
    {
        return $this->wallet;
    }

    /** Return code
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /** Check errors while execute
     * @return bool
     */
    public function hasErrors()
    {
        return !empty($this->errors);
    }

    /**
     * Find all data from string
     */
    private function executePaymentString()
    {
        $this->findCode();
        $this->findCost();
        $this->findWallet();
    }

    /** Add new error
     * @param $string
     */
    private function addError($string)
    {
        $this->errors[] = $string;
    }

    /**
     * Find code or add error
     */
    private function findCode()
    {
        if ($val = $this->executeReg($this->reg_code, $this->paymentString))
            $this->code = $val;
        else $this->addError("Can't find code");
    }

    /**
     * Find cost or add error
     */
    private function findCost()
    {
        if ($val = $this->executeReg($this->reg_cost, $this->paymentString))
            $this->cost = $val;
        else $this->addError("Can't find cost");
    }

    /**
     * Find number of wallet or add error
     */
    private function findWallet()
    {
        if ($val = $this->executeReg($this->reg_wallet, $this->paymentString))
            $this->wallet = $val;
        else $this->addError("Can't find wallet");
    }

    /**
     * @param $reg
     * @param $string
     * @return bool|mixed
     */
    private function executeReg($reg, $string)
    {
        preg_match($reg, $string, $m);
        if (!isset($m[1])) return false;
        return $m[1];
    }
}
