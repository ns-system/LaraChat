<?php

//require "vendor/autoload.php";

namespace App\Services\Payment;

class Payment {

    protected $price;
    protected $quantity;
    protected $money;
    protected $option;
//    protected $change;
    protected $amount;

    public function setPrice($price = 0) {
        $this->price = $price;
        return $this;
    }

    public function setQuantity($quantity = 0) {
        $this->quantity = $quantity;
        return $this;
    }

    public function setOption($option = []) {
        $this->option = $option;
        return $this;
    }

    public function setMoney($money) {
        $this->money = $money;
        return $this;
    }

    public function getAmount() {
        $amount = $this->price * $this->quantity;
        foreach ($this->option as $key => $val) {
            if ($key === 'tax') {
                $amount = ceil($amount * $val);
            }
            if ($key === 'discount') {
                $amount -= $val;
            }
        }
        $this->amount = $amount;
        return $this;
    }

    private function canPayment() {
        if ($this->money - $this->amount < 0) {
            return false;
        } else {
            return true;
        }
    }

    public function cashPay() {
        if ($this->canPayment()) {
            $change = $this->money - $this->amount;
            return "現金で{$this->amount}円を支払いました。\n残金は{$change}円です。";
        } else {
            return "現金で{$this->amount}円を払うことができませんでした。";
        }
    }

    public function cardPay() {
        return "カードで{$this->amount}円を支払いました。";
    }

}
