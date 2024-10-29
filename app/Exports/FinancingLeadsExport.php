<?php
namespace App\Exports;

use App\Models\financing_leads;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FinancingLeadsExport implements FromView
{
    protected $request = [];

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $filter = $this->request;
        unset($filter['token']);
        if($filter['hidden_export_by'] == 0 || $filter['hidden_export_by'] == 1){
            $data = financing_leads::where('is_delete',0)->where('varStatus', $filter['hidden_export_by'])->orderby('created_at','desc')->get();
        }else{
            $data = financing_leads::where('is_delete',0)->orderby('created_at','desc')->get(); 
        }
        
        return view('admin.financing_lead.export_excel', [
            'data' => $data
        ]);
    }
}