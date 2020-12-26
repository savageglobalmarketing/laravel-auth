<?php

namespace SavageGlobalMarketing\Auth\Http\Requests;

use SavageGlobalMarketing\Foundation\Traits\ValidPagination;
use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
{
    use ValidPagination;

    protected $internID;

    protected array $fillable = ['name'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->internID = $this->route('tenant');

        $method = strtolower($this->method()) . 'Rules';

        return $this->$method();
    }

    /**
     * Get the validation rules that applies to POST request.
     *
     * @return array
     */
    private function postRules()
    {
        return [
			'name' => '',
		];
    }

    /**
     * Get the validation rules that applies to PUT request.
     *
     * @return array
     */
    private function putRules()
    {
        return [
			'name' => '',
		];
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
}
