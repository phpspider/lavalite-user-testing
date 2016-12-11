<?php

namespace Test\Test\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class TestItemPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TestItemTransformer();
    }
}