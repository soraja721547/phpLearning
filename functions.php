<?php 

if(!function_exists('data_get')){
    function data_get(
        mixed $target, 
        array|string|int|null $key,
        mixed $default = null){
    
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
}

if(!function_exists('base_path')){
    function base_path(string $path = ''){
        return __DIR__.DIRECTORY_SEPARATOR.ltrim($path, '/\\');
    }
}

if(!function_exists('get_request_query')){
    function get_request_query(
        ?string $key = null,
        mixed $default = null
    ):mixed{
        return data_get($_GET, $key, $default);
    }
}


if(!function_exists('get_request_post')){
    function get_request_post(
        ?string $key = null,
        mixed $default = null
    ):mixed{
        $data = str_contains(data_get($_SERVER, 'CONTENT_TYPE', ''), 'json')
            ? json_decode(file_get_contents('php://input'),true)
            : $_POST;
        
        return data_get($data, $key, $default);
    }
}

if(!function_exists('get_request_input')){
    function get_request_input(
        ?string $key = null,
        mixed $default = null
    ):mixed{
        $data = get_request_post() + get_request_query();

        return data_get($data, $key, $default);
    }
}

if(!function_exists('get_request_file')){
    function get_request_file(
        ?string $key = null,
        mixed $default = null
    ): ?array {
        return data_get($_FILES, $key, $default);
    }
}

if(!function_exists('get_request_all')){
    function get_request_all(
        ?string $key = null,
        mixed $default = null
    ): ?array {
        $data = get_request_input() + get_request_file();

        return data_get($data, $key, $default);
    }
}
?>