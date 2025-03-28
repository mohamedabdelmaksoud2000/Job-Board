<?php

namespace App\Rules;

use App\Models\Attribute;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AttributeValueRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $attributeId = request()->input(str_replace('.value', '.attribute_id', $attribute));

        $attribute = Attribute::find($attributeId);

        if (!$attribute) {
            $fail('The selected attribute does not exist.');
            return;
        }

        if ($attribute->type === 'select') {
            $options = json_decode($attribute->options, true);
            if (!in_array($value, $options)) {
                $fail("The value must be one of the allowed options: " . implode(', ', $options));
            }
        }
    }
}
