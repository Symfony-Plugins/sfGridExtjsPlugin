<?php

/*
 * This file is part of the symfony package.
 * Leon van der Ree <leon@fun4me.demon.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * A formatter that renders a row for ExtJs3
 *
 * @package    symfony
 * @subpackage grid-extjs3
 * @author     Leon van der Ree <leon@fun4me.demon.nl>
 * @version    SVN: $Id$
 */
class sfGridFormatterExtjs3Row extends sfGridFormatterDynamicRow
{
  /**
   * Renders a row to html
   *
   * @return string
   */
  public function render()
  {
    $source = $this->grid->getDataSource();
    $source->seek($this->index);
    
    $data = array();

    foreach ($this->grid->getWidgets() as $column => $widget)
    {
      $data[$column] = $source[$column];
    }

    return $data;
  }
}