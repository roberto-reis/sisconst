<?php

namespace App\Http\Controllers\Sistema\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(12);
        $loggedId = intval(Auth::id());

        return view('sistema.admin.usuarios', [
            'users' => $users,
            'loggedId' => $loggedId
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
            'password_confirmation',
            'nivel'

        ]);

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nivel' => ['required', 'string', 'max:20'],
        ]);

        if($validator->fails()) {
            return redirect()->route('usuarios.index')
            ->withErrors($validator)
            ->withInput();
        }

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->nivel = $data['nivel'];
        $user->save();

        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if($user) {
            return view('sistema.admin.edit', [
                'user'=>$user
            ]);
        }
        
        return redirect()->route('usuarios.index');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($user) {
            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation',
                'nivel'
    
            ]);
            $validator = Validator::make(
                [
                    'name'=>$data['name'],
                    'email'=>$data['email'],
                    'nivel'=>$data['nivel']
                ],
                [
                    'name'=>['required', 'string', 'max:50'],
                    'email'=>['required', 'string', 'email', 'max:50'],
                    'nivel'=>['required', 'string', 'max:50']
                ]
            );

            // Alteração do nome
            $user->name = $data['name'];

            // Alteração de nivel user
            $user->nivel = $data['nivel'];

            //Alteração do email
            if($user->email != $data['email']){
                $hasEmail = User::where('email', $data['email'])->get();
                if(count($hasEmail) === 0) {
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', __('validation.unique', [
                        'attribute' => 'email'
                    ]));
                }
            }

            // Alteração da Senha
            if(!empty($data['password'])) {
                if(strlen($data['password']) >= 8) {
                    if($data['password'] === $data['password_confirmation']) {
                        $user->password = Hash::make($data['password']);
                    } else {
                        $validator->errors()->add('password', __('validation.confirmed', [
                            'attribute' => 'password'
                        ]));
                    }
                } else {
                    $validator->errors()->add('password', __('validation.min.string', [
                        'attribute' => 'password',
                        'min' => 8
                    ]));
                }
            }

            if(count( $validator->errors() ) > 0) {
                return redirect()->route('usuarios.edit', $id
                )->withErrors($validator);
            }

            $user->save();

            return redirect()->route('usuarios.index')->with('messagem_sucesso', 'Usuário alterado com sucesso!');
        }
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loggedId = intval(Auth::id());        

        if($loggedId !== intval($id)) {
            $user = User::find($id);
            $user->delete();
        }

        return redirect()->route('usuarios.index');
    }
}
