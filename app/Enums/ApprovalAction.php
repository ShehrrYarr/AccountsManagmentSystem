<?php

namespace App\Enums;

enum ApprovalAction: string
{
    use HasOptions;

    case ClearCheque = 'clear_cheque';
    case BounceCheque = 'bounce_cheque';
    case CancelCheque = 'cancel_cheque';
    case PostDisbursement = 'post_disbursement';
    case UpdateRecord = 'update_record';
    case DeleteRecord = 'delete_record';

    public function label(): string
    {
        return match ($this) {
            self::ClearCheque => 'Clear Cheque',
            self::BounceCheque => 'Mark Cheque Bounced',
            self::CancelCheque => 'Cancel Cheque',
            self::PostDisbursement => 'Post Disbursement',
            self::UpdateRecord => 'Edit Record',
            self::DeleteRecord => 'Delete Record',
        };
    }
}
