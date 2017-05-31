<?php
namespace Agenda\Modules\Common\Controllers;


use Phalcon\Mvc\Controller;
use Phalcon\Logger\Adapter\File as FileAdapter;
use Phalcon\Mvc\Model\Query\Builder;

use Agenda\Models\Error;

class AbstractController extends Controller {

  use \Agenda\Modules\Common\Traits\Crypt;

  private $breadcrumb = array();

  protected $logger = null;

  public function initialize() {
    $this->view->controller = $this->dispatcher->getControllerName();
    $this->view->action = $this->dispatcher->getActionName();
    $this->view->t = $this->_getTranslation();
    // Set them as SHARED service so you can use them anywhere. Note: you can change variable name from T to anything you like. 
    $this->di->setShared('t', $this->_getTranslation());

    $className = join('', array_slice(explode('\\', get_class($this)), -1));
    $this->logger = new FileAdapter(APP_DIR . "/logs/" . $className . "-" . date("Y-m") . ".log");
  }

  protected function _getTranslation() {
    $config = $this->getDi()->get('config');

    //Ask browser what is the best language
    $language = $this->request->getBestLanguage();

    //Check if we have a translation file for that lang
    if (file_exists($config->application->messagesDir . $language . ".php")) {
      require $config->application->messagesDir . $language . ".php";
    } else {
      // fallback to some default
      require $config->application->messagesDir . "pt.php";
    }

    //Return a translation object
    return new \Phalcon\Translate\Adapter\NativeArray(array(
      "content" => $messages
    ));
  }

  public function queryFilter($query,$properties = null,$data = null,$model = null){

    //$params = null;
    if(!$data){
      $data = $this->request->get();
    }

    if($properties){
      unset($data['date']);
      unset($data['from']);
      unset($data['to']);
      foreach ($data as $field => $value) {
        if($model){
          $field = $model . '.' . $field;
        }
        if($value && array_key_exists($field, $properties)){
          if(isset($properties['search']) && in_array($field, $properties['search'])){
            $query->andWhere($field . ' like :' . $field . ':',array($field=>'%' . $value . '%'));
          }else{
            if($value == 'null'){
              $query->andWhere($field . ' is null');
            }else{
              $query->andWhere($field . ' = :' . $field . ':',array($field=>$value));
            }
          }
          //$params[$field] = $value;
        }
      }
    }

    $date = \DateTime::createFromFormat('Y-m-d',$this->request->get('date'));
    if($date){
      $query->andWhere('date(created_at) = :date:',array('date'=>$date->format('Y-m-d')));
    }

    $from = \DateTime::createFromFormat('Y-m-d',$this->request->get('from'));
    $to = \DateTime::createFromFormat('Y-m-d',$this->request->get('to'));
    if($from && $to){
      $query->betweenWhere('date(created_at)', $from->format('Y-m-d'), $to->format('Y-m-d'));
    }

    $filters = $data;
    unset($filters['_url']);
    $this->view->filters = $filters;
    
    return $query;

  }

  public function queryCount($query){
    $count_query = clone($query);
    $count_query->columns(array('count(*) as count'));
    try {
      if($query instanceof Builder){
        $count = $count_query->getQuery()->execute();
      }else{
        $count = $count_query->execute();
      }
    } catch (\Exception $e) {
      return 0;
    }
    if($count){
      $count = $count->getFirst();
      $count = $count['count'];
    }
    return (int) $count;
  }

}

