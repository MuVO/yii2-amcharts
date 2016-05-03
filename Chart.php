<?php namespace muvo\yii\amcharts;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Json;
use yii\web\View;

class Chart extends Widget
{
    public $chart;
    public $options = array();
    private $_asset;

    public function init(){
        $this->_asset = $this->view->registerAssetBundle(
            AssetBundle::className(),
            View::POS_HEAD);

        $this->options['id'] = $this->id;

        switch($this->type){
            case 'funnel':
            case 'gantt':
            case 'gauge':
            case 'pie':
            case 'radar':
            case 'serial':
            case 'xy':
                $this->view->registerJsFile(sprintf('%s/%s.js',
                        $this->_asset->baseUrl,
                        $this->type),
                    ['position' => View::POS_BEGIN]);
                break;
        }

    }

    public function getVarName(){
        $string = implode('_',[
            'chart',
            $this->type,
            $this->id,
        ]);

        return Inflector::variablize($string);
    }

    public function getType(){
        return isset($this->chart['type'])
            ? $this->chart['type']
            : false;
    }

    public function run(){
        $this->view->registerJs(
            sprintf('<!--
        AmCharts.ready(function(){
        console.log(new Date(),\'Chart %2$s loaded\');
        var %1$s = window.%1$s = AmCharts.makeChart(\'%2$s\',%3$s);
        })
        -->',
                $this->getVarName(),
                $this->id,
                Json::encode($this->chart)),
            View::POS_END,$this->id);

        return Html::tag('div',null,$this->options);
    }
}
