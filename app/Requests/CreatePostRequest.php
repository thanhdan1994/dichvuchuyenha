<?php
namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'content' => 'required',
            'thumbnail' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên bài viết là bắt buộc',
            'description.required' => 'Mô tả sợ lược bài viết là bắt buộc',
            'content.required' => 'Nội dung bài viết là bắt buộc',
            'thumbnail.required' => 'Ảnh đại diện cho bài viết là bắt buộc',
        ];
    }
}
