<?php

namespace Core\initial\exceptions;

enum ECApplicationType: string
{
    case WEB = 'AT_W';
    case MEDIA = 'AT_M';
    case CRON = 'AT_C';
    case AJAX = 'AT_A';
    case REST = 'AT_R';
    case CMD = 'CMD';
}