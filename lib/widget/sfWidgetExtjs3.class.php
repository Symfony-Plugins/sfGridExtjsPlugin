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
class sfWidgetExtjs3 extends sfWidget
{
  protected $type = 'string';

  /**
   * renders value (you can extend this class and pre-process this value)
   *
   * @see sfWidget#render()
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    return $value;
  }

  /**
   * Returns the column-definition for DataStores
   * this is defined in the widget, to allow you to define the type
   *
   * @param string $name
   * @return array
   */
  public function getDSFieldConfig($name)
  {
    $arrJs = array(
      'name'    => '"'.$this->convertToDataFieldName($name).'"',
      'type'    => '"'.$this->type.'"',
      'mapping' => '"'.$name.'"',
    );
    
    return $arrJs;
  }
    
  /**
   * Returns the column-definition for ColumnModel
   * this is defined in the widget, to allow you to define the type
   *
   * @param string $name
   * @return array
   */
  public function getColumnConfig($name)
  {
    $arrJs = array(
//      $arrJs['header'] = '"'.$name.'"';
      $arrJs['dataIndex'] = '"'.($name).'"',
//      $arrJs['renderer'] = 'this.renderLink.createDelegate(this)';
//      $arrJs['editor'] = array(
//        'xtype' => '"textfield"',
//      );
      $arrJs['sortable'] = true,
    );
    
    return $arrJs;
  }
  
  
  protected function convertToDataFieldName($name)
  {
    return str_replace('.', '_', $name);
  }
  
}