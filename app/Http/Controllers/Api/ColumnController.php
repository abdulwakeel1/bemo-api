<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Column;
use App\Models\Card;

class ColumnController extends Controller
{
    public function getColumns(Request $request)
    {
        $columns = Column::with(['cards' => function ($query) {
            $query->orderBy('sort_order', 'asc');
        }])->orderBy('sort_order', 'asc')->get();

        return response()->json($columns);
    }

    public function store(Request $request)
    {
        $columnsCount = Column::count() + 1;
        
        $column = new Column();
        $column->title = 'Column ' . $columnsCount;
        $column->sort_order = $columnsCount;
        $column->save();
    
        for($i = 1; $i <= 3; $i++) {
            $card = new Card();
            $card->title = 'Card '.$i;
            $card->description = 'Card '.$i.' description';
            $card->column_id = $column->id;
            $card->save();
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'Column and Cards created successfully'
        ]);
    }


    public function destroy(Column $column)
    {
        // $column = Column::find($request->columnId);
        $column->delete();
        Card::where('column_id', $column->id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Column and Cards deleted successfully'
        ]);
    }
}
