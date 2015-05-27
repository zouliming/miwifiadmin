<?php

class Util {
    public static function getCssPath() {
        return Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR;
    }

    public static function getJsPath() {
        return Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR;
    }

    public static function getImgPath() {
        return Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR;
    }

    public static function loadJquery() {
        echo "<script src='" . Yii::app()->baseUrl . "/js/jquery-1.8.3.js'></script>";
    }
}