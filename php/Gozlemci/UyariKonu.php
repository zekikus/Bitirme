<?php
	
    abstract class UyariKonu{

    	public $gozlemciler = array();

    	public function ekle(Gozlemci $gozlemci){
    		$this -> gozlemciler[] = $gozlemci;
    	}

    	public function uyariGonder(){
    		foreach ($this -> gozlemciler as $gozlemci) {
    			$gozlemci -> Update();
    		}
    	}

	}

?>