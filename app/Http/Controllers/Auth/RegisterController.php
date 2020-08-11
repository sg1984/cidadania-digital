<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\NewRegister;
use App\Providers\RouteServiceProvider;
use App\Ticket;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->check() || !auth()->user()->isAdmin()) {
                return redirect($this->redirectTo);
            }

            return $next($request);
        });
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    protected function create(Request $request)
    {
        $password = $request->get('password');
        $email = $request->get('email');
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $email,
            'password' => Hash::make($password)
        ]);
        $user->subjects()->attach(
            $request->get('subject_id'),
            [
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]
        );
        $users = User::paginate(20);
        $tickets = Ticket::query()
            ->byResponsibleUser(auth()->user())
            ->byStatus([Ticket::STATUS_OPEN, Ticket::STATUS_IN_PROGRESS])
            ->paginate(10);

        Mail::to($email)
            ->send(new NewRegister($user, $password));

        return view('auth.index', compact('users', 'tickets'))->with('success', 'Pesquisador incluído com sucesso');;
    }

    /**
     * @return Factory|View
     */
    public function showUsers()
    {
        $users = User::paginate(20);
        $tickets = Ticket::query()
            ->byResponsibleUser(auth()->user())
            ->byStatus([Ticket::STATUS_OPEN, Ticket::STATUS_IN_PROGRESS])
            ->paginate(10);

        return view('auth.index', compact('users', 'tickets'));
    }

    /**
     *
     * Show the form for editing the specified user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editUser(int $userId)
    {
        $user = User::find($userId);

        return view('auth.edit', compact('user'));
    }

    /**
     * @param Request $request
     * @return Factory|View
     * @throws \Exception
     */
    protected function updateUser(Request $request)
    {
        $user = User::find($request->get('user_id'));
        $oldSubjects = $user->subjects()->pluck('id');
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
        $user->subjects()->detach($oldSubjects);
        $user->subjects()->attach(
            $request['subject_id'],
            [
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]
        );
        $users = User::paginate(20);
        $tickets = Ticket::query()
            ->byResponsibleUser(auth()->user())
            ->byStatus([Ticket::STATUS_OPEN, Ticket::STATUS_IN_PROGRESS])
            ->paginate(10);

        return redirect()->to('auth.index', compact('users', 'tickets'))->with('success', 'Documento atualizado com sucesso');;
    }

    /**
     * @param int $userId
     * @return Application|Factory|View
     */
    protected function toggleStatus(int $userId)
    {
        $user = User::find($userId);
        $new_is_active_status = ! $user->is_active;
        $user->update([
            'is_active' => $new_is_active_status
        ]);
        $users = User::paginate(20);
        $tickets = Ticket::query()
            ->byResponsibleUser(auth()->user())
            ->byStatus([Ticket::STATUS_OPEN, Ticket::STATUS_IN_PROGRESS])
            ->paginate(10);

        return view('auth.index', compact('users', 'tickets'))->with('success', 'Documento atualizado com sucesso');;
    }
}
