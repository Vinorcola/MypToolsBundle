<?php

namespace Myp\ToolsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Myp\ToolsBundle\DependencyInjection\MypToolsExtension;

class MypToolsBundle extends Bundle
{
    /**
     * {@inheritdoc}
     * @return MypToolsExtension
     */
    public function getContainerExtension()
    {
        return new MypToolsExtension();
    }
}
