
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function sendMessage($chatID, $messaggio) {
    echo "sending message to " . $chatID . "\n";

    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function sendMessageGrupo($messaggio,$novo = true, $editar = false, $fechado = false) {
    $token = '725914784:AAF1v_LmsVaaIKibK4N4jXK2Q-40h1Gh5Uw';
    $chatID = '-197473256';
    $chatID = '16050596';

    if($novo){
        $messaggio = $messaggio;
    }

    if($editar){
        $messaggio = '<code>'.$messaggio.'</code>';
    }

    if($fechado){
        $messaggio = '<b>'.$messaggio.'</b>';
    }

    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID."&parse_mode=html";
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function sendMessageGrupoInterno($messaggio,$novo = true, $editar = false, $fechado = false) {
    $token = '656447903:AAFjwmCmaHYwEfYQ_kDi-0dou5MP7ldUHaU';
    $chatID = '-304576409';
    $chatID = '16050596';
    if($novo){
        $messaggio = $messaggio;
    }

    if($editar){
        $messaggio = '<code>'.$messaggio.'</code>';
    }

    if($fechado){
        $messaggio = '<b>'.$messaggio.'</b>';
    }
    
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID."&parse_mode=html";
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}