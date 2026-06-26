<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'           => 'required|string',
            'email'          => 'required|email|unique:users',
            'year_level'     => 'required|string',
            'department'     => 'required|string',
            'age'            => 'required|integer',
            'birthday'       => 'required|date',
            'contact_number' => 'required|string',
        ]);

        $user = User::create($request->all());

        return response()->json([
            'message' => 'User registered successfully',
            'user'    => $user
        ], 201);
    }
    public function index()
    {
        return response()->json(User::all());
    }
    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

    return response()->json([
        'message'=> 'Updated Successfully',
        'user'=> $user
        ],);
    }
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    return response()->json([
        'message'=> 'Student has been Kicked Out'
        ],);}
}
