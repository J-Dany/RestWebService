<?php

namespace Model;

use Model\Model;

class Observation extends Model
{
    public function prendiDati ($pk = null) : void
    {
        if (is_null($pk))
        {
            $this->prendiTutto();
        }
        else
        {
            $this->prendi($pk);
        }
    }
};