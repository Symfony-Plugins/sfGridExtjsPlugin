<?php $grid = $sf_data->getRaw('grid'); ?>
<div id="grid-example">
  <table>
   <?php echo $grid->render() ?>
  </table>
</div>

<?php
  // create extjs3 instance
  $sfExtjs3Plugin = new sfExtjs3Plugin(array('theme'=>'blue'), array('css' => '')); // no extra css or js

  // load extjs
  $sfExtjs3Plugin->load();
  // start javascript tag
  $sfExtjs3Plugin->begin();

  // start init application
  $sfExtjs3Plugin->beginApplication(array(
    'name'   => 'App',
    'private' => array
    (
    ),
    'public' => array
    (
      // public attributes
      // public methods
      'init'    =>  $sfExtjs3Plugin->asMethod(
        "Ext.QuickTips.init();

        // remove the html-grid
        Ext.get('grid-example').update();
                
        // create an instance of the extjs-Grid
        var grid = new Ext.app.sx.List".$grid->getName()."GridPanel(".json_encode(array(
            'height'   => 350,
            'width'    => 600,
            'title'    => 'Array Grid',
            'renderTo' => 'grid-example',
        )).");
      "),
    )
  ));
  // close application tag
  $sfExtjs3Plugin->endApplication();

  // start the application
  $sfExtjs3Plugin->initApplication('App');

  // close javascript tag
  $sfExtjs3Plugin->end();
?>