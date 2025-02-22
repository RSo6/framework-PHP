<?php

namespace app\controllers;


use app\models\Main;
use RedBeanPHP\R;
use wfm\App;
use wfm\Cache;


/** @property Main $model */
class MainController extends AppController
{

    public function indexAction()
    {
//        $test = 'hello';
//        $cache = Cache::getInstance();
//        $cache->set('test', $test, 30);
//        var_dump($cache->get('test'));
//        var_dump($test);
        $lang = App::$app->getProperty('language');
        $slides = R::findAll('slider');

        $products = $this->model->get_hits($lang, 6);

        $this->set(compact('slides', 'products'));
        $this->setMeta(___('main_index_meta_title'), ___('main_index_meta_description'), ___('main_index_meta_keywords'));
    }

}