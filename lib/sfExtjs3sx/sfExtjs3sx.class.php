<?php
/**
 * sfExtjs3sx
 *
 * Instances of this class can render themself as JavaScript (definitions and instances)
 *
 */
class sfExtjs3sx extends sfExtjs3Object
{
  const EXT_NAMESPACE = 'Ext.app.sx';

	/**
	 * Creates a new JsObject
	 *
	 * @param string $objectName the name of the new class to be created (is preceded with namespace Ext.app.sx.
	 * @param string $baseObject the base object which this new class should extend
	 * @param array $functions   an associative array of function-names and the sfExtjs3Function itself
	 */
	public function __construct($objectName, $baseObject, $functions = array())
	{
	  $objectName = self::EXT_NAMESPACE.'.'.$objectName;

	  parent::__construct($objectName, $baseObject, $functions);
	}

}

?>