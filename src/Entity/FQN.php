<?php

namespace Entity;

class FQN {

    public function __construct($namespace = ""){
        if($namespace){
            if(!is_array($namespace)){
                $this->parts = explode("\\", $namespace);
            }
            else{
                $this->parts = $namespace;
            }
        }
        else {
            $this->parts = [];
        }
    }
    public function join(FQN $join){
        $result = new self();
        $resultParts = $this->getParts();
        $joiningParts = $join->getParts();
        if($this->getLast() === $join->getFirst()){
            array_shift($joiningParts);
        }
        $result->setParts(array_merge($resultParts, $joiningParts));
        return $result;
    }
    public function getFirst(){
        $parts = $this->getParts();
        return array_shift($parts);
    }
    public function getLast(){
        $parts = $this->getParts();
        return array_pop($parts);
    }
    public function getParts(){
        if(is_array($this->parts)){
            return $this->parts;
        }
        return [];
    }
    public function setParts(array $parts){
        $this->parts = $parts;
    }
    public function addPart($part){
        $this->parts[] = $part;
    }
    public function toString(){
        return implode("\\", $this->getParts());
    }
    public function __toString(){
        return $this->toString();
    }

    private $parts;
}