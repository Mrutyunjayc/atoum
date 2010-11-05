<?php

namespace mageekguy\atoum\report\fields\runner;

use \mageekguy\atoum;
use \mageekguy\atoum\report;

class failures extends report\fields\runner
{
	protected $runner = null;

	public function getRunner()
	{
		return $this->runner;
	}

	public function setWithRunner(atoum\runner $runner, $event = null)
	{
		if ($this->runner !== $runner)
		{
			$this->runner = $runner;
		}

		return $this;
	}

	public function toString()
	{
		$string = '';

		if ($this->runner !== null)
		{
			$fails = $this->runner->getScore()->getFailAssertions();

			$numberOfFails = sizeof($fails);

			if ($numberOfFails > 0)
			{
				$string .= sprintf($this->locale->__('There is %d failure:', 'There are %d failures:', $numberOfFails), $numberOfFails) . PHP_EOL;

				foreach ($fails as $fail)
				{
					$string .= '  ' . $fail['class'] . '::' . $fail['method'] . '():' . PHP_EOL;
					$string .= '    ' . sprintf($this->locale->_('In file %s on line %d, %s failed because %s'), $fail['file'], $fail['line'], $fail['asserter'], $fail['fail']) . PHP_EOL;
				}
			}
		}

		return $string;
	}
}

?>
