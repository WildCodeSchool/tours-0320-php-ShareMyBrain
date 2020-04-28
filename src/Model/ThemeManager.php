<?php

namespace App\Model;

class ThemeManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'theme';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

}
