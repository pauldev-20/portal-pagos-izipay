<?php

namespace App\Http\Requests\Pago;

use App\Http\Requests\BaseFormRequest;

class validateServiciosRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'pagos' => [
                'required',
                'array',
                'min:1'
            ],
            'pagos.*.numero' => [
                'required',
                'integer',
                'exists:pagos,numero'
            ],
        ];
    }
}
