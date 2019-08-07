<?php


namespace app\admin\controller;


use think\Config;

class Conf extends Base {

    public function index() {
        return $this->ok(Config::get('static'));
    }
}
