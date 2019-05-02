<?php 

$string = 'Пароль: 5885<br />
Спишется 402,02р.<br />
Перевод на счет 41001901865740';

require('Payment.php');
$payment = new Payment($string);

// Check errors
if(!$payment->hasErrors()){

    // return value
    var_dump(
        $payment->getCost(),
        $payment->getCode(),
        $payment->getWallet()
    );
}
