<?php
namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên người đánh giá là bắt buộc',
            'content.required' => 'Nội dung đánh giá là bắt buộc',
        ];
    }
}
