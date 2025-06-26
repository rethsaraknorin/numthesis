<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => ['nullable', 'string', 'max:25'],
            'photo' => ['nullable', 'mimetypes:image/jpeg,image/png,image/jpg,image/webp', 'max:1024'],
            
            // UPDATED: More robust validation logic for the Student ID
            'student_id' => [
                'nullable', 
                'string', 
                'max:255', 
                function ($attribute, $value, $fail) {
                    if (empty($value)) {
                        return; // If the field is empty, skip the rest of the validation
                    }

                    // Find if another user is already using this student ID
                    $existingUser = User::where('student_id', $value)
                                      ->where('id', '!=', Auth::id())
                                      ->first();

                    // If another user has this ID, fail validation.
                    if ($existingUser) {
                        // Provide a different message depending on their status.
                        if ($existingUser->is_approved) {
                            $fail('This Student ID has already been assigned to an approved student.');
                        } else {
                            $fail('This Student ID has already been submitted and is pending verification.');
                        }
                    }
                },
            ],

            'promotion_name' => ['nullable', 'string', 'max:255'],
            'group_name' => ['nullable', 'string', 'max:255'],
        ];
    }
}