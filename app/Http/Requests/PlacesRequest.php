<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlacesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            "name" => "required|string|min:3|max:255",
            "slug" => "required|string|min:3|max:255",
            "city" => "required|string|min:3|max:50",
            "state" => "required|string|min:2|max:50",
        ];

        if ($this->isMethod("patch")) {
            $rules["name"] = "sometimes|string|min:3|max:255";
            $rules["slug"] = "sometimes|string|min:3|max:255";
            $rules["city"] = "sometimes|string|min:3|max:50";
            $rules["state"] = "sometimes|string|min:2|max:50";
        }

        return $rules;
    }


    public function messages(): array
    {
        return [
            "name.required" => "The name field is required.",
            "name.string" => "The name field must be a text.",
            "name.min" => "The name field must have at least :min characters.",
            "name.max" => "The name field must have at most :max characters.",

            "slug.required" => "The slug field is required.",
            "slug.string" => "The slug field must be a text.",
            "slug.min" => "The slug field must have at least :min characters.",
            "slug.max" => "The slug field must have at most :max characters.",

            "city.required" => "The city field is required.",
            "city.string" => "The city field must be a text.",
            "city.min" => "The city field must have at least :min characters.",
            "city.max" => "The city field must have at most :max characters.",

            "state.required" => "The state field is required.",
            "state.string" => "The state field must be a text.",
            "state.min" => "The state field must have at least :min characters.",
            "state.max" => "The state field must have at most :max characters.",
        ];
    }
}
