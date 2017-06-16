<?php

namespace Drupal\big_pipe_demonstration\Render\Placeholder;

use Drupal\big_pipe\Render\Placeholder\BigPipeStrategy;
use Drupal\Core\Render\Placeholder\PlaceHolderStrategyInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class BigPipeDemoStrategy extends BigPipeStrategy {

  // Used for PlaceHolderStrategyInterface
  protected $placeHolderStrategy;

  // Used for requestStack
  protected $requestStack;

  public function __construct(
    PlaceHolderStrategyInterface $placeholder,
    $sessionConfig,
    RequestStack $requestStack,
    RouteMatchInterface $routeMatch)
  {
    $this->placeHolderStrategy = $placeholder;
    $this->requestStack = $requestStack;
    parent::__construct($sessionConfig, $requestStack, $routeMatch);
  }

  public function processPlaceholders(array $placeholders)
  {
    $big_pipe = $this->requestStack->getCurrentRequest()->query->get('big_pipe');
    if($big_pipe) {
      return [];
    }

    return $this->placeHolderStrategy->processPlaceholders($placeholders);
  }
}
