<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalcBinanceModel extends Model
{
    //
    protected $table = 'calculator_binance';
    public $timestamps = false;

    protected $appends = ['max_price', 'min_price', 'go_price'];

    protected function getTableColumn()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function getMaxPriceAttribute()
    {
        $data = $this->getAllColumnValue();

        if (empty($data)) {
            return 0;
        }

        return max($data);
    }

    public function getMinPriceAttribute()
    {
        $data = $this->getAllColumnValue();

        if (empty($data)) {
            return 0;
        }

        return min($data);
    }

    public function getGoPriceAttribute()
    {
        $data = $this->getAllColumnValue();

        $min = empty($data) ? 0 : min($data);
        $max = empty($data) ? 0 : max($data);

        $go_price = $max == 0 ? 0 : (($max-$min)/$max)*100;
        $go_price = round($go_price, 2);

        return $go_price;
    }

    protected function getAllColumnValue()
    {
        $columns = $this->getTableColumn();
        $data = [];
        $ignoreColumn = ['id', 'coinname'];

        foreach($columns as $column) {
            // array_push($data, $this->$column);
            if (!in_array($column, $ignoreColumn) && $this->$column > 0) {
                array_push($data, $this->$column);
            }
        }
        return $data;
    }

}
