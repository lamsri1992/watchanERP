<?php

namespace App\Imports;

use App\Models\Salary;
use Maatwebsite\Excel\Concerns\ToModel;
use File;

class otImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Salary([
            'acc_no' => $row['6'],
            'salary' => $row['7'],
            'sal_1' => $row['8'],
            'tax' => $row['9'],
            'sal_tax' => $row['10'],
            'pos_incom' => $row['11'],
            'son' => $row['12'],
            'school' => $row['13'],
            'ot' => $row['14'],
            'health' => $row['15'],
            'store' => $row['16'],
            'life' => $row['17'],
            't_inc' => $row['18'],
            'other_income' => $row['19'],
            't_income' => $row['20'],
            'co_ordinate' => $row['21'],
            'dead' => $row['22'],
            'car' => $row['23'],
            'house' => $row['24'],
            'trat_store' => $row['25'],
            'save_life' => $row['26'],
            'sav_1' => $row['27'],
            'water_elect' => $row['28'],
            'other_pay' => $row['29'],
            't_pay' => $row['30'],
            'total_income' => $row['31'],
            'sum_income' => $row['32'],
            'sum_tax' => $row['33'],
            'id' => $row['34'],
            'i1' => $row['35'],
            'i2' => $row['36'],
            'i3' => $row['37'],
            'i4' => $row['38'],
            'i5' => $row['39'],
            'i6' => $row['40'],
            'i7' => $row['41'],
            'sumincome' => $row['42'],
            'p1' => $row['43'],
            'p2' => $row['44'],
            'p3' => $row['45'],
            'p4' => $row['46'],
            'p5' => $row['47'],
            'p6' => $row['48'],
            'p7' => $row['49'],
            'sumpay' => $row['50'],
            'netincome' => $row['51'],
            'totalnet' => $row['52'],
            'year' => $row['53'],
            'month' => $row['54'],
            'salary_ot' => 1,
        ]);
    }
}
