<?php 

//---------------目標陣列,要找的Key,找不到時返回
function data_get($target, $key, $default){

    if(is_null($target) || is_null($key)){
        return $target;
    }

    while(1){
        $keySplit = explode('.', (string)$key);
        $keyShift = array_shift($keySplit);
        $key = implode('.', (array)$keySplit);

        if(!empty($keyShift)){

            if(!array_key_exists($keyShift, (array)$target)){
                return $default;
            }else{
                $target = $target[$keyShift];
            }
        }else{
            break;
        }
    }
    return $target;
}

?>