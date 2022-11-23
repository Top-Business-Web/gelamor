<?php

namespace App\Http\Controllers\Admin\package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Http\Requests\StorePackagRequest;

class PackageController extends Controller
{
    public function index_hanging()
    {
        $packages = Package::get();
        return view('admin.packages.index_hanging', compact('packages'));
    }

    public function index_activated()
    {
        $packages = Package::get();
        return view('admin.packages.index_activated', compact('packages'));
    }

    public function store_hanging(StorePackagRequest $request)
    {
        $inputs = $request->all();

        if(Package::create($inputs))
        {
            toastr()->success(trans('messages.create_message_success'));
            return redirect()->route('package.index_hanging');
        }else
        {
            toastr()->error(trans('message.message_fail'));
            return redirect()->route('package.index_hanging');
        }
    }

    public function delete_hanging(Request $request)
    {
        $package = Package::find($request->id);
        $package->delete();
        toastr()->error(trans('messages.delete_message_success'));
        return redirect()->route('package.index_hanging');
    }

    // end store

    public function changeState(Request $request)
    {
        $package = Package::find($request->id);

        $package->update([
            'status' => $package->status == 'show' ? 'hide' : 'show',
        ]);
        toastr()->success('update successfully');

        return redirect()->back();
    }
    // end Change State


}