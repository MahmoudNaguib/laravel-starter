<?php

use Intervention\Image\Facades\Image;


function ValidateRequestApi($request, $rules) {
    $validator = validator()->make($request, $rules);
    if ($validator->fails()) {
        throw new \App\Exceptions\ValidationApiException(json_encode(transformValidation($validator->errors()->messages())));
    }
}

function transformValidation($errors) {
    $temp = [];
    if ($errors) {
        foreach ($errors as $key => $value) {
            $temp[$key] = (is_array(@$value)) ? implode(', ', $value) : $value;
        }
    }
    return $temp;
}


function appVersion() {
    $json = json_decode(@file_get_contents(public_path() . '/version.json'));
    return number_format(@$json->version, 2);
}

function RandomString($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randstring = '';
    for ($i = 0; $i < $n; $i++) {
        $randstring .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randstring;
}

function configureUploads() {
    $uploads = public_path() . '/uploads';
    if (!File::isDirectory($uploads)) {
        File::makeDirectory($uploads, 0777, true, true);
    }
    $small = $uploads . '/small';
    if (!File::isDirectory($small)) {
        File::makeDirectory($small, 0777, true, true);
    }
    $large = $uploads . '/large';
    if (!File::isDirectory($large)) {
        File::makeDirectory($large, 0777, true, true);
    }
}

function token() {
    $token = request('token') ?: (request()->header('Authorization') ?: request()->header('token'));
    if ($token) {
        $token = str_replace('Bearer ', '', $token);
    }
    return $token;
}

function generateToken($email) {
    return md5(RandomString(10)) . md5(time()) . md5($email) . md5(RandomString(10));
}

function resizeImage($image, $sizes = ['large' => 'resize,300x300', 'small' => 'crop,150x120']) {
    $fileName = pathinfo($image)['basename'];
    $random = strtolower(str_random(10)) . time();
    foreach ($sizes as $key => $size) {
        $image = \Image::make($image);
        $newFileName = $random . '.' . $image->extension;
        if (app()->environment() != 'testing') {
            $uploadsPath = public_path() . '/uploads/' . $key . '/' . $newFileName;
            $size = explode(',', $size);
            $type = $size[0];
            $dimensions = (isset($size[1])) ? $size[1] : '200x200';
            $dimensions = explode('x', $dimensions);
            if ($type == 'crop') {
                $image->fit($dimensions[0], $dimensions[1]);
            } else {
                $image->resize($dimensions[0], $dimensions[1], function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image->save($uploadsPath, 90);
        }
    }
    return $newFileName;
}

function getConfigsPairs() {
    $arr = [];
    if (\Schema::hasTable('configs')) {
        $configs = \App\Models\Config::get();
        if ($configs) {
            foreach ($configs as $c) {
                $arr[$c->field] = $c->value;
            }
        }
    }
    return $arr;
}

function getConfigs() {
    if (\Cache::has('configs')) {
        return \Cache::get('configs');
    } else {
        if (\Schema::hasTable('configs')) {
            $configs = \App\Models\Config::get();
            $arr = [];
            if ($configs) {
                foreach ($configs as $c) {
                    $key = $c->field;
                    $arr[$key] = $c->value;
                }
            }
            \Cache::put('configs', $arr, env('CACHE_TIME', 24 * 60 * 60));
            return \Cache::get('configs');
        }
    }
}

function conf($field) {
    return @getConfigs()[$field];
}

function appName() {
    $configs = getConfigs();
    $appName = (@$configs['app_name']) ?: env('APP_NAME');
    return $appName;
}

function lang() {
    return \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
}

function langs() {
    $languages = (array_keys(config('laravellocalization.supportedLocales'))) ?: [];
    return $languages;
}

function setlang() {
    $locale = (request()->segment(2));
    $supportedLocales = langs();
    if (!in_array($locale, $supportedLocales)) {
        $locale = config('app.fallback_locale');
    }
    app()->setLocale($locale);
    return $locale;
}

function getMainTranslations($filename) {
    $mainKeys = @include resource_path() . '/lang/en/' . $filename . '.php';
    $mainKeys = array_keys($mainKeys);
    foreach (langs() as $lang) {
        $records[$lang] = @include resource_path() . '/lang/' . $lang . '/' . $filename . '.php';
    }
    $rows = [];
    if ($mainKeys) {
        foreach ($mainKeys as $key) {
            if ($key != '0') {
                $row = [];
                foreach (langs() as $lang) {
                    $row[$lang] = $records[$lang][$key];
                }
                $rows[$key] = $row;
            }
        }
    }
    return $rows;
}

function slug($str, $options = array()) {
    // Make sure string is in UTF-8 and strip invalid UTF-8 characters
    $str = mb_convert_encoding((string)$str, 'UTF-8');
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => false,
    );
    // Merge options
    $options = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A',
        '??' => 'AE', '??' => 'C',
        '??' => 'E', '??' => 'E', '??' => 'E', '??' => 'E', '??' => 'I', '??' => 'I',
        '??' => 'I', '??' => 'I',
        '??' => 'D', '??' => 'N', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O',
        '??' => 'O', '??' => 'O',
        '??' => 'O', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'U',
        '??' => 'Y', '??' => 'TH',
        '??' => 'ss',
        '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a',
        '??' => 'ae', '??' => 'c',
        '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'i', '??' => 'i',
        '??' => 'i', '??' => 'i',
        '??' => 'd', '??' => 'n', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o',
        '??' => 'o', '??' => 'o',
        '??' => 'o', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u',
        '??' => 'y', '??' => 'th',
        '??' => 'y',
        // Latin symbols
        '??' => '(c)',
        // Greek
        '??' => 'A', '??' => 'B', '??' => 'G', '??' => 'D', '??' => 'E', '??' => 'Z',
        '??' => 'H', '??' => '8',
        '??' => 'I', '??' => 'K', '??' => 'L', '??' => 'M', '??' => 'N', '??' => '3',
        '??' => 'O', '??' => 'P',
        '??' => 'R', '??' => 'S', '??' => 'T', '??' => 'Y', '??' => 'F', '??' => 'X',
        '??' => 'PS', '??' => 'W',
        '??' => 'A', '??' => 'E', '??' => 'I', '??' => 'O', '??' => 'Y', '??' => 'H',
        '??' => 'W', '??' => 'I',
        '??' => 'Y',
        '??' => 'a', '??' => 'b', '??' => 'g', '??' => 'd', '??' => 'e', '??' => 'z',
        '??' => 'h', '??' => '8',
        '??' => 'i', '??' => 'k', '??' => 'l', '??' => 'm', '??' => 'n', '??' => '3',
        '??' => 'o', '??' => 'p',
        '??' => 'r', '??' => 's', '??' => 't', '??' => 'y', '??' => 'f', '??' => 'x',
        '??' => 'ps', '??' => 'w',
        '??' => 'a', '??' => 'e', '??' => 'i', '??' => 'o', '??' => 'y', '??' => 'h',
        '??' => 'w', '??' => 's',
        '??' => 'i', '??' => 'y', '??' => 'y', '??' => 'i',
        // Turkish
        '??' => 'S', '??' => 'I', '??' => 'C', '??' => 'U', '??' => 'O', '??' => 'G',
        '??' => 's', '??' => 'i', '??' => 'c', '??' => 'u', '??' => 'o', '??' => 'g',
        // Russian
        '??' => 'A', '??' => 'B', '??' => 'V', '??' => 'G', '??' => 'D', '??' => 'E',
        '??' => 'Yo', '??' => 'Zh',
        '??' => 'Z', '??' => 'I', '??' => 'J', '??' => 'K', '??' => 'L', '??' => 'M',
        '??' => 'N', '??' => 'O',
        '??' => 'P', '??' => 'R', '??' => 'S', '??' => 'T', '??' => 'U', '??' => 'F',
        '??' => 'H', '??' => 'C',
        '??' => 'Ch', '??' => 'Sh', '??' => 'Sh', '??' => '', '??' => 'Y', '??' => '',
        '??' => 'E', '??' => 'Yu',
        '??' => 'Ya',
        '??' => 'a', '??' => 'b', '??' => 'v', '??' => 'g', '??' => 'd', '??' => 'e',
        '??' => 'yo', '??' => 'zh',
        '??' => 'z', '??' => 'i', '??' => 'j', '??' => 'k', '??' => 'l', '??' => 'm',
        '??' => 'n', '??' => 'o',
        '??' => 'p', '??' => 'r', '??' => 's', '??' => 't', '??' => 'u', '??' => 'f',
        '??' => 'h', '??' => 'c',
        '??' => 'ch', '??' => 'sh', '??' => 'sh', '??' => '', '??' => 'y', '??' => '',
        '??' => 'e', '??' => 'yu',
        '??' => 'ya',
        // Ukrainian
        '??' => 'Ye', '??' => 'I', '??' => 'Yi', '??' => 'G',
        '??' => 'ye', '??' => 'i', '??' => 'yi', '??' => 'g',
        // Czech
        '??' => 'C', '??' => 'D', '??' => 'E', '??' => 'N', '??' => 'R', '??' => 'S',
        '??' => 'T', '??' => 'U',
        '??' => 'Z',
        '??' => 'c', '??' => 'd', '??' => 'e', '??' => 'n', '??' => 'r', '??' => 's',
        '??' => 't', '??' => 'u',
        '??' => 'z',
        // Polish
        '??' => 'A', '??' => 'C', '??' => 'e', '??' => 'L', '??' => 'N', '??' => 'o',
        '??' => 'S', '??' => 'Z',
        '??' => 'Z',
        '??' => 'a', '??' => 'c', '??' => 'e', '??' => 'l', '??' => 'n', '??' => 'o',
        '??' => 's', '??' => 'z',
        '??' => 'z',
        // Latvian
        '??' => 'A', '??' => 'C', '??' => 'E', '??' => 'G', '??' => 'i', '??' => 'k',
        '??' => 'L', '??' => 'N',
        '??' => 'S', '??' => 'u', '??' => 'Z',
        '??' => 'a', '??' => 'c', '??' => 'e', '??' => 'g', '??' => 'i', '??' => 'k',
        '??' => 'l', '??' => 'n',
        '??' => 's', '??' => 'u', '??' => 'z'
    );
    // Make custom replacements
    $str = preg_replace(
        array_keys($options['replacements']), $options['replacements'], $str
    );
    // Transliterate characters to ASCII
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    // Replace non-alphanumeric characters with our delimiter
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    // Remove duplicate delimiters
    $str = preg_replace(
        '/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str
    );
    // Truncate slug to max. characters
    $str = mb_substr(
        $str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8'
    );
    // Remove delimiter from ends
    $str = trim($str, $options['delimiter']);

    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function sendPushNotifications($tokens, $title, $body, $data) {
    dump('Sending push inside the function');
    $data = array_merge(['title' => $title, 'body' => $body], $data);
    $FCM_SERVER_KEY = env('FCM_SERVER_KEY');
    if ($FCM_SERVER_KEY) {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $tokens = (!is_array($tokens)) ? [$tokens] : $tokens;
        dump('Sending push notification to (' . implode(',', $tokens) . ')');
        $fields = [
            'notification' => [
                "content_available" => true,
                "sound" => "default",
                'title' => str_limit($title, 25),
                "body" => $body,
            ],
            'data' => $data,//['id'=>$id,'type'=>$type]
            "registration_ids" => $tokens
        ];
        $headers = [
            'Authorization: key=' . $FCM_SERVER_KEY, 'Content-Type: application/json'
        ];
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);
            $logMessage = 'Push notification : to tokens (' . implode(', ', $tokens) . '), Result: ' . $result . PHP_EOL;
            dump($logMessage);
            \Log::debug($logMessage);
        } catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage() . ', File: ' . $e->getFile() . ', Line:' . $e->getLine() . PHP_EOL);
        }
    }
}

