<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Time;
use App\Models\Method;
use App\Models\Overtime;

class SettingController extends Controller
{
    public function index()
    {
        $time = Time::all();
        $type = Type::all();
        $overtime = Overtime::all();
        $method = Method::all();
        return view('settings.setting',compact('time','type','overtime','method'));
    }

    public function add_time(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:30',
        ]);  
        
        Time::create([
            'jenis' => $request->jenis,
        ]);

        return redirect()->back()->with('success', 'Shift berhasil ditambahkan');
    }

    public function del_time($id)
    {
        $shift = Time::find($id);
        $shift->delete();

        return redirect()->back()->with('success', 'Shift berhasil dihapus');
    }

     public function add_type(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:30',
        ]);  
        
        Type::create([
            'jenis' => $request->type,
        ]);

        return redirect()->back()->with('success', 'Shift berhasil ditambahkan');
    }

    public function del_type($id)
    {
        $type = Type::find($id);
        $type->delete();
        return redirect()->back()->with('success', 'Shift berhasil dihapus');
    }

    public function add_method(Request $request)
    {
        $request->validate([
            'method' => 'required|string|max:30',
        ]);  
        
        Method::create([
            'jenis' => $request->method,
        ]);

        return redirect()->back()->with('success', 'Data Metode berhasil ditambahkan');
    }

    public function del_method($id)
    {
        $type = Method::find($id);
        $type->delete();
        return redirect()->back()->with('success', 'Data Metode berhasil dihapus');
    }

    public function add_overtime(Request $request)
    {
        $request->validate([
            'overtime' => 'required|string|max:30',
        ]);  
        
        Overtime::create([
            'jenis' => $request->overtime,
        ]);

        return redirect()->back()->with('success', 'Data Overtime berhasil ditambahkan');
    }

    public function del_overtime($id)
    {
        $type = Overtime::find($id);
        $type->delete();
        return redirect()->back()->with('success', 'Data Overtime berhasil dihapus');
    }
}
