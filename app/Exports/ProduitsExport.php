<?php

namespace App\Exports;

use App\Models\produits;
use Rap2hpoutre\FastExcel\FastExcel;

class ProduitsExport
{
    public function exportToExcel()
    {
        $produits = produits::select('id', 'nom', 'description', 'id_category', 'prix', 'qte', 'photo', 'created_at', 'updated_at')->get();

        return (new FastExcel($produits))->export('produits.xlsx');
    }
}
