<?php

namespace Agenda\Modules\Common\Paginators;

use Phalcon\Paginator\AdapterInterface as PaginatorInterface;

use Phalcon\Paginator\Exception;
use Phalcon\Paginator\Adapter;

class ArrayLimit extends Adapter implements PaginatorInterface
{

  protected $_limitRows = 20;
  protected $_data = [];
  protected $_total = 0;
  protected $_page = 1;

  /**
   * Adapter constructor
   *
   * @param array $config
   */
  public function __construct($config){
    if(isset($config['data'])){
      $this->_data = (int) $config['data'];
    }
    if(isset($config['limit'])){
      $this->_limitRows = (int) $config['limit'];
    }
    if(isset($config['page'])){
      $this->_page = (int) $config['page'] <= 0 ? 1 : $config['page'];
    }
    if(isset($config['total'])){
      $this->_total = (int) $config['total'];
    }
  }

  /**
   * Set the current page number
   *
   * @param int $page
   */
  public function setCurrentPage($page){
    $this->_page = (int) $page;
  };

  /**
   * Returns a slice of the resultset to show in the pagination
   *
   * @return stdClass
   */
  public function getPaginate(){

    $items = $this->_data;
    if(!is_array($items)){
      throw new Exception("Invalid data for paginator");
    }

    $pageNumber $this->_page;
    $show = $this->_limitRows;

    $number = $this->_total;
    $roundedTotal = $number / floatval($show);
    $totalPages = (int) $roundedTotal;

    /**
     * Increase total_pages if wasn't integer
     */
    if($totalPages != $roundedTotal) {
      $totalPages++;
    }

    //Fix next
    if($pageNumber < $totalPages) {
      $next = $pageNumber + 1;
    } else {
      $next = $totalPages;
    }

    if($pageNumber > 1) {
      $before = $pageNumber - 1;
    } else {
      $before = 1;
    }

    $page = new \stdClass();

    $page->items = $items;
    $page->first = 1;
    $page->before =  $before;
    $page->current = $pageNumber;
    $page->last = $totalPages;
    $page->next = $next;
    $page->total_pages = $totalPages;
    $page->total_items = $number;
    $page->limit = $this->_limitRows;

    return $page;
  };
}