<?php
/**
 * sxToolbarTop
 *
 * Instances of this class can render themself as JavaScript (definitions and instances)
 *
 */
class sxToolbarTop extends sfExtjs3sx
{
  const NAME_SUFFIX = 'ToolbarTop';
  const BASE_OBJECT = 'Ext.Toolbar';

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
//    $store = new sfExtjs3Object('this.store', '');
//    $iconMgr = new sfExtjs3Object('Ext.ux.IconMgr', '');
//
//    $this->addFunction('constructor', new sfExtjs3Function(array('c'), array(
//        new sfExtjs3Json(
//          array(
//            'items' => array(
//              new sfExtjs3Json(array(
//                'xtype' => "'tbbutton'",
//                'text' => "'Refresh'",
//                'action' => "'refresh'",
//                'idRequired' => false,
////                'iconCls' => $iconMgr->renderFunctionCall('getIcon', array("'table_refresh'")), // or simply "Ext.ux.IconMgr.getIcon('table_refresh')",
//                'disabled' => false,
//                'scope' => "this",
//                'store' => "c.store", // TODO: this can be done differently, see argument that can be modeled, but this easy aint't it
//                'handler' => new sfExtjs3Function(
//                  array(),
//                  $store->renderFunctionCall('reload').';' // or simply "this.store.reload();"
//                )
//              )),
//              new sfExtjs3Json(array(
//                'xtype' => "'tbfill'",
//              )),
//              new sfExtjs3Json(array(
//                'xtype' => "'tbbutton'",
//                'text' => "'Pdf'",
//                'action' => "'pdf'",
//                'idRequired' => false,
////                'iconCls' => $iconMgr->renderFunctionCall('getIcon', array("'page_white_acrobat'")),
//                'disabled' => false,
//                'scope' => "this",
//                'store' => "c.store",
//                'handler' => 'this._pdf'
//              )),
//              new sfExtjs3Json(array(
//                'xtype' => "'tbbutton'",
//                'text' => "'Print'",
//                'action' => "'print'",
//                'idRequired' => false,
////                'iconCls' => $iconMgr->renderFunctionCall('getIcon', array("'printer'")),
//                'disabled' => false,
//                'scope' => "this",
//                'store' => "c.store",
//                'handler' => new sfExtjs3Function(
//                  array(),
//                  "window.open('/daily_view/listPrint');"
//                )
//              )),
//            )
//          ),
//          'this.ttbConfig'
//        ),
//        $this->renderFunctionCall('superclass.constructor.call', array('this', 'Ext.apply(this.ttbConfig, c)')).";",
//      )));
//
//      $this->addFunction('initComponent', new sfExtjs3Function(array(''),
//        $this->renderFunctionCall('superclass.initComponent.apply', array('this', 'arguments')).";"
//      ));
  }

}

?>