<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class EXportCarte extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        
        // CREATE WORKSHEET
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle("First Sheet");

            // SINGLE CELL
            // GET SINGLE CELL THEN SET VALUE
            $cell = $sheet->getCell("A1");
            $cell->setValue("Hello");

            // (C2) MORE WAYS SET VALUE
                $sheet->setCellValue("A2", "World!");
                /* $sheet->setCellValueByColumnAndRow(1, 3, "FOO!"); */

            // (C4) GET HIGHEST ROW + COL
            $highestRow = $sheet->getHighestRow();
            $highestCol = $sheet->getHighestColumn();
 
// TIP - You can use $highestRow $highestCol to loop through the cells.
// for ($i=0; i<$highest; i++) { ... }


            // (D) RANGE OF CELLS
            // (D1) GET SELECTED RANGE INTO AN ARRAY
            $data = $sheet->rangeToArray("A1:A3");
            
            // (D2) SET DATA FROM ARRAY INTO CELLS
            $data = [100, 53, 86];
            $data = array_chunk($data, 1);
            $sheet->fromArray($data, null, "B1");
            
            // (E) FORMULAS ACCEPTED - JUST AS IN EXCEL
            $sheet->setCellValue("B4", "=SUM(B1:B3)");
            
            // (F) SAVE TO SERVER
            $writer = new Xlsx($spreadsheet);
            $writer->save("5-cells.xlsx");
    }
}
