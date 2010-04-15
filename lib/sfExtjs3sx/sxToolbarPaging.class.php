<?php
/**
 * sxToolbarPaging
 *
 * Instances of this class can render themself as JavaScript (definitions and instances)
 *
 */
class sxToolbarPaging extends sfExtjs3sx
{
  const NAME_SUFFIX = 'ToolbarPaging';
  const BASE_OBJECT = 'Ext.PagingToolbar';

  /**
   * Creates a new JsObject
   *
   * @param string $name       the name of the new class to be created (is between namespace and nameSuffix
   */
  public function __construct($name)
  {
    $objectName = $name.self::NAME_SUFFIX;

    parent::__construct($objectName, self::BASE_OBJECT);
  }

  public function configure()
  {
    $store = new sfExtjs3Object('this.store', '');
    $iconMgr = new sfExtjs3Object('Ext.ux.IconMgr', '');

    $this->addFunction('constructor', new sfExtjs3Function(array('c'), array(
        new sfExtjs3Json(
          array(
            'pageSize'    => 10,
            'displayInfo' => true,
            'displayMsg'  => '"Displaying item {0} - {1} of {2}"',
            'emptyMsg'    => '"no results"',
          ),
          'this.ptbConfig'
        ),
        $this->renderFunctionCall('superclass.constructor.call', array('this', 'Ext.apply(this.ptbConfig, c)')).";",
      )));

      $this->addFunction('initComponent', new sfExtjs3Function(array(''),
        $this->renderFunctionCall('superclass.initComponent.apply', array('this', 'arguments')).";"
      ));
  }

}

?>