<?php

class Util {
    public static function getCssUrl() {
        return Yii::app()->request->baseUrl . '/css/';
    }

    public static function getJsUrl() {
        return Yii::app()->request->baseUrl . '/js/';
    }

    public static function getImgUrl() {
        return Yii::app()->request->baseUrl . '/img/';
    }

    public static function loadJquery() {
        echo "<script src='" . Yii::app()->request->baseUrl . "/js/jquery-1.8.3.js'></script>";
    }
}