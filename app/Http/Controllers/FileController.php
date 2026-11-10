<?php

namespace App\Http\Controllers;

use App\Models\Cheque;
use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Serves private uploads to signed-in users only.
 */
class FileController extends Controller
{
    public function show(string $type, int $id): StreamedResponse
    {
        $path = match ($type) {
            'cheque' => Cheque::withTrashed()->findOrFail($id)->scan_path,
            'payment' => Payment::withTrashed()->findOrFail($id)->receipt_path,
            'expense' => Expense::withTrashed()->findOrFail($id)->receipt_path,
        };

        abort_unless($path && Storage::disk('local')->exists($path), 404);

        return Storage::disk('local')->response($path);
    }
}
