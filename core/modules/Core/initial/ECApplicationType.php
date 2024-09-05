<?php

namespace Core\initial;

enum ECApplicationType: string
{
    case WEB = 'AT_W';
    case MEDIA = 'AT_M';
    case CRON = 'AT_C';
    case AJAX = 'AT_A';
    case REST = 'AT_R';
    case PUP_API = 'AT_PA';
    case SEC_API = 'AT_SA';
    case CMD = 'CMD';
}