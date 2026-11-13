<?php

namespace App\Http\Controllers;

use App\Services\StatementService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Printable / PDF statements (same data as the on-screen statements).
 */
class StatementController extends Controller
{
    public function __construct(private StatementService $statements) {}

    public function print(Request $request, string $kind, int $id)
    {
        return view('ams.statements.print', $this->data($request, $kind, $id) + ['forPdf' => false]);
    }

    public function pdf(Request $request, string $kind, int $id)
    {
        $data = $this->data($request, $kind, $id);
        $pdf = Pdf::loadView('ams.statements.print', $data + ['forPdf' => true])->setPaper('a4', 'landscape');

        return $pdf->download(Str::slug($data['title'].' '.$data['name']).'-'.now()->format('Ymd').'.pdf');
    }

    private function data(Request $request, string $kind, int $id): array
    {
        abort_unless(StatementService::canView($request->user(), $kind, $id), 403);

        $validated = $request->validate([
            'company' => ['nullable', 'integer', 'min:0'], // 0: no company (the cash pot)
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
        ]);

        $company = isset($validated['company']) ? (int) $validated['company'] : null;
        abort_if($company && ! \App\Models\Company::withTrashed()->whereKey($company)->exists(), 404);

        return $this->statements->build($kind, $id, $company, $validated['from'] ?? null, $validated['to'] ?? null)
            + ['query' => array_filter($validated, fn ($v) => $v !== null && $v !== '')];
    }
}
