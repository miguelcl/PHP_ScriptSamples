<?php
$apiUrl = 'http://mindicador.cl/api';
//Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
if ( ini_get('allow_url_fopen') ) {
    $json = file_get_contents($apiUrl);
} else {
    //De otra forma utilizamos cURL
    $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    curl_close($curl);
}

$dailyIndicators = json_decode($json);
echo '<br>El valor actual de la UF es $' . $dailyIndicators->uf->valor;
echo '<br>El valor actual del Dólar observado es $' . $dailyIndicators->dolar->valor;
echo '<br>El valor actual del Dólar acuerdo es $' . $dailyIndicators->dolar_intercambio->valor;
echo '<br>El valor actual del Euro es $' . $dailyIndicators->euro->valor;
echo '<br>El valor actual del IPC es ' . $dailyIndicators->ipc->valor;
echo '<br>El valor actual de la UTM es $' . $dailyIndicators->utm->valor;
echo '<br>El valor actual del IVP es $' . $dailyIndicators->ivp->valor;
echo '<br>El valor actual del Imacec es ' . $dailyIndicators->imacec->valor;
?>
