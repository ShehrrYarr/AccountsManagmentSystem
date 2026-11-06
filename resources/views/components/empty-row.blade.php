@props(['colspan' => 1, 'icon' => 'ri-inbox-line', 'message' => 'No records found.'])

<tr>
    <td colspan="{{ $colspan }}" class="text-center text-muted py-5">
        <i class="{{ $icon }} fs-32 d-block mb-2 opacity-50"></i>
        {{ $message }}
    </td>
</tr>
