<?php
namespace Agenda\Modules\Common\Forms;

use Phalcon\Forms\Form;

class AbstractForm extends Form {

  protected $horizontal = false;

  // Form class
  public function appendMessage($field = '', $msg) {
    if (isset($this->_messages[$field])) {
      $this->_messages[$field]->appendMessage(new \Phalcon\Validation\Message($msg));
    } else {
      $this->_messages[$field] = new \Phalcon\Validation\Message\Group();
      $this->_messages[$field]->appendMessage(new \Phalcon\Validation\Message($msg));
    }
  }

  public function renderDecorated($name,$hidden = null){

    $element = $this->get($name);

    //Get any generated messages for the current element
    $messages = $this->getMessagesFor($element->getName());

    $htmlMessages = null;
    if (count($messages)) {
      //Print each element
      foreach ($messages as $message) {
        $htmlMessages .= $message . '<br/>';
      }
    }

    $description = null;
    if ($element->getAttribute('description')) {
      $description =  '<small class="help-block">' .
                        $element->getAttribute('description') .
                      '</small>';
      $element->setAttribute('description', null);
    }

    $dateWrap = null;
    $date = null;
    if ($element->getAttribute('data-format')) {
      if ($element->getAttribute('data-time')) {
        $dateWrap = '<div class="timepicker input-group date">';
      } else if($element->getAttribute('data-date')) {
        $dateWrap = '<div class="datepicker input-group date">';
      } else {
        $dateWrap = '<div class="datetimepicker input-group date">';
      }
      $date = '<div class="input-group-addon">
                 <i data-date-icon="icon-calendar" data-time-icon="icon-time" class="glyphicon glyphicon-calendar"></i>
              </div>
            </div>';
    }

    $h_labelClass = null;
    $h_wrapOpen = null;
    $h_wrapClose = null;
    if($this->horizontal){
      $h_labelClass = 'col-sm-3';
      $h_wrapOpen = '<div class="col-sm-9">';
      $h_wrapClose = '</div>';
    }

    $label = null;
    if($element->getLabel()){
      $label = '<label class="control-label ' . $h_labelClass . '">' . $element->getLabel() . '</label>';
    }

    $icon = null;
    if($element->getAttribute('data-icon')){
      $icon = '<span class="form-control-feedback ' . $element->getAttribute('data-icon') . '"></span>';
    }

    if (strpos($element->getAttribute('class'),'form-control') === false) {
      $element->setAttribute('class',$element->getAttribute('class') . ' form-control');
    }


    $hide = null;
    if ($element->getAttribute('type') == 'hidden' || $element->getAttribute('hidden') || $hidden) {
      $hide = ' hidden';
    }

    $errorClass = $htmlMessages ? ' has-error ' : null;
    $iconClass = $icon ? ' has-feedback' : null;

    return '<div class="form-group ' . $errorClass . $iconClass . $hide . '">' .
              $label .
              $h_wrapOpen . 
              $dateWrap .
              $element .
              $icon .
              $date .
              $description .
              '<span class="help-block error">' .
                $htmlMessages .
              '</span>' .
              $h_wrapClose . 
            '</div>';
  }

  public function renderRadioOptions($name) {
    return $this->renderOptions($name, 'radio');
  }

  public function renderCheckboxOptions($name) {
    return $this->renderOptions($name, 'checkbox');
  }

  protected function renderOptions($name, $type) {
    $element = $this->get($name);
    $messages = $this->getMessagesFor($element->getName());

    $htmlMessages = null;
    if (count($messages)) {
      foreach ($messages as $message) {
        $htmlMessages .= $message . '<br/>';
      }
    }

    $description = null;
    if ($element->getAttribute('description')) {
      $description = '<small class="help-block">' .
        $element->getAttribute('description') .
        '</small>';
      $element->setAttribute('description', null);
    }

    $optionsHtml = '';
    if ($element->getAttribute('options')) {
      foreach ($element->getAttribute('options') as $value => $label) {
        $optionsHtml .= '
          <label>
            <input type="' . $type . '" name="'. $name . '" class="flat-red" value="' . $value . '">' . 
            $label . 
          '</label>';
      }
      $element->setAttribute('options', '');
    }

    return '<div class="form-group ' . ($htmlMessages ? 'error ' : null) . '" style="margin-bottom: 5px;">
      <label>' . $element->getLabel() . '</label>
        ' . $element . '
        ' . $optionsHtml . '
        ' . $description. '
        <span class="help-block error">' . $htmlMessages .'</span>
    </div>';

  }

  public function renderAllDecorated($horizontal = false){

    $this->horizontal = $horizontal;
    
    $html = null;
    foreach ($this as $element) {
      if($element->getAttribute('type') == 'radio' || $element->getAttribute('type') == 'checkbox'){
        $html .= $this->renderOptions($element->getName(),$element->getAttribute('type'));
      }else{
        $html .= $this->renderDecorated($element->getName());
      }
    }

    return $html;

  }

  public function setHorizontal($horizontal){
    $this->horizontal = $horizontal;
  }

}

?>
