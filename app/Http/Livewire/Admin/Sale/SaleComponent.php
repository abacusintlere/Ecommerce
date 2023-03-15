<?php

namespace App\Http\Livewire\Admin\Sale;

use App\Models\Sale;
use Livewire\Component;

class SaleComponent extends Component
{
    public $sale_date, $status, $sale_id;

    public function mount()
    {
        $sale = Sale::first();
        $this->sale_date = $sale->sale_date;
        $this->status = $sale->status;
        $this->sale_id = $sale->id;
    }

    // Updated Hook
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'sale_date' => 'required',
            'status' => 'required'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.sale.sale-component')->layout('layouts.base');
    }

    public function update()
    {
        $this->validate([
            'sale_date' => 'required',
            'status' => 'required'
        ]);
        $sale = Sale::find($this->sale_id);
        $sale->sale_date = $this->sale_date;
        $sale->status = $this->status;
        $sale->update();

        session()->flash('success_message', 'Sale Settings Updated Successfully!');
    }
}
