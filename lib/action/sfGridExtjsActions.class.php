<?php

/**
 * extjsGrid actions.
 *
 * @package    symfony
 * @subpackage sfGridExtjsPlugin
 * @author     Leon van der Ree
 * @version    SVN: $Id:  $
 */
class sfGridExtjsActions extends sfActions
{
  
  /**
   * @see sfActions
   */
  public function execute($request)
  {
    $this->grid = $this->getRoute()->getObject(); // getGrid()

    $response = $this->getResponse();
    if ($request->getRequestFormat() == 'json')
    {
      sfConfig::set('sf_web_debug', false);
      $response->setContentType('application/json');
      return $this->renderText($this->grid->renderData());
    }
    elseif ($request->getRequestFormat() == 'js')
    {
      sfConfig::set('sf_web_debug', false);
      $response->setContentType('text/javascript');
      return $this->renderText($this->grid->renderJavaScript());
    }
    
    // if html include javascript as well
    $response->addJavascript($this->getController()->genUrl($this->grid->getUri()."?sf_format=js") );
    return parent::execute($request);
  }
}
