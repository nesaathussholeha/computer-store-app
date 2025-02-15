<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Member::with('user');

        // Pencarian berdasarkan nama, email, atau alamat
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                ->orWhere('address', 'like', "%$search%")
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('email', 'like', "%$search%");
                });
        }

        // Paginasi
        $members = $query->paginate(10);

        return view('cashier.member.index', compact('members'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {

        // Buat user dengan password default jika tidak diberikan
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password ?? 'password'),
            'role' => 'member'
        ]);

        // Simpan ke tabel members
        Member::create([
            'address' => $request->address,
            'telp' => $request->telp,
            'user_id' => $user->id
        ]);

        return redirect()->route('member.index')->with('success', 'Member berhasil ditambahkan!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, $id)
    {
        $member = Member::findOrFail($id);
        $user = $member->user; // Ambil user terkait

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User tidak ditemukan!']);
        }

        // Update data di tabel users
        $user->update([
            'name' => $request->name,  // Perbarui nama user
            'email' => $request->email, // Perbarui email user
        ]);

        // Update data di tabel members (Hapus update 'name')
        $member->update([
            'address' => $request->address,
            'telp' => $request->telp,
        ]);

        return redirect()->back()->with('success', 'Member berhasil diperbarui!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $user = $member->user; // Ambil user terkait

        // Hapus member terlebih dahulu
        $member->delete();

        // Hapus user jika tidak digunakan di tempat lain
        if ($user) {
            $user->delete();
        }

        return redirect()->back()->with('success', 'Member berhasil dihapus!');
    }
}
