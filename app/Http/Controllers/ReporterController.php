<?php

namespace App\Http\Controllers;

use App\Models\Reporter;
use Illuminate\Http\Request;

class ReporterController extends Controller
{
    public function index()
    {
        return view('admin.reporter.index');
    }

    public function purchases()
    {
        return view('admin.reporter.purchases');
    }

    public function clientPurchases()
    {
        return view('admin.reporter.clientPurchases');
    }

    public function daySales()
    {
        return view('admin.reporter.daySales');
    }

    public function monthSales()
    {
        return view('admin.reporter.monthSales');
    }

    public function filterSales()
    {
        return view('admin.reporter.filterSales');
    }
}
