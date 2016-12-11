<?php

namespace Test\Test;

class Test
{
    /**
     * $test object.
     */
    protected $test;

    /**
     * Constructor.
     */
    public function __construct(\Test\Test\Interfaces\TestRepositoryInterface $test)
    {
        $this->test = $test;
    }

    /**
     * Returns count of test.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count()
    {
        return  0;
    }
}
