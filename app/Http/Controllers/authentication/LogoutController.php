<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LogoutController extends Controller
{
    // this logout is for normal buyer
    public function buyerLogout(Request $request){
        auth()->guard('buyer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('homePage')->with('success','Buyer logout successfully.');
    }

    // this logout is for normal buyer
    public function supplierLogout(Request $request){
        auth()->guard('supplier')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('homePage')->with('success','Supplier logout successfully.');

        // return 'supplier logout successfully';
    }

    // this logout is for admin
    public function adminLogout(Request $request){
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('homePage')->with('success','Admin logout successfully.');

    }
}
