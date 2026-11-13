<?php

namespace App\Http\Controllers;

use App\Models\Cheque;
use App\Models\ChequeChangeRequest;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\PaymentChangeRequest;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Serves private uploads to signed-in users. Agents may open only the pictures of cheques they
 * received, receipts of payments they made (and of their own change requests); everything else
 * is for the admin.
 */
class FileController extends Controller
{
    public function show(string $type, int $id): StreamedResponse
    {
        $user = auth()->user();

        $path = match ($type) {
            'cheque' => tap(Cheque::withTrashed()->findOrFail($id), fn ($c) => abort_unless($user->isAdmin() || $c->created_by === $user->id, 403))->scan_path,
            'cheque-request' => tap(ChequeChangeRequest::findOrFail($id), fn ($r) => abort_unless($user->isAdmin() || $r->requested_by === $user->id, 403))->changes['scan_path'] ?? null,
            'payment' => tap(Payment::withTrashed()->findOrFail($id), fn ($p) => abort_unless($user->isAdmin() || $p->created_by === $user->id, 403))->receipt_path,
            'payment-request' => tap(PaymentChangeRequest::findOrFail($id), fn ($r) => abort_unless($user->isAdmin() || $r->requested_by === $user->id, 403))->changes['receipt_path'] ?? null,
            'expense' => tap(Expense::withTrashed()->findOrFail($id), fn () => abort_unless($user->isAdmin(), 403))->receipt_path,
        };

        abort_unless($path && Storage::disk('local')->exists($path), 404);

        return Storage::disk('local')->response($path);
    }
}
