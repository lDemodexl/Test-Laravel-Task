<?php

$str = '({[]})';

$check = new Brackets();
$check->set_string($str);
$check->validate();

class Brackets{
    public $string = '';
    protected $open_bracets = array('(', '{', '[');
    protected $close_bracets = array(')', '}', ']');

    //set string to class variable
    public function set_string($str){
        $this->$string = $str;
    }

    public function validate_string(){
        if( preg_match('/[^(\()^(\))^(\{)^(\})^(\[)^(\])]/', $this->$string) > 0){
           return false;
        }
        return true;
    }

    public function validate_open_count(){
        $opend = 0;
        foreach( $this->open_bracets as $bracet ){
            $opend += substr_count($this->$string, $bracet);
        }
        return $opend;
    }

    public function validate_order(){
        $opend = array();
        $array_str = str_split($this->$string);

        foreach( $array_str as $character ){
            if( in_array($character, $this->open_bracets) ){
                array_push($opend, $character);
            }else{
                if(count($opend) > 0){
                    switch ($character){
                        case ')':
                            if( array_pop($opend) != '(' ){
                                return false;
                            }
                            break;
                        case '}':
                            if( array_pop($opend) != '{' ){
                                return false;
                            }
                            break;
                        case ']':
                            if( array_pop($opend) != '[' ){
                                return false;
                            }
                            break;
                    }
                }else{
                    return false;
                }
            }
        }
        return true;
    }

    public function validate(){

        if ( !$this->validate_string() ){
            die('Invalid string');
        }else{

            if( $this->validate_open_count() > 12 ){
                die('Too many opend bracets');
            }else{
                if ( !$this->validate_order() ){
                    die('Failure');
                }else{
                    die('Success');
                }
            }

        }


    }
}
?>
