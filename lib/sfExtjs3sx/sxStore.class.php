<?php
/**
 * sxStore
 *
 * Instances of this class can render themself as JavaScript (definitions and instances)
 *
 */
class sxStore extends sfExtjs3sx
{
  const NAME_SUFFIX = 'Store';
  const BASE_OBJECT = 'Ext.data.Store';

  /**
   * A multiarray holding all field info for this store
   *
   * @var array
   */
  protected $fields;
  
  /**
   * the url for the store to the json-data
   * 
   * @var string
   */
  protected $json_store_url;
  
  /**
   * Creates a new JsObject
   *
   * @param string $name      the name of the new class to be created (is between namespace and nameSuffix
   * @param array $fields     the fields to be added to this store (an array containing json-arrays with parameters)
   * @param string $json_store_url the url for the store to the json-data
   */
  public function __construct($name, $fields, $json_store_url)
  {
    $objectName = $name.self::NAME_SUFFIX;
    
    $this->fields = $fields;
    $this->json_store_url = $json_store_url;
        
    parent::__construct($objectName, self::BASE_OBJECT);
  }

  public function configure()
  {
    $httpProxy = new sfExtjs3Object('Ext.data.HttpProxy', '');
    $jsonReader = new sfExtjs3Object('Ext.data.JsonReader', '');

    $this->addFunction('constructor', new sfExtjs3Function(array('c'), array(
        new sfExtjs3Json(
          array(
//            'sortInfo' => sfExtjs3Json(array(
//              'field'     => "'TODO_sort_field'",
//              'direction' => "'asc'"
//            )),
            'remoteSort' => true,
            'defaultParamNames' => new sfExtjs3Json(array(
              'dir' => "'type'",
              'sort' => "'sort'",
          // start , limit
            )),
            'proxy' => $httpProxy->renderConstruction(array(new sfExtjs3Json(array(
              'url'    => "'".$this->json_store_url."'", // TODO: maybe use the ext-direct plugin?
              'method' => "'POST'",
            )))),
            'reader' => $jsonReader->renderConstruction(array(new sfExtjs3Json(array(
              'id'            => "'TODO_PK'",
              'root'          => "'data'",
              'totalProperty' => "'totalCount'",
              'fields'        => $this->fields,
            )))),
          ),
          'this.storeConfig'
        ),
        $this->renderFunctionCall('superclass.constructor.call', array('this', 'Ext.apply(this.storeConfig, c)')).";",
      )));

      $this->addFunction('initComponent', new sfExtjs3Function(array(''),
        $this->renderFunctionCall('superclass.initComponent.apply', array('this', 'arguments')).";"
      ));

      $this->addFunction('initEvents', new sfExtjs3Function(array(''),
        $this->renderFunctionCall('superclass.initEvents.apply', array('this')).";"
      ));
  }
}

?>