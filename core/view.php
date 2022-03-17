<?php
function view($name, $arg = []) {
    ob_start();
    # Создание переменной error для записей ошибок
    $error = ($arg['errors'] ?? []);

    # Функция в переменной для определения есть ли ошибка
    $isError = function($errorName, $input = false) use ($error) {
        if(!isset($error[$errorName])) return '';
        if($input) {
            return 'class="form-control is-invalid" id="validationServer03" aria-describedby="validationServer03Feedback"';
        }
        else {
            return '<div id="validationServer03Feedback" class="invalid-feedback">
                  Please provide a valid city.
                </div>';
        }
    };
    include_once 'views/' . $name . '.php';
    $content = ob_get_contents();
    ob_clean();
    return $content;
}