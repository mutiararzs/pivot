<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public const LEVELS = ['SMA', 'SMK', 'MA'];

    /** @return list<string> contoh: "10 IPA", "12 IPS" */
    public static function classOptions(): array
    {
        $out = [];
        foreach ([10, 11, 12] as $grade) {
            foreach (['IPA', 'IPS'] as $program) {
                $out[] = "$grade $program";
            }
        }

        return $out;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'phone' => [
                'required',
                'string',
                'max:20',
                function (string $attribute, mixed $value, \Closure $fail) {
                    $digits = preg_replace('/\D/', '', (string) $value);
                    if (strlen($digits) < 9 || strlen($digits) > 15) {
                        $fail('Nomor WhatsApp tidak valid.');
                    }
                },
            ],
            'school' => ['required', 'string', 'max:150'],
            'level' => ['required', Rule::in(self::LEVELS)],
            'kelas' => ['required', Rule::in(self::classOptions())],
            'city' => ['required', 'string', 'max:100'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nama lengkap',
            'email' => 'email',
            'tanggal_lahir' => 'tanggal lahir',
            'phone' => 'nomor WhatsApp',
            'school' => 'asal sekolah',
            'level' => 'jenjang',
            'kelas' => 'kelas',
            'city' => 'kota / kabupaten',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':Attribute wajib diisi.',
            'min' => ':Attribute terlalu pendek.',
            'max' => ':Attribute terlalu panjang.',
            'email' => 'Format email tidak valid.',
            'unique' => 'Email sudah digunakan.',
            'before' => 'Tanggal lahir harus sebelum hari ini.',
            'date' => 'Tanggal lahir tidak valid.',
            'in' => ':Attribute tidak valid.',
        ];
    }
}