function urlLang($url, $fromlang, $toLang) {
    $currentUrl = str_replace('/' . $fromlang, '/' . $toLang, strtolower($url));
    return $currentUrl;
}

function languages() {
    $languages = config('laravellocalization.supportedLocales');
    $langs = [];
    foreach ($languages as $key => $value) {
        $langs[$key] = trans('languages.' . $value['name']);
    }
    return $langs;
}

function image($img, $size = '', $attributes = Null) {
    $path = 'uploads/' . $size;
    $src = app()->make("url")->to('/') . '/' . $path . '/' . $img;
    if (!file_exists(public_path() . '/' . $path . '/' . $img) || !$img) {
        $src = '/img/placeholder.png';
    }
    $others = '';
    if ($attributes) {
        foreach ($attributes as $key => $value) {
            $others .= $key . '="' . $value . '"';
        }
    }
    return '<img src="' . $src . '" ' . $others . '>';
}

function video($video, $attributes = Null) {
    if (!$video)
        return '';
    if (!$attributes) {
        $attributes = ['width' => 160, 'height' => 120];
    }
    $src = 'uploads/' . $video;
    return '<div class="videoPlayer">
                    <div class="embed-responsive embed-responsive-16by9">
                        <video width="' . $attributes['width'] . '" height="' . $attributes['height'] . '" controls>
                            <source src="' . $src . '" type="video/mp4">
                        </video>
                    </div>
                </div>';
}

function fileRender($file) {
    if (!$file)
        return '';
    $path = 'uploads/' . $file;
    if (!$file || !file_exists($path)) {
        return '&nbsp;-----';
    }
    return '<i class="fa fa-paperclip"></i>
        <a href="uploads/' . $file . '" >' . str_limit($file, 10) . '</a>';
}
