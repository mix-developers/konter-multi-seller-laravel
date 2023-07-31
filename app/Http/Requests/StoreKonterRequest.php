<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKonterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'id_pemilik' => ['required'],
            'time_open' => ['required'],
            'time_close' => ['required'],
            'address' => ['required'],
            'thumbnail' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
