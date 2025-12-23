<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Enums;

enum TemplateStates: string
{
    case APPROVED = 'APPROVED';
    case REJECTED = 'REJECTED';
    case IN_APPEAL = 'IN_APPEAL';
    case PENDING = 'PENDING';
    case PENDING_DELETION = 'PENDING_DELETION';
    case DELETED = 'DELETED';
    case DISABLED = 'DISABLED';
    case LOCKED = 'LOCKED';
}
