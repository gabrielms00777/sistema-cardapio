<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Table;
use Illuminate\Support\Carbon;
use Livewire\Component;

class ReportDashboard extends Component
{
    public $startDate;

    public $endDate;

    public $selectedReport = 'daily';

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->toDateString();
        $this->endDate = Carbon::now()->toDateString();
    }

    public function render()
    {
        $data = $this->generateReportData();

        return view('livewire.report-dashboard', ['data' => $data]);
    }

    public function generateReportData()
    {
        switch ($this->selectedReport) {
            case 'daily':
                return Order::whereBetween('created_at', [$this->startDate, $this->endDate])
                    ->where('status', 'paid')
                    ->selectRaw('DATE(created_at) as date, SUM(total_price) as total_sales')
                    ->groupBy('date')
                    ->get();
            case 'tables':
                return Table::withCount('orders')->get();
            default:
                return [];
        }
    }
}
