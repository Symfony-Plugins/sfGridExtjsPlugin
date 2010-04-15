<?php
/**
 * sfGridExtjsRoute represents a route that is bound to an GridExtjs-class.
 *
 * A grid route can only represent a single Grid object.
 *
 * @package    symfony
 * @subpackage routing
 * @author     Leon van der Ree
 * @version    SVN: $Id:  $
 */
class sfGridExtjsRoute extends sfGridRoute
{
  public function __construct($pattern, array $defaults = array(), array $requirements = array(), array $options = array())
  {
    if (strpos($pattern,':sf_format') === false)
    {
      $pattern .= '.:sf_format';
    }
    
    $defaults = array_merge(
      array(
        'module' => 'extjsGrid', 
        'action' => 'index', 
        'sf_format' => 'html',
      ),
      $defaults
    ); 
    
    if (!isset($requirements['sf_method']))
    {
      $requirements['sf_method'] = array('get', 'head', 'post');
    }
    else
    {
      $requirements['sf_method'] = array_map('strtolower', (array) $requirements['sf_method']);
    }
    
    parent::__construct($pattern, $defaults, $requirements, $options);
  }
}