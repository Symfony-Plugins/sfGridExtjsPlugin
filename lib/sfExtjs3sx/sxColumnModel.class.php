<?php
/**
 * sxColumnModel
 *
 * Instances of this class can render themself as JavaScript (definitions and instances)
 *
 */
class sxColumnModel extends sfExtjs3sx
{
  const NAME_SUFFIX = 'ColumnModel';
  const BASE_OBJECT = 'Ext.grid.ColumnModel';

  /**
   * A multiarray holding all field config for this columnModel
   *
   * @var array
   */
  protected $configFields;
  
  /**
   * Creates a new JsObject
   *
   * @param string $name         the name of the new class to be created (is between namespace and nameSuffix
   * @param array  $configFields the config-fields to be added to this columnModel (an array containing json-arrays with parameters)
   */
  public function __construct($name, $configFields)
  {
    $objectName = $name.self::NAME_SUFFIX;
    
    $this->configFields = $configFields;
    
    parent::__construct($objectName, self::BASE_OBJECT);
  }

  public function configure()
  {
    $cmConfig = 'this.cmConfig = ['.implode(",\n", $this->configFields).']';
    
    $this->addFunction('constructor', new sfExtjs3Function(array('c'), array(
        $cmConfig.";",
        $this->renderFunctionCall('superclass.constructor.call', array('this', 'Ext.apply(this.cmConfig, c)')).";",
        "this.defaultSortable = true;",
      )));

//      $this->addFunction('initComponent', new sfExtjs3Function(array(''),
//        $this->renderFunctionCall('superclass.initComponent.apply', array('this', 'arguments')).";"
//      ));
  }
}

