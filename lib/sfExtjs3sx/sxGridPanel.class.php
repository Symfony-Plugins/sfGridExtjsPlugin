<?php
/**
 * sxGridPanel
 *
 * Instances of this class can render themself as JavaScript (definitions and instances)
 *
 */
class sxGridPanel extends sfExtjs3sx
{
  const NAME_SUFFIX = 'GridPanel';
  const BASE_OBJECT = 'Ext.grid.EditorGridPanel';

  /**
   * The maximum number of results per page
   *
   * @var sxStore
   */
  protected $sxStore;
  
  /**
   * The maximum number of results per page
   *
   * @var sxColumnModel
   */
  protected $sxColumnModel;
  
  /**
   * The maximum number of results per page
   *
   * @var sxToolbarTop
   */
  protected $sxToolbarTop;
  
  /**
   * The maximum number of results per page
   *
   * @var sxToolbarPaging
   */
  protected $sxToolbarPaging;
  
  
  /**
   * The maximum number of results per page
   *
   * @var int
   */
  protected $maxPerPage;
  
  /**
   * The title of the panel 
   * 
   * @var string
   */
  protected $title;
  
  /**
   * Creates a new JsObject
   *
   * @param string $name      the name of the new class to be created (is between namespace and nameSuffix
   * @param sxStore $sxStore 
   * @param sxColumnModel $sxColumnModel 
   * @param sxToolbarTop $sxToolbarTop = null 
   * @param sxToolbarPaging $sxToolbarPaging = null 
   * @param int $maxPerPage   The maximum number of results per page
   * @param string $title     The title of this panel
   */
  public function __construct(
    $name, 
    sxStore $sxStore, 
    sxColumnModel $sxColumnModel, 
    sxToolbarTop $sxToolbarTop = null, 
    sxToolbarPaging $sxToolbarPaging = null, 
    $maxPerPage,
    $title
  )
  {
    $objectName = $name.self::NAME_SUFFIX;
    
    $this->sxStore         = $sxStore;
    $this->sxColumnModel   = $sxColumnModel;
    $this->sxToolbarTop    = $sxToolbarTop;
    $this->sxToolbarPaging = $sxToolbarPaging;
    
    $this->maxPerPage = $maxPerPage;
    $this->title = $title;
        
    parent::__construct($objectName, self::BASE_OBJECT);
  }
  
  public function getTitle()
  {
    return $this->title;
  }

  public function configure()
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
    
    $gridView = new sfExtjs3Object('Ext.grid.GridView', '');
    $rowSelectionModel = new sfExtjs3Object('Ext.grid.RowSelectionModel', '');
    
    $this->addFunction('constructor', new sfExtjs3Function(array('c'), array(
        new sfExtjs3Json(
          array(
            'title' => $this->getTitle(),
            'ds'    => $this->sxStore->renderConstruction(),
            'cm'    => $this->sxColumnModel->renderConstruction(),
            'view'  => $gridView->renderConstruction(array(new sfExtjs3Json(array(
              'forceFit' => true,
            )))),
            'autoScroll'    => true,
            'autoLoadStore' => true,
            'selModel'      => $rowSelectionModel->renderConstruction(array(new sfExtjs3Json(array(
              'singleSelect' => true
            )))),
            'clicksToEdit'   => 1,
            'trackMouseOver' => true,
            'loadMask'       => true,
//            plugins : [
//              new Ext.ux.grid.RowMouseOver()
//            ],
            'stripeRows'     => true,
          ),
          'this.gridPanelConfig'
        ),
        $this->renderFunctionCall('superclass.constructor.call', array('this', 'Ext.apply(this.gridPanelConfig, c)')).";",
        
//        this.modulename = '".sfInflector::underscore($this->name)."';
//        this.panelType  = 'list';

        // TODO: needs testing
        "if ((typeof c != 'undefined') && (typeof c.filter != 'undefined'))
        {
          this.store.baseParams.filter = 'query';
          c.filter_key = (typeof c.filter_key != 'undefined') ? c.filter_key : -1;
          this.store.baseParams['filters[' + c.filter + ']'] = c.filter_key;
        }
        "
        
    )));

    $components = array();
    
    $components[] = "// initialise items which use this grid's-store";
    if ($this->sxToolbarTop)
    {
      $components[] = "this.tbar = ".$this->sxToolbarTop->renderConstruction(array(new sfExtjs3Json(array(
                        'store' => "this.ds",
                      )))).";";
    }
                   
    if ($this->sxToolbarPaging)
    {
      $components[] = "this.bbar = ".$this->sxToolbarPaging->renderConstruction(array(new sfExtjs3Json(array(
                        'store' => "this.ds",
                      )))).";";
    }
    $components[] = $this->renderFunctionCall('superclass.initComponent.call', array('this', 'arguments')).";";
    $components[] = "
      // TODO these events should be implemented
      //          this.addEvents()
    ";
    
    $this->addFunction('initComponent', new sfExtjs3Function(array(), $components));
    
    $this->addFunction('initEvents', new sfExtjs3Function(array(), array(
      $this->renderFunctionCall('superclass.initEvents.apply', array('this')).";",
      "",
      $this->renderFunctionCallThis('on', array(new sfExtjs3Json(array(
        'afteredit' => new sfExtjs3Json(array(
          'fn'    => 'this.updateDB',
          'scope' => 'this',
        ))
      )))).";",
      "",
      $this->renderFunctionCallThis('on', array(new sfExtjs3Json(array(
        'scope' => 'this',
        'click' =>  'this.onLinkClick',
        'delegate' =>  '"a.gridlink"', // TODO!
        'stopEvent' => true
      )))).";",
    )));
    
    $this->addFunction('onRender', new sfExtjs3Function(array('ct', 'position'), array(
      $this->renderFunctionCall('superclass.onRender.apply', array('this', 'arguments')).";",
      "
        if (this.autoLoadStore)
        {
          this.store.load();
        }
      "
    )));
//TODO continue    
    
  }
}

?>