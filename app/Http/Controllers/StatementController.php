<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\StatementService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Printable / PDF company statements (same data as the on-screen statement).
 */
class StatementController extends Controller
{
    public function __construct(private StatementService $statements) {}

    public function print(Request $request, Company $company)
    {
        return view('ams.companies.statement-print', $this->data($request, $company) + ['forPdf' => false]);
    }

    public function pdf(Request $request, Company $company)
    {
        $pdf = Pdf::loadView('ams.companies.statement-print', $this->data($request, $company) + ['forPdf' => true])
            ->setPaper('a4', 'portrait');

        return $pdf->download('statement-'.Str::slug($company->name).'-'.now()->format('Ymd').'.pdf');
    }

    private function data(Request $request, Company $company): array
    {
        $validated = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
        ]);

        return $this->statements->build($company, $validated['from'] ?? null, $validated['to'] ?? null);
    }
}
