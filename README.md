amCharts widget for Yii2 framework
===================================

# Install

### Case #1
```
~ $ composer require muvo/yii2-amcharts
```

### Case #2
or add this string into `require` section of your `composer.json` file:
```
"muvo/yii2-charts" : "*"
```
then run
```
~ $ composer update
```

# Usage
In your _view_ file you can add chart as regular widget, like:
```
<h1>Age Graph</h1>
<?= \muvo\yii\amcharts\Chart::widget([
    'options' => [ // Here is HTML-parameters of DIV element, which contain chart
        'style' => 'height:120px; width: 320px;',
    ],
    'chart' => [ // Here parameters for AmCharts.makeChart()
        'type' => 'serial',
        'categoryField' => 'name',
        'graphs' => [
            [
                'title' => 'Age',
                'type' => 'column',
                'valueField' => 'age',
                'fillAlphas' => 0.75,
            ],
        ],
        'dataProvider' => [
            [
                'name' => 'Alice',
                'age' => 19,
            ],
            [
                'name' => 'Bob',
                'age' => 21,
            ],
            [
                'name' => 'Claire',
                'age' => 35,
            ],
        ],
    ],
]) ?>
```

# See also
[amCharts official API reference](https://docs.amcharts.com/3/javascriptcharts)

# Credits

Vladislav Muschinskikh <i@unixoid.su> © 2016