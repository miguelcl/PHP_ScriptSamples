<?php
if (isset($_GET['source']))
{
    highlight_file($_SERVER['SCRIPT_FILENAME']);
    exit;
}
$maxNumMB = 1048576;
$defNumMB = 1024;
if (!isset($_GET['numMB']) || intval($_GET['numMB']) > $maxNumMB)
{
    header("Location: http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}?numMB=$defNumMB");
    exit;
}
$numMB = intval($_GET['numMB']);
?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Speed Test</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
    <!--
    html
    {
        font-family: sans-serif;
        color: #000;
        background: #fff;
    }
    *
    {
        font-size: medium;
    }
    #wait
    {
        border-bottom: thin dotted black;
    }
    #wait abbr
    {
        border: none;
    }
    #done
    {
        font-weight: bold;
    }
    #benchmark
    {
        padding: 1em;
        border: 1px solid black;
        background: #ffe;
        color: #000;
    }
    //-->
      </style>
</head>
<body>
<div id="benchmark">
<p>
<form action="">
<input type="radio" name="numMB" value="1024">1 MB <BR>
<input type="radio" name="numMB" value="10240" >10   MB <BR>
<input type="radio" name="numMB" value="51200">50  MB <BR>
<input type="radio" name="numMB" value="102400">100 MB <BR>
<input type="radio" name="numMB" value="153600">150 MB <BR>
<input type="radio" name="numMB" value="204800">200 MB <BR>
<input type="submit" value="Test">
</form>
</p>
</div>
<div id="benchmark">
<p>
    Este script envia <?php echo $numMB; ?> <abbr title="Megabyte">KB</abbr>
    de comentarios HTML al navegador, midiendo el tiempo que este HTML es descargado, se calcula la velocidad de descarga total.
</p>
</div>
<h1>Please Wait</h1>
<p id="wait">
    Transfiriendo <?php echo $numMB/1024; ?> <abbr title="Megabyte">MB</abbr>
</p>
<!--
<?php
function getmicrotime()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
flush();
$timeStart = getmicrotime();
$nlLength = strlen("\n");
for ($i = 0; $i < $numMB; $i++)
{
    echo str_pad('', 1024 - $nlLength, '####') . "\n";
    flush();
}
$timeEnd = getmicrotime();
$timeDiff = round($timeEnd - $timeStart, 3);
?>
-->
<p id="done">
  <?php
        echo "Transferidos: {$numMB } <abbr title=\"Megabyte\">KB</abbr> en {$timeDiff} segundos, " .
             ($timeDiff <= 1 ?  round( $numMB/$timeDiff, 3) : round( (($numMB/$timeDiff)/1024), 3)) .
             ' <abbr title="MegaBytes por segundo">MB/s (multiplicar por 8 para calcular Mbits/s)</abbr>';
    ?>
</p>
</body>
</html>
