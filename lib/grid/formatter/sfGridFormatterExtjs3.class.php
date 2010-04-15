<?php

/*
 * This file is part of the symfony package.
 * Leon van der Ree <leon@fun4me.demon.nl> 
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class sfGridFormatterExtjs3 extends sfGridFormatterDynamic
{
  /**
   * @var sxStore 
   */
  protected $sxStore; 
  
  /**
   * @var sxColumnModel  
   */
  protected $sxColumnModel; 
  
  /**
   * @var sxToolbarTop 
   */
  protected $sxToolbarTop;
  
  /**
   * @var sxToolbarPaging  
   */
  protected $sxToolbarPaging;
  
  /**
   * 
   * @param sfGridExtjs3 $grid
   */
  public function __construct(sfGridExtjs3 $grid)
  {
    // grid setup
    $this->grid = $grid;
    $this->row = new sfGridFormatterExtjs3Row($grid, 0);
  }
  
  /**
   * Returns an array of columns, containing Json-arrays with parameters
   *
   * @return array
   */
  public function getDataStoreFields()
  {
    $columnConfig = array();
    
    foreach ($this->grid->getWidgets() as $column => $widget)
    {
      $columnConfig[] = new sfExtjs3Json($widget->getDSFieldConfig($column));
    }
    
    return $columnConfig;
  }
  
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Returns an array of columns, containing Json-arrays with parameters
   *
   * @return array
   */
  public function getColumnModelConfig()
  {
    $columnModelConfig = array();
    
    foreach ($this->grid->getWidgets() as $column => $widget)
    {
      $columnConfig = $widget->getColumnConfig($column);
      $columnConfig['header'] = '"'.$this->grid->getTitleForColumn($column).'"';
      $columnModelConfig[] = new sfExtjs3Json($columnConfig);
    }
    
    return $columnModelConfig;
  }  
  
  /**
   * Renders the table in ExtJS
   *
   * @return string
   */
  public function render()
  {
    $controller = sfContext::getInstance()->getController();
    
    // lazy extjs setup
    $this->sxStore          = new sxStore('List'.$this->grid->getName(), $this->getDataStoreFields(), $controller->genUrl($this->grid->getUri()."?sf_format=json"));
    $this->sxColumnModel    = new sxColumnModel('List'.$this->grid->getName(), $this->getColumnModelConfig());
//    $this->sxToolbarTop     = new sxToolbarTop('List'.$this->grid->getName());
//    $this->sxToolbarPaging  = new sxToolbarPaging('List'.$this->grid->getName());
    
    
    $code = array(
              $this->renderNamespace(),
              $this->renderDataStore(),
              $this->renderColumnModel(),
//              $this->renderToolbarTop(),
//              $this->renderToolbarPaging(),
              $this->renderGridPanel(),
            );
            
    return implode("\n\n", $code);
  }

  public function renderNamespace()
  {
    return "
      // namespace: Ext.app.sx
      Ext.namespace('Ext.app.sx');
    ";
  }
  
  public function renderDataStore()
  {
    $js  = $this->sxStore->__toString();
    $js .= $this->sxStore->registerXtypeAs(sfInflector::underscore('List'.$this->grid->getName()));

    return $js;
  }

  public function renderColumnModel()
  {
    $js  = $this->sxColumnModel->__toString();
    $js .= $this->sxColumnModel->registerXtypeAs(sfInflector::underscore('List'.$this->grid->getName()));

    return $js;
  }

  public function renderToolbarTop()
  {
    $js  = $this->sxToolbarTop->__toString();
    $js .= $this->sxToolbarTop->registerXtypeAs(sfInflector::underscore('List'.$this->grid->getName()));

    return $js;
  }
  
  public function renderToolbarPaging()
  {
    $js  = $this->sxToolbarPaging->__toString();
    $js .= $this->sxToolbarPaging->registerXtypeAs(sfInflector::underscore('List'.$this->grid->getName()));

    return $js;
  }
  
  public function renderGridPanel()
  {
    $sxGridPanel = new sxGridPanel('List'.$this->grid->getName(), 
                                   $this->sxStore, 
                                   $this->sxColumnModel, 
                                   $this->sxToolbarTop, 
                                   $this->sxToolbarPaging,
                                   $this->grid->getPager()->getMaxPerPage(),
                                   '"'.$this->grid->getTitle().'"'
                                  );

    $js  = $sxGridPanel;
    $js .= $sxGridPanel->registerXtypeAs(sfInflector::underscore('List'.$this->grid->getName()));

    return $js;
  }

}
