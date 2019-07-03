<?php

$data = array(); //инициализация массива
if( isset( $_GET['uploadfiles'] ) ){ //проверочка на наличие гет переменной uploadfiles
    $myfile = fopen("txt.txt", "a"); //открываем файл(содаем файл) с указанным именем и модификатором доступа
    $txt = $_POST['text'] . "\n"; //заисываем из глобальной перенной ПОСТ значение key text"а
    fwrite($myfile, $txt);//записываем куда , что
    fclose($myfile);//обязательно закрываем

    $error = false;//инициализируем отсуствие ошибок
    $files = array();
    $uploaddir = 'uploads/'; //директория хранения файлов
    // переместим файлы из временной директории в указанную
    foreach( $_FILES as $file ){
        if( move_uploaded_file( $file['tmp_name'], $uploaddir . basename($file['name']) ) ){
            $files[] = realpath( $uploaddir . $file['name'] );
        }
        else{
            $error = true;
        }
    }
    $data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('files' => $files ); //короткий if else зыучит предположительно так( сам я не использую такую короткую версию) если ошибка существует то выводим ее? иначе выводит значение переменной файл(там будет путь"
    echo json_encode( $data );
}