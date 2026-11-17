<?php

namespace App\Services;

use App\Exceptions\BusinessRuleException;
use App\Models\Department;
use App\Models\ExpenseCategory;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;

/**
 * Departments, suppliers, expense categories and users: the rules shared by the website and the
 * API. Records with history are deactivated instead of deleted.
 */
class DirectoryService
{
    public const DEPARTMENT_FIELDS = ['name', 'code', 'city', 'contact_person', 'phone', 'notes', 'is_active'];

    public const SUPPLIER_FIELDS = ['name', 'contact_person', 'phone', 'ntn', 'address', 'is_active'];

    public function saveDepartment(?Department $department, array $data): Department
    {
        $department ??= new Department(['is_active' => true]);
        $department->fill(Arr::only($data, self::DEPARTMENT_FIELDS))->save();

        return $department;
    }

    /** @return 'deleted'|'deactivated' */
    public function deleteDepartment(Department $department): string
    {
        if ($department->ledgerEntries()->exists() || $department->cheques()->withTrashed()->exists() || $department->payments()->withTrashed()->exists()) {
            $department->update(['is_active' => false]);

            return 'deactivated';
        }
        $department->delete();

        return 'deleted';
    }

    public function saveSupplier(?Supplier $supplier, array $data): Supplier
    {
        $supplier ??= new Supplier(['is_active' => true]);
        $supplier->fill(Arr::only($data, self::SUPPLIER_FIELDS))->save();

        return $supplier;
    }

    /** @return 'deleted'|'deactivated' */
    public function deleteSupplier(Supplier $supplier): string
    {
        if ($supplier->ledgerEntries()->exists() || $supplier->payments()->withTrashed()->exists() || $supplier->supplierPayments()->withTrashed()->exists()) {
            $supplier->update(['is_active' => false]);

            return 'deactivated';
        }
        $supplier->delete();

        return 'deleted';
    }

    public function saveCategory(?ExpenseCategory $category, array $data): ExpenseCategory
    {
        $category ??= new ExpenseCategory(['is_active' => true]);
        $category->fill(Arr::only($data, ['name', 'is_active']))->save();

        return $category;
    }

    /** @return 'deleted'|'deactivated' */
    public function deleteCategory(ExpenseCategory $category): string
    {
        if ($category->expenses()->exists()) {
            $category->update(['is_active' => false]);

            return 'deactivated';
        }
        try {
            $category->delete();

            return 'deleted';
        } catch (QueryException) {
            $category->update(['is_active' => false]); // still referenced by deleted (history) records

            return 'deactivated';
        }
    }

    /**
     * Create / update an administrator or agent. Nobody can demote or deactivate themselves; every
     * agent gets a cash in hand. An empty password keeps the current one.
     */
    public function saveUser(?User $user, array $data, User $by): User
    {
        $data = Arr::only($data, ['name', 'email', 'phone', 'role', 'is_active', 'password']);

        if ($user?->id === $by->id && (($data['role'] ?? $user->role->value) !== 'admin' || ! ($data['is_active'] ?? $user->is_active))) {
            throw new BusinessRuleException('You cannot demote or deactivate your own account.', 'role');
        }
        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        if ($user) {
            $user->update($data);
        } else {
            $user = User::create($data);
            $user->forceFill(['email_verified_at' => now()])->save();
        }

        if ($user->isAgent()) {
            app(MasterDataService::class)->ensureAgentCash($user, $by);
        }

        return $user;
    }

    public function setActive(User $user, bool $active, User $by): User
    {
        if ($user->id === $by->id && ! $active) {
            throw new BusinessRuleException('You cannot deactivate yourself.', 'is_active');
        }
        $user->update(['is_active' => $active]); // deactivation signs out every app device (User::booted)

        return $user;
    }
}
