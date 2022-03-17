<?php
function view($name, $arg = []) {
    ob_start();
    # Создание переменной error для записей ошибок
    $error = ($arg['errors'] ?? []);

    # Функция в переменной для определения есть ли ошибка
    $isError = function($errorName, $input = false) use ($error) {
        $firstError = isset($error[$errorName]) ? $error[$errorName] : null;
        if(!isset($firstError) && !$input) return '';
        if($input) {
            $class = (isset($firstError) ? 'is-invalid' : '');
            $arrAttributes = [];
            $arrAttributes["class"][] = "form-control";
            $arrAttributes["class"][] = $class;
            $arrAttributes["aria_describedby"][] = "validation{$errorName}Feedback";

            $attributes = '';
            foreach($arrAttributes as $key => $items) {
                $key = str_replace('_', '-', $key);
                $attributes .= " $key='";
                foreach($items as $item)
                    $attributes .= " $item";
                $attributes .= "'";
            }

            return $attributes;
        }
        else {
            return '<div id="' . "validation{$errorName}Feedback" . '" class="invalid-feedback">
                  ' . (isset($firstError) ? implode('<br>', $firstError) : '') . '
                </div>';
        }
    };
    include_once 'views/' . $name . '.php';
    $content = ob_get_contents();
    ob_clean();
    return $content;
}