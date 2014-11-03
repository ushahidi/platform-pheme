<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Ushahidi Read Layer Parser
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Application
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

use Ushahidi\Core\Tool\Parser;
use Ushahidi\Core\Exception\ParserException;
use Ushahidi\Core\Usecase\Layer\ReadLayerData;

class Ushahidi_Parser_Layer_Read implements Parser
{
	public function __invoke(Array $data)
	{
		$valid = Validation::factory($data)
			->rules('id', array(
					array('not_empty'),
					array('digit'),
				));

		if (!$valid->check())
		{
			throw new ParserException("Failed to parse layer read request", $valid->errors('layer'));
		}

		return new ReadLayerData($data);
	}
}
