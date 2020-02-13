<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Command;
use App\Product;
use Illuminate\Http\Request;

class StoreCommand extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {

        if ($this->deliveryDate ?? false) {
            if (($this->status ?? 1) == Command::ENCOURS) {
                $this['deliveryDate'] =  null;
            } else {
                $this['deliveryDate'] =  date("Y-m-d H:i:s", strtotime($this['deliveryDate']));
            }
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:500',
            'status' => 'sometimes|in:' . Command::ENCOURS . ',' . Command::LIVRER . ',' . Command::ANNULER, // use reflection
            'deliveryDate' => 'required_if:status,' . Command::LIVRER . ',' . Command::ANNULER . '|nullable|date',
            'articles.*.qte' => 'integer',
            'article' => [
                function ($attribute, $value, $fail) {
                    // get models check their quantity
                    $products  = Product::whereIn(array_keys($value));
                    foreach ($products as $product) {
                        if ($product->qte < $value[$product->id]['qte']) {
                            $fail('In ' . $attribute . ' ' . $product->name . "'s quantity is greater than available stock");
                        }
                    }

                    foreach ($products as $product) {
                        $product->qte -= $value[$product->id]['qte'];
                        $product->save();
                    }
                },
            ],

        ];
    }
}
