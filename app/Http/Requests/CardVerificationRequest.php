<?php

namespace App\Http\Requests;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;
use Illuminate\Foundation\Http\FormRequest;

class CardVerificationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cardno' => ['required_unless:cashondelivery,null', new CardNumber],
            'year' => ['required', new CardExpirationYear($this->get('month'))],
            'month' => ['required', new CardExpirationMonth($this->get('year'))],
            'cvv' => ['required', new CardCvc($this->get('cardno'))],
            'cashondelivery' => ['nullable'],
            "firstname" => ['required'],
            "lastname" => ['required'],
            "email" =>    ['required','email'],
            "telephone" => ['required','numeric'],
            "company" => ['required'],
            "address_1" => ['required'],
            "address_2" => ['nullable'],
            "city" => ['required'],
            "postcode" => ['required','numeric'],
            "country_id" => ['required'],
            "zone_id" => ['required'],
            "notes" => ['nullable']
        ];
    }

    public function messages()
    {
        return [
            'cardno.required' => 'The card number is required.',
            'year.required' => 'The year is required.',
            'month.required' => 'The month is required.',
            'cvv.required' => 'The cvv is required.',
            'firstname.required' => 'The firstname is required.',
            'lastname.required' => 'The lastname is required.',
            'email.required' => 'The email is required.',
            'telephone.required' => 'The telephone is required.',
            'company.required' => 'The company is required.',
            'address_1.required' => 'The address is required.',
            'city.required' => 'The city is required.',
            'postcode.required' => 'The postcode is required.',
            'country_id.required' => 'The country is required.',
            'zone_id.required' => 'The state is required.'
        ];
    }

}
