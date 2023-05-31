<?php 

class Rilevazione{
    private $id;
    private $data;
    private $tempOut;
    private $bar;
    private $outHum;
    private $direzioneVento;
    private $intensitaVento;

    public function __construct(int $id=-1,DateTime $data,int $tempOut,float $bar,float $outHum,string $direzioneVento,int $intensitaVento){
        $this->id = $id;
        $this->data = $data;
        $this->tempOut = $tempOut;
        $this->bar = $bar;
        $this->outHum = $outHum;
        $this->direzioneVento = $direzioneVento;
        $this->intensitaVento = $intensitaVento;
    }

    public function getId(){
        return $this->id;
    }

    public function getData(){
        return $this->data;
    }

    public function getTempOut(){
        return $this->tempOut;
    }

    public function getBar(){
        return $this->bar;
    }

    public function getOutHum(){
        return $this->outHum;
    }

    public function getDirezioneVento(){
        return $this->direzioneVento;
    }

    public function getIntensitaVento(){
        return $this->intensitaVento;
    }
}

?>