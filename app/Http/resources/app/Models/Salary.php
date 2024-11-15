<?php

namespace App\Models;

use App\Enums\Salaries\ModallyProfitCounterSalaryEnum;
use App\Enums\Salaries\ModallyProfitSalaryEnum;
use App\Enums\Salaries\ProfitOfSalaryEnum;
use App\Enums\Salaries\TaxesSalaryEnum;
use App\Enums\Salaries\TransportSalaryEnum;
use App\Enums\Salaries\TypeSalaryEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    /** @use HasFactory<\Database\Factories\SalaryFactory> */
    use HasFactory, HasUuids;

    protected $casts = [
        'type' => TypeSalaryEnum::class,
        'taxes' => TaxesSalaryEnum::class,
        'transport' => TransportSalaryEnum::class,
        'profit_of' => ProfitOfSalaryEnum::class,
        'modally_profit' => ModallyProfitSalaryEnum::class,
        'modally_profit_counter' => ModallyProfitCounterSalaryEnum::class,
    ];

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected function typeValue(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => (floor($attributes['type_value']) == $attributes['type_value']
                ? number_format($attributes['type_value'], 0, ',', '.')
                : number_format($attributes['type_value'], 2, ',', '.')),
            set: fn($value, $attributes) => [
                'type_value' => $attributes['type'] == 'percentage'
                    ? (str_replace(['$', '.', ','], ['', '', '.'], $value) >= 100 ? 100 : str_replace(['$', '.', ','], ['', '', '.'], $value)) :
                    str_replace(['$', '.', ','], ['', '', '.'], $value),
            ]
        );
    }

    protected function salary(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => (floor($attributes['salary']) == $attributes['salary']
                ? number_format($attributes['salary'], 0, ',', '.')
                : number_format($attributes['salary'], 2, ',', '.')),
            set: fn($value) => [
                'salary' => str_replace(['$', '.', ','], ['', '', '.'], $value),
            ]
        );
    }



    protected function taxesValue(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => (floor($attributes['taxes_value']) == $attributes['taxes_value']
                ? number_format($attributes['taxes_value'], 0, ',', '.')
                : number_format($attributes['taxes_value'], 2, ',', '.')),
            set: fn($value, $attributes) => [
                'taxes_value' => $attributes['taxes'] == 'percentage'
                    ? (str_replace(['$', '.', ','], ['', '', '.'], $value) >= 100 ? 100 : str_replace(['$', '.', ','], ['', '', '.'], $value)) :
                    str_replace(['$', '.', ','], ['', '', '.'], $value),
            ]
        );
    }

    public function getTaxDisplayFormatAttribute(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => ($attributes['taxes'] == 'fixed'
                ? '$'
                : '') . (floor($attributes['taxes_value']) == $attributes['taxes_value']
                ? number_format($attributes['taxes_value'], 0, ',', '.')
                : number_format($attributes['taxes_value'], 2, ',', '.')) . ($attributes['taxes'] == 'percentage'
                ? '%'
                : '')
        );
    }


    public function getTransportDisplayFormatAttribute(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => '$' . (floor($attributes['transport_value']) == $attributes['transport_value']
                ? number_format($attributes['transport_value'], 0, ',', '.')
                : number_format($attributes['transport_value'], 2, ',', '.'))
        );
    }


    public function getTypeValueDisplayFormatAttribute(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => ($attributes['type'] == 'commissions'
                ? '$'
                : '') . (floor($attributes['type_value']) == $attributes['type_value']
                ? number_format($attributes['type_value'], 0, ',', '.')
                : number_format($attributes['type_value'], 2, ',', '.')) . ($attributes['type'] == 'percentage'
                ? '%'
                : '')
        );
    }
}
