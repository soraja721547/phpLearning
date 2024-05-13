<?php 

if (!function_exists('data_get')){
    function data_get(
        mixed $target, 
        array|string|int|null $key,
        mixed $default = null){
    
        if (is_null($target)){
            return $target;
        }
    
        $exploded = is_array($key) ? $key : explode('.', $key);

        while (true){
            $keyShift = array_shift($exploded);
    
            if (is_null($keyShift)){
                break;
            }
            if (is_array($target) && array_key_exists($keyShift, $target)){
                $target = $target[$keyShift];

            } elseif (is_object($target) && property_exists($target, $keyShift)){
                $target = $target -> {$keyShift};
            
            } else {
                return $default;
            }
        }
        return $target;
    }
}

if (!function_exists('base_path')){
    function base_path(string $path = ''){
        return __DIR__.DIRECTORY_SEPARATOR.ltrim($path, '/\\');
    }
}

if (!function_exists('get_request_query')){
    function get_request_query(
        ?string $key = null,
        mixed $default = null
    ):mixed{
        return data_get($_GET, $key, $default);
    }
}


if (!function_exists('get_request_post')){
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

if (!function_exists('get_request_input')){
    function get_request_input(
        ?string $key = null,
        mixed $default = null
    ):mixed{
        $data = get_request_post() + get_request_query();

        return data_get($data, $key, $default);
    }
}

if (!function_exists('get_request_file')){
    function get_request_file(
        ?string $key = null,
        mixed $default = null
    ): ?array {
        return data_get($_FILES, $key, $default);
    }
}

if (!function_exists('get_request_all')){
    function get_request_all(
        ?string $key = null,
        mixed $default = null
    ): ?array {
        $data = get_request_input() + get_request_file();

        return data_get($data, $key, $default);
    }
}
?>