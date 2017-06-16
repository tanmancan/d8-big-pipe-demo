<?php

namespace Drupal\big_pipe_demonstration\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'BigPipeDemoBlock' block.
 *
 * @Block(
 *  id = "big_pipe_demo_block",
 *  admin_label = @Translation("Big pipe demo block"),
 * )
 */
class BigPipeDemoBlock extends BlockBase {


  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
         'delay' => 0,
        ] + parent::defaultConfiguration();

 }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['delay'] = [
      '#type' => 'number',
      '#title' => $this->t('Delay'),
      '#description' => $this->t('Enter delay time to simulate block generation in milliseconds'),
      '#default_value' => $this->configuration['delay'],
      '#weight' => '0',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   * Turn off cache to demo delayed rendering
   */
  public function getCacheMaxAge() {
    return 0;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['delay'] = $form_state->getValue('delay');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];

    sleep($this->configuration['delay'] / 1000);
    $build['big_pipe_demo_block_delay']['#markup'] = '<p>Delay: ' . $this->configuration['delay'] . 'ms</p>';

    return $build;
  }

}
