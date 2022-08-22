<?php

namespace Modules\Reservations\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            /** validation rules goes here  */
        ];
        return $rules;
    }

    /**
     * Handle Errors
     *
     * @return Response
     */
    public function validateResolved()
    {
        try {
            parent::validateResolved();
        } catch (\Exception $e) {
            // prepare error response here
            die();
        }
    }
}