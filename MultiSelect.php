<?php

namespace roboapp\multiselect;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class MultiSelect extends InputWidget
{
    /**
     * @var bool
     */
    public $enableResetButton = false;

    /**
     * @var array data for generating the list options (value=>display)
     */
    public $data = [];

    /**
     * @var array the options for the Bootstrap Multiselect JS plugin.
     * Please refer to the Bootstrap Multiselect plugin Web page for possible options.
     * @see http://davidstutz.github.io/bootstrap-multiselect/#options
     */
    public $clientOptions = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        if (empty($this->data)) {
            throw new  InvalidConfigException('"Multiselect::$data" attribute cannot be blank or an empty array.');
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerPlugin();

        $html = Html::beginTag('div', ['class' => 'input-group']);

        if ($this->hasModel()) {
            $html .= Html::activeDropDownList($this->model, $this->attribute, $this->data, $this->options);
        } else {
            $html .= Html::dropDownList($this->name, $this->value, $this->data, $this->options);
        }

        if ($this->enableResetButton) {
            $html .= $this->resetButton();
        }

        $html .= Html::endTag('div');

        return $html;

    }

    /**
     * Registers MultiSelect Bootstrap plugin and the related events
     */
    protected function registerPlugin()
    {
        $view = $this->getView();

        MultiSelectAsset::register($view);

        if ($this->clientOptions && $this->clientOptions['enableCollapsibleOptGroups']){

        }

        $id = $this->options['id'];

        $options = $this->clientOptions ? Json::encode($this->clientOptions) : '';

        $js = "jQuery('#$id').multiselect($options);";
        $view->registerJs($js);
    }

    protected function resetButton()
    {
        $buttonId = $this->id . '_reset';

        $onclickFunction = "$('#{$this->id} option:selected').each(function() { $(this).prop('selected', false); }); $('#{$this->id}').parents('.form-group').find('input[type=\"hidden\"]').val(''); $('#{$this->id}').multiselect('refresh');";

        return Html::tag('span', Html::a('<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>', null, ['id' => $buttonId, 'onclick' => $onclickFunction, 'class' => 'btn btn-default btn-sm'])
            , ['class' => 'input-group-btn']);
    }
}
