<?php

namespace Drupal\time_core\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\time_core\Services\TimeService;
use Drupal\Core\Config\ConfigFactory;

/**
 * Render time and place
 *
 * @Block(
 *   id = "location_block",
 *   admin_label = @Translation("Render Location and Time"),
 *   category = @Translation("Time core")
 * )
 */
class TimeBlock extends BlockBase implements ContainerFactoryPluginInterface {

  
  /**
   * @var \Drupal\time_core\services\TimeService
   */
  protected $time;

  /**
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $config;

  /**
   * {@inheritdoc}
   */
  public function build() {
   
    $daytime=$this->time->getDatetime();
    $city=$this->config->getEditable('time_core.settings')->get('city');
    $country=$this->config->getEditable('time_core.settings')->get('country');
   
   
   return [
      '#theme'=>'time_show',
      
      '#city'=>$city,
      '#country'=>$country,
      '#daytime'=>$daytime,

        
    ];
    
  }
  public function getCacheMaxAge(){
    return 0;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('time_core.getdatetime'),
      $container->get('config.factory'),
     
    );
  }

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\time_core\Services\TimeService $time
   * @param \Drupal\Core\Config\ConfigFactory $config
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, TimeService $time, ConfigFactory $config) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->time = $time;
    $this->config= $config;
    
  }

}
