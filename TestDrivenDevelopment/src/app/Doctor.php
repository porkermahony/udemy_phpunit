<?php

namespace App;

class Doctor extends AbstractPerson
{
    protected function getTitle()
    {
        return 'Dr.';
    }
}