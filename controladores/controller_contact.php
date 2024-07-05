<?php

class ContactMail {

    private $content;
    private $asunto;
    private $to;
    private $from;

    public function setContent($c){
        $this->content = $c;
    }
    public function setAsunto($a){
        $this->asunto = $a;
    }
    public function setTo($t){
        $this->to = $t;
    }
    public function setFrom($f){
        $this->from = 'From: <' . $f . '>';
    }

    public function SendMail(){
        mail($this->to,$this->asunto,$this->content,$this->from);
    }

    public function GenerarContenido($name, $telefono, $message){
        return "Nombre: " . $name ."\nTelefono: ". $telefono . "\nMensaje: " . $message . "";
    }
}

?>