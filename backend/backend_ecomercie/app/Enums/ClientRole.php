<?php

namespace App\Enums;

enum ClientRole: string
{
    case ADMIN = 'admin';

    case CUSTOMER = 'customer';
}