<?php

namespace Test\Test\Http\Requests;

use App\Http\Requests\Request as FormRequest;
use Illuminate\Http\Request;
use Gate;

class TestUserWebRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $test = $this->route('test');
        if (is_null($test)) {
            // Determine if the user is authorized to access test module,
            return $request->user('web')->canDo('test.test.view');
        }

        if ($request->isMethod('POST') || $request->is('*/create')) {
            // Determine if the user is authorized to create an entry,
            return $request->user('web')->can('create', $test);
        }

        if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit')) {
            // Determine if the user is authorized to update an entry,
            return $request->user('web')->can('update', $test);
        }

        if ($request->isMethod('DELETE')) {
            // Determine if the user is authorized to delete an entry,
            return $request->user('web')->can('destroy', $test);
        }

        // Determine if the user is authorized to view the module.
        return $request->user('web')->can('view', $test);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if ($request->isMethod('POST')) {
            // validation rule for create request.
            return [
                'name'                => 'required',
            ];
        }
        if ($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            // Validation rule for update request.
            return [
                'name'                => 'required',
            ];
        }

        // Default validation rule.
        return [

        ];
    }
}
