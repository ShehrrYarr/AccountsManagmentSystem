<?php

namespace App\Models\Contracts;

/**
 * A source document (cheque, payment, transfer...) that knows its own journal postings.
 * LedgerService::sync() voids whatever the document posted before and posts these again,
 * so creating and editing a document are the same operation.
 */
interface PostsToLedger
{
    /**
     * @return array<int, array{type: \App\Enums\TransactionType, date: mixed, lines: array, attributes?: array}>
     */
    public function ledgerPostings(): array;
}
