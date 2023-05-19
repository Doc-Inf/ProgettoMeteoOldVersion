<?php 

class Rilevazione{
    private $id;
    private $data;
    private $temperatura;
    private $pressione;
    private $umidita;
    private $direzioneVento;
    private $intensitaVento;

    public function __construct(int $id=-1,DateTime $data,int $temperatura,float $pressione,float $umidita,string $direzioneVento,int $intensitaVento){
        $this->id = $id;
        $this->data = $data;
        $this->temperatura = $temperatura;
        $this->pressione = $pressione;
        $this->umidita = $umidita;
        $this->direzioneVento = $direzioneVento;
        $this->intensitaVento = $intensitaVento;
    }

    public function getId(){
        return $this->id;
    }

    public function getData(){
        return $this->data;
    }

    public function getTemperatura(){
        return $this->temperatura;
    }

    public function getPressione(){
        return $this->pressione;
    }

    public function getUmidita(){
        return $this->umidita;
    }

    public function getDirezioneVento(){
        return $this->direzioneVento;
    }

    public function getIntensitaVento(){
        return $this->intensitaVento;
    }
}

?>