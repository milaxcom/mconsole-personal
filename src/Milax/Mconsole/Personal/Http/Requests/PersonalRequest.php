<?php

namespace Milax\Mconsole\Personal\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Milax\Mconsole\Personal\Models\Person;

class PersonalRequest extends FormRequest
{
    /**
     * Create new instance
     */
    public function __construct()
    {
        //
    }

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
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'PUT':
            case 'UPDATE':
                return [
                    'slug' => 'max:255|unique:people,slug,' . $this->personal,
                    'name' => 'required|max:255',
                    'weight' => 'required',
                ];
                break;

            default:
                return [
                    'slug' => 'max:255|unique:people',
                    'name' => 'required|max:255',
                    'weight' => 'required',
                ];
        }
    }

    /**
     * Set custom validator attribute names
     *
     * @return Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->setAttributeNames(trans('mconsole::personal.form'));

        return $validator;
    }
}
