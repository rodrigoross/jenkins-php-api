<?php

namespace RodrigoRoss\Jenkins;

use RodrigoRoss\Jenkins;

class Factory
{

    /**
     * @param string $url
     *
     * @return Jenkins
     */
    public function build($url)
    {
        return new Jenkins($url);
    }
}
