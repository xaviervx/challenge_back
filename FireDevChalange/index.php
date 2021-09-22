<?php
    header('Content-Type: aplication/json');

    require_once './vendor/autoload.php';

    if (ISSET($_REQUEST['url']))
    {
        $url = explode('/', $_REQUEST['url']);

        if ($url[0] === 'api')
        {
            array_shift($url);
            $controler = 'FireDevChalange\Controle\\'.ucfirst($url[0]).'Controle';

            array_shift($url);
            $method = mb_strtolower($_SERVER['REQUEST_METHOD']);

            try {
                $reponse = call_user_func_array(array(new $controler, $method), $url);

                echo json_encode(array('status' => 'sucess', 'data' => $reponse), JSON_UNESCAPED_UNICODE);
            }
            catch (Exception $ex)
            {
                echo json_encode(array('statur' => 'error', 'data' => $ex->getMessage()), JSON_UNESCAPED_UNICODE);
            }
        }
    }