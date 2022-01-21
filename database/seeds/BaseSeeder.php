<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

abstract class BaseSeeder extends Seeder
{
    protected $dropOld = false;

    protected $primaryColumn = 'id';

    protected $table;

    protected $class;

    abstract public function getData() : array ;

    public function run()
    {
        if ($this->class) {
            $this->runByClass($this->class);
            return;
        }

        if (empty($this->table)) {
            $class = class_basename($this);
            $this->table = str_replace('TableSeeder', '', $class);
            $this->table = Str::snake($this->table);
            $this->table = Str::plural($this->table);
        }

        $dataList = collect($this->getData());

        if ($this->dropOld) {
            DB::table($this->table)->delete();
            DB::table($this->table)->insert($dataList);
        } else {
            DB::table($this->table)->whereNotIn($this->primaryColumn, $dataList->pluck($this->primaryColumn))->delete();
            foreach ($dataList as $data) {
                DB::table($this->table)->updateOrInsert([$this->primaryColumn => $data[$this->primaryColumn]], $data);
            }
        }
    }

    public function runByClass($class)
    {
        $dataList = collect($this->getData());

        if ($this->dropOld) {
            $class::delete();
            $class::insert($dataList);
        } else {
            $class::whereNotIn($this->primaryColumn, $dataList->pluck($this->primaryColumn))->delete();
            foreach ($dataList as $data) {
                $class::updateOrCreate([$this->primaryColumn => $data[$this->primaryColumn]], $data);
            }
        }
    }

}
