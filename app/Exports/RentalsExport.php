<?php

namespace App\Exports;

use App\RentalDate;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RentalsExport implements FromView
{

    public function __construct($rangedates)
    {
        $this->rangedates = $rangedates;
    }

    public function view(): View
    {
        $from = $this->rangedates->from;
        $to = $this->rangedates->to;
        $rentalDates = RentalDate::where('departure_date', '>=', $from)
            ->Where('admission_date', '<=', $to)
            ->get();

        foreach ($rentalDates as $rentalDate) {
            $rentalDate->withUserData();
            $rentalDate->withCarData();
        }

        return view('admin.exports.rentaldates', [
            'rentaldates' => $rentalDates
        ]);
    }
}
