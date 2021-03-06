<?php
/**
 * @copyright Copyright (c) 2013, The volkszaehler.org project
 * @package default
 * @license http://www.opensource.org/licenses/gpl-license.php GNU Public License
 * @author Andreas Goetz <cpuidle@gmx.de>
 */
/*
 * This file is part of volkzaehler.org
 *
 * volkzaehler.org is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * volkzaehler.org is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with volkszaehler.org. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Volkszaehler\Interpreter\SQL;

/**
 * SQLiteOptimizer provides basic DB-specific optimizations
 */
class SQLiteOptimizer extends SQLOptimizer {

	/**
	 * DB-specific data grouping by date functions
	 *
	 * @param string $groupBy
	 * @return string the sql part
	 */
	public static function buildGroupBySQL($groupBy) {
		$ts = ', timestamp/1000, "unixepoch"'; // just for saving space

		switch ($groupBy) {
			case 'year':
				return 'STRFTIME("%Y"' . $ts . ')';
				break;

			case 'month':
				return 'STRFTIME("%Y-%m"' . $ts . ')';
				break;

			case 'week':
				return 'STRFTIME("%Y %W"' . $ts . ')';
				break;

			case 'day':
				return 'STRFTIME("%Y-%m-%d"' . $ts . ')';
				break;

			case 'hour':
				return 'STRFTIME("%Y-%m-%d %H"' . $ts . ')';
				break;

			case 'minute':
				return 'STRFTIME("%Y-%m-%d %H:%M"' . $ts . ')';
				break;

			case 'second':
				return 'STRFTIME("%Y-%m-%d %H:%M:%S"' . $ts . ')';
				break;

			default:
				return FALSE;
		}
	}
}

?>