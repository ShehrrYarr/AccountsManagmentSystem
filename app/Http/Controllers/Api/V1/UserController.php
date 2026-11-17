<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\UserRole;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use App\Services\DirectoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * Admin: users & agents, and the app devices each one is signed in on. Deactivating a user signs
 * out all their devices; one device can also be signed out on its own (e.g. a lost phone).
 */
class UserController extends ApiController
{
    public function __construct(private DirectoryService $directory) {}

    public function index(Request $request): JsonResponse
    {
        $this->requireAdmin($request);
        $users = User::whereIn('role', [UserRole::Admin, UserRole::Agent])
            ->when($request->query('role'), fn ($q, $r) => $q->where('role', $r))
            ->withCount(['cheques', 'agentAccounts', 'tokens'])->orderBy('role')->orderBy('name')->get()
            ->map(fn (User $u) => (new UserResource($u))->toArray($request) + [
                'cheques_count' => $u->cheques_count,
                'accounts_count' => $u->agent_accounts_count,
                'devices_count' => $u->tokens_count,
            ]);

        return response()->json(['data' => $users]);
    }

    public function show(Request $request, int $user): JsonResponse
    {
        $this->requireAdmin($request);
        $u = User::findOrFail($user);

        return response()->json(['data' => (new UserResource($u))->toArray($request) + ['devices' => AuthController::deviceList($u, $request)]]);
    }

    public function store(Request $request): JsonResponse
    {
        $this->requireAdmin($request);
        $u = $this->directory->saveUser(null, $request->validate($this->rules(null)), $request->user());

        return (new UserResource($u))->response()->setStatusCode(201);
    }

    /** Edit; send is_active=false to deactivate (signs out all their devices). */
    public function update(Request $request, int $user): UserResource
    {
        $this->requireAdmin($request);
        $u = User::findOrFail($user);
        $data = array_merge($u->only(['name', 'email', 'phone', 'is_active']) + ['role' => $u->role->value], $request->validate($this->rules($u->id, partial: true)));

        return new UserResource($this->directory->saveUser($u, $data, $request->user()));
    }

    public function devices(Request $request, int $user): JsonResponse
    {
        $this->requireAdmin($request);

        return response()->json(['data' => AuthController::deviceList(User::findOrFail($user), $request)]);
    }

    public function revokeDevice(Request $request, int $user, int $device): JsonResponse
    {
        $this->requireAdmin($request);
        User::findOrFail($user)->tokens()->whereKey($device)->firstOrFail()->delete();

        return response()->json(['message' => 'Device signed out.']);
    }

    private function rules(?int $ignore, bool $partial = false): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($ignore)],
            'phone' => ['nullable', 'string', 'max:30'],
            'role' => ['required', Rule::in([UserRole::Admin->value, UserRole::Agent->value])],
            'is_active' => ['boolean'],
            'password' => [$ignore ? 'nullable' : 'required', 'confirmed', Password::defaults()],
        ];

        return $partial ? array_map(fn ($r) => ['sometimes', ...$r], $rules) : $rules;
    }
}
