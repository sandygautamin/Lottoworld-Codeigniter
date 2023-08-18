<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User Management class created by CodexWorld
 */
class Discounts extends APP_Controller {

    private $period, $lotteryName, $type;
    private $discounts = array(
        'BonoLoto' => array(
            'single' => array(
                1 => 2,
                2 => 7,
                4 => 10,
            ),
            'group' => array(
                1 => 2,
                2 => 7,
                4 => 10,
            ),
        ),
        'SuperEnalotto' => array(
            'single' => array(
                1 => 0,
                2 => 2,
                4 => 7,
            ),
            'group' => array(
                1 => 0,
                2 => 2,
                4 => 7,
            ),
        ),
        'ElGordo' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'EuroJackpot' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'PowerBall' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'LaPrimitiva' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'MegaMillions' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'Lotto649' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'UkLotto' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'NewYorkLotto' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'OzLotto' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'EuroMillions' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
    );
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('global');
        $this->load->library('cart');
        $this->load->model("payment");
        
    }

    public function setPeriod($period){
        $this->period = $period;
    }

    public function setLotteryName($name){
        $this->lotteryName = $name;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function getDiscount(){
        $discount = $this->discounts[$this->lotteryName][$this->type][$this->period];
        return ($discount > 0) ? $this->period . ' '.__('week', 'twentythirteen').' ' . $discount . '% '.__('discount', 'twentythirteen').'' : $this->period . ' '.__('week', 'twentythirteen').'';
    }
}



