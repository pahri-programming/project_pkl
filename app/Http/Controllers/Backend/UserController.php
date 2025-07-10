<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $title = 'Hapus Akun!';
        $text  = 'Apakah anda yakin ingin menghapus Akun ini?';
        confirmDelete($title, $text);

        return view('backend.akun.index', compact('users'));
    }

    public function create()
    {
        return view('backend.akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),

        ]);
        toast('Data Berhasil disimpan', 'success');
        return redirect()->route('backend.akun.index');
    }

    public function edit(User $user, $id)
    {
        $akun = User::findOrFail($id); 
        return view('backend.akun.edit', compact('akun'));
    }

    public function update(Request $request, $id)
    {
        $akun = User::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);
    
        $akun->name = $request->name;
        $akun->email = $request->email;
    
        if ($request->filled('password')) {
            $akun->password = Hash::make($request->password);
        }
    
        $akun->save();
    
        toast('Data akun berhasil diperbarui', 'success');
        return redirect()->route('backend.akun.index');
    }
    
    

    public function destroy(User $user, $id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.akun.index');
    }

}
