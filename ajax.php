<?php

class Ajax
{
    public static function getUserIp(): string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        
        return $ip;
    }
    
    public static function getRenderText(string $text): string
    {
        if(strlen($text) > 10) {
            $result = preg_replace("/([A-ZА-Я])/", '', $_REQUEST['text']);
        }
        if(strlen($_REQUEST['text']) < 10) 
        {
            $result = preg_replace("/([^a-zа-я0-9])/", '', $_REQUEST['text']);
        }
        return $result;
    }

    public static function setLog(array $data): void
    {
        @file_put_contents(__DIR__ . '/req.log', print_r(json_encode($data), true), FILE_APPEND);
    }

    public static function run()
    {
        $userIp = self::getUserIp();
        $formatedText = self::getRenderText($_REQUEST['text']);
        $data = [
            'userIp' => $userIp,
            'date' => date('Y-m-d H:i:s'),
            'text' => $_REQUEST['text'],
            'formated' => $formatedText
        ];
        self::setLog($data);

        return implode('<br>', [
            "IP: {$userIp}",
            "Дата: {$data['date']}",
            "Входной текст: {$data['text']}",
            "Форматированный текст: {$data['formated']}"
        ]);
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    die(Ajax::run());
}
else
{
    http_response_code(405);
}
?>