<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StockMatchesStockColorWise implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $attributeParts = explode('.', $attribute);
        $index = $attributeParts[1];

        // Access the corresponding product_measurment_price_detail item
        $productMeasurmentPriceDetail = request()->input('product_measurment_price_detail')[$index];

        if (is_null($productMeasurmentPriceDetail['stock']) || in_array(null, $productMeasurmentPriceDetail['stock_color_wise'])) {
            return; // Skip validation if either stock or stock_color_wise contains null
        }

        // Calculate the total of stock_color_wise values
        $totalStockColorWise = array_sum(array_map('intval', $productMeasurmentPriceDetail['stock_color_wise']));

        // Check if the stock value matches the total of stock_color_wise values
        if ((int) $productMeasurmentPriceDetail['stock'] !== $totalStockColorWise) {
            $fail('The stock value must be equal to the total of stock color wise for item ' . ($index + 1) . '.');
        }
    }
}
