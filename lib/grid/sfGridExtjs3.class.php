<?php

/*
 * This file is part of the symfony package.
 * Leon van der Ree <leon@fun4me.demon.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage grid-extjs3
 * @author     Leon van der Ree <leon@fun4me.demon.nl>
 * @version    SVN: $Id$
 */
class sfGridExtjs3 extends sfContextGridJavaScript
{
  /**
   * the name of the ExtJsGrid-components
   * 
   * @var string
   */
  protected $name;
  
  /**
   * Constructor.
   *
   * @param string $name   the name of the ExtJsGrid-components
   * @param  mixed $source An array or an instance of sfDataSourceInterface with
   *                       data that should be displayed in the grid.
   *                       If an array is given, the array must conform to the
   *                       requirements of the constructor of sfDataSourceArray.
   */
  public function __construct($name, $source)
  {
    parent::__construct($source);
    
    $this->name = $name;
  }
  
  /**
   * Configures the grid. This method is called from the constructor. It can
   * be overridden in child classes to configure the grid.
   */
  public function configure()
  {
    parent::configure();
    
    // get the source from the original pager
    $source = $this->getPager()->getDataSource();
    // redefine the pager
//    $this->pager = new sfDataSourcePagerExtjs3($source);

    // define the javascript formatter
    $this->setJavaScriptFormatter(new sfGridFormatterExtjs3($this));
  }
  

  /**
   * returns the name of the ExtJsGrid-components
   * 
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }
  
  /**
   * Returns the default widget
   *
   * @return sfWidget
   */
  protected function getDefaultWidget()
  {
    return new sfWidgetExtjs3();
  }


}