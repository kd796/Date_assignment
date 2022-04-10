<?php

namespace Drupal\time_core\Services;
use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Datetime\DateFormatter;
use Drupal\Core\Config\ConfigFactory;
use Drupal\time_core\Form\TimeForm;
use Drupal\Core\Form\FormStateInterface;

class TimeService {

    public $timestamp;
    public $timeformater;
    public $config;


/**
   * @param Drupal\Component\Datetime\TimeInterface $timestamp
   * @param \Drupal\Core\Datetime\DateFormatter $timeformater
   * @param \Drupal\Core\Config\ConfigFactory $config
   */

  public function __construct(TimeInterface $timestamp,DateFormatter $timeformater,ConfigFactory $config) {
    
    $this->timestamp = $timestamp;
    $this->timeformater= $timeformater;
    $this->config = $config;
  }

  /**
   * Return date and time in '25th Oct 2019 -10:30PM'
   */
  public function getDatetime()
  {
   
   
   $config= $this->config->getEditable('time_core.settings')->get('timezone');
   $time= $this->timeformater->format($this->timestamp->getRequestTime(), $type = 'custom',$format = 'dS M Y - h : i a',$timezone= $config);
    return $time; 
}

}