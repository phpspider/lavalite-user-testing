<?php

namespace Test\Test\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class TestListPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TestListTransformer();
    }
}