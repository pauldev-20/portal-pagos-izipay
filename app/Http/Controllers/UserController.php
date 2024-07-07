<?php

namespace App\Http\Controllers;

use App\Helpers\AuthenticableOdoo;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\createRequestUnit;
use App\Http\Requests\User\DeleteRequest;
use App\Http\Requests\User\updatePasswordRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['createBacth', 'create']);
    }

    public function createBacth(CreateRequest $request)
    {
        if (!$request->hasHeader('Authorization')) {
            return response()->json([
                'message' => 'No autorizado',
            ], 401);
        }

        if (!AuthenticableOdoo::authorizedPeticion($request->header('Authorization'))) {
            return response()->json([
                'message' => 'No autorizado',
            ], 401);
        }
        try {
            $data = $request->input('ciudadanos');
            foreach ($data as $key => $value) {
                $data[$key]['password'] = Hash::make($value['dni']);
            }

            DB::beginTransaction();
            User::insert($data);
            DB::commit();

            return response()->json([
                'message' => 'Usuario registrados correctamente',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al registrar los usuarios',
            ], 500);
        }
    }

    public function create(createRequestUnit $request)
    {
        if (!$request->hasHeader('Authorization')) {
            return response()->json([
                'message' => 'No esta autorizado para realizar esta acción',
            ], 401);
        }

        if (!AuthenticableOdoo::authorizedPeticion($request->header('Authorization'))) {
            return response()->json([
                'message' => 'No autorizado',
            ], 401);
        }

        $user = new User;
        $user->createModel($request);

        return response()->json([
            'message' => 'Usuario registrado correctamente',
        ], 201);
    }

    public function update(UpdateRequest $request)
    {
        try {
            $user = User::findOrFail(Auth::user()->id);

            $user->updateModel($request);

            return redirect()->route('profile')->with('success', 'Datos actualizados correctamente');
        } catch (\Exception $e) {
            return redirect()->route('profile')->with('error', 'Error al actualizar el usuario');
        }
    }

    public function updatePassword(updatePasswordRequest $request)
    {
        try {
            $auth = Auth::user();

            if (!Hash::check($request->get('password_actually'), $auth->password)) {
                return back()->with('error', "Contraseña actual incorrecta");
            }

            if (strcmp($request->get('password_actually'), $request->password) == 0) {
                return redirect()->back()->with("error", "La nueva contraseña no puede ser igual a la contraseña actual.");
            }

            $user =  User::find($auth->id);
            $user->password =  Hash::make($request->password);
            $user->save();
            return back()->with('success', "Contraseña actualizada correctamente");
        } catch (\Exception $e) {
            return redirect()->route('profile')->with('error', 'Error al actualizar la contraseña');
        }
    }

    public function delete(DeleteRequest $request)
    {
        try {
            $user = User::findOrFail($request->id);
            if ($user->deleteModel()) {
                return response()->json([
                    'message' => 'Usuario eliminado correctamente',
                ], 200);
            }
            return response()->json([
                'message' => 'Error al eliminar el usuario',
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el usuario',
            ], 500);
        }
    }

    public function showProfile()
    {
        return view('profile');
    }
}
