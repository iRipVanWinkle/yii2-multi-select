# MultiSelect Widget for Yii2

[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://raw.githubusercontent.com/iripvanwinkle/yii2-multi-select/master/LICENSE) [![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat-square)](http://www.yiiframework.com/)

Renders a [MultiSelect Bootstrap plugin](http://davidstutz.github.io/bootstrap-multiselect) widget.

## Install

Via Composer

``` bash
$ composer require iripvanwinkle/yii2-multi-select
```

## Usage

``` php
  use roboapp\multiselect\MultiSelect;

  MultiSelect::widget([
      'enableResetButton' => true,
      'options' => [
          'multiple' => true
      ],
      'value' => 'value_2', // or ['value_1', 'value_3']
      'name' => 'multi_select',
      'data' => [
          'value_1'  => 'title_1',
          'value_2'  => 'title_2',
          'value_3'  => 'title_3',
          'value_4'  => 'title_4',
      ]
  ])
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

