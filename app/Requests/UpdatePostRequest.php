<?php
namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên bài viết là bắt buộc',
            'description.required' => 'Mô tả sợ lược bài viết là bắt buộc',
            'content.required' => 'Nội dung bài viết là bắt buộc',
        ];
    }
}
