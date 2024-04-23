<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataPeminjamanExport implements FromCollection
{
    protected $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::getPeminjaman($this->name);
    }

    public function headings(): array
    {
        return array_keys($this->collection()->first());
    }
}
