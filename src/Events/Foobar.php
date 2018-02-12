<?php

namespace ErsoyInsider\NewrelicCustomEvent\Events;

class Foobar {

    /**
     * @return string
     */
    public function invalid_method()
    {

    }

    /**
     * @return int
     */
    public function anotherInvalidMethod(){

        if(true){
            return [];
        }else if(false) {
            return '';
        }

        return 21;
    }

}
