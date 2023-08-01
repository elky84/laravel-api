<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class PaginationRequest extends FormRequest
{
    const DEFAULT_PAGE_NUMBER = 1;
    const DEFAULT_PER_PAGE = 10;

    const MESSAGE_CODE = 'BAD_REQUEST';

    protected $stopOnFirstFailure = false;

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'code' => self::MESSAGE_CODE,
                'message' => $validator->messages()->first(),
                'errors' => $validator->errors(),
            ], Response::HTTP_BAD_REQUEST)
        );
    }

    protected function getValidatorInstance(): Validator
    {
        $data = $this->all();

        $data['page'] = isset($data['page']) ? intval($data['page']) : self::DEFAULT_PAGE_NUMBER;
        $data['per_page'] = isset($data['per_page']) ? intval($data['per_page']) : self::DEFAULT_PER_PAGE;

        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }

    public function rules(): array
    {
        return [
            'page' => ['required', 'integer', 'min:1'],
            'per_page' => ['required', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function getPage(): int
    {
        return $this->get('page', 1);
    }

    public function getPerPage(): int
    {
        return $this->get('per_page', self::DEFAULT_PER_PAGE);
    }
}
