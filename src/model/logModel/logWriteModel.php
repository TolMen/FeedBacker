<?php

/*
- Cette classe inclut la fonction qui écrit un message donné dans un fichier de log spécifié
- This class includes the function that writes a given message to a specified log file
*/
class LogWriteModel
{
    public function writeLog($message, $logFilePath)
    {

        $file = fopen($logFilePath, "a");

        if ($file) {
            fwrite($file, $message);
            fclose($file);
        }
    }
}
