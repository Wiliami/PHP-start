<?php 

class DelRey extends Automovel {

    public $velocidade;

    public function empurrar($velocidade) {
        $this->velocidade = $velocidade;
    }
}
?>