<?php
/**
Copyright (c) 2013 Christophe Coevoet <stof@notk.org>

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
 */
use Prophecy\Prophet;

trait Prophecy
{
    private $prophet;
    private $prophecyAssertionsCounted = false;

    protected function prophesize($classOrInterface = null)
    {
        return $this->getProphet()->prophesize($classOrInterface);
    }

    protected function verifyMockObjects()
    {
        parent::verifyMockObjects();
        if (null === $this->prophet) {
            return;
        }
        try {
            $this->prophet->checkPredictions();
        } catch (\Exception $e) {
            /** Intentionally left empty */
        }
        $this->countProphecyAssertions();
        if (isset($e)) {
            throw $e;
        }
    }

    protected function tearDown()
    {
        if (null !== $this->prophet && !$this->prophecyAssertionsCounted) {
            // Some Prophecy assertions may have been done in tests themselves even when a failure happened before checking mock objects.
            $this->countProphecyAssertions();
        }
        $this->prophet = null;
    }

    protected function onNotSuccessfulTest(\Exception $e)
    {
        if ($e instanceof PredictionException) {
            $e = new \PHPUnit_Framework_AssertionFailedError($e->getMessage(), $e->getCode(), $e);
        }
        return parent::onNotSuccessfulTest($e);
    }

    private function getProphet()
    {
        if (null === $this->prophet) {
            $this->prophet = new Prophet();
        }
        return $this->prophet;
    }

    private function countProphecyAssertions()
    {
        $this->prophecyAssertionsCounted = true;
        foreach ($this->prophet->getProphecies() as $objectProphecy) {
            foreach ($objectProphecy->getMethodProphecies() as $methodProphecies) {
                foreach ($methodProphecies as $methodProphecy) {
                    $this->addToAssertionCount(count($methodProphecy->getCheckedPredictions()));
                }
            }
        }
    }
} 