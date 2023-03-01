<?php

namespace App\Http\Requests;

use App\Http\Services\VinDecoderServices as Vincode;
use App\Models\Car;
use Illuminate\Validation\Rule;

class CarFormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'country_number' => ['required', 'string'],
            'color' => ['nullable', 'string'],
            'vin_code' => [
                'required',
                 Rule::unique('cars',  'vin_code')->ignore(($this->route('car'))?$this->route('car')->id:$this->route('auto'), 'id')
            ],
            'make' => ['required', 'string'],
            'year' => ['required'],
            'model' => ['required']
        ];
    }

    protected function prepareForValidation()
    {
        $vin = (new Vincode)->decode($this->vin_code);

        $this->merge($vin);
    }

    public function attributes()
    {
        return [
            'id' => 'первинний ключ',
            'name' => 'Ім\'я',
            'country_number' => 'Державний номер',
            'color' => 'Колір автомобіля',
            'vin_code' => 'Vin-code',
            'model' => 'Модель автомобіля',
            'year' => 'Рік автомобіля',
            'make' => 'Виробник',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Вкажіть ім\'я',
            'name.min' => 'Слово не менше з 5 літер',
            'country_number.required' => 'Вкажіть колір',
            'vin_code.required' => 'Вкажіть vin-code',
            'model.required' => 'В базі немає данних яка це модель',
            'make.required' => 'В базі немає данних про виробника',
            'vin_code.unique' => 'Цей vin-code вже існує',
        ];
    }
}
