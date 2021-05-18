<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Notifications\NotifyInfoChanged;
use App\Notifications\NotifyPasswdChanged;
use App\Rules\checkPasswd;
use App\Rules\ChekEqualPasswd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $profile = $user->profile()->get()[0];
        $nomPrenom = $user->personne->prenom.' '.$user->personne->nom;
        $emailPerso = $user->email;
        $personne = $user->personne;
        $imagePath = $profile->imagePath;
        $croppedImage = $profile->croppedImage;
        return view('profile.profile',compact('personne','nomPrenom','emailPerso','profile','imagePath','croppedImage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function updateInfo(Request $request, Profile $profile)
    {
        $request->validate([
            'email'=>'nullable|email|unique:users',
            'adresse'=>'nullable|max:100',
            'facbook'=>'nullable|max:100',
            'dropbox'=>'nullable|max:100',
            'tel'=>'nullable|max:20'
        ]);
        // dd($request->all());
        if($request->input('email')){
            $profile->user->email = $request->input('email');
            $profile->user->sendEmailVerificationNotification();
        }
        if($request->input('facebook'))
        $profile->facebook = $request->input('facebook');
        if($request->input('dropbox'))
        $profile->dropbox = $request->input('dropbox');
        if($request->input('adresse'))
        $profile->user->personne->adressePersonnele = $request->input('adresse');
        if($request->input('tel'))
            $profile->user->personne->tel = $request->input('tel');

        $profile->user->personne->save();
        $profile->user->save();
        $profile->save();
        // $profile->user()->notify(new Ema)
        if($request->input('facebook') || $request->input('dropbox')  || $request->input('adresse') || $request->input('tel'))
            request()->user()->notify(new NotifyInfoChanged);

        return redirect()->back();
    }

    public function updatePasswd(Request $request)
    {
        $this->authorize('update', $request->user()->profile);
        // $request->validate([
        //     'current'=>['required', new checkPasswd($request->user())],
        //     'passwd'=>['required', new checkPasswd($request->user())],
        //     'retypedPasswd'=>['required'],
        //     // 'adresse'=>'required'
        // ]);
        $validator = Validator::make($request->all(),
            [
                'current'=>['required', new checkPasswd($request->user(),1)],
                'passwd'=>['required', new checkPasswd($request->user()), Password::min(8)],
                'retypedPasswd'=>['required',new ChekEqualPasswd($request->passwd)],            // 'adresse'=>'required'
            ],
            [
                'current.checkPasswd'=>'entrer votre mot de passe courant'
            ]
        );

        if($validator->fails()){
            // if($request->has('current') || $request->has('passwd') || $request->has('retypedPasswd'))
            return redirect('/profile/'.$request->user()->id.'?tab=passwd')
                    ->withErrors($validator)
                    ->withInput();
        }

        Auth::user()->password = bcrypt($request->passwd);
        request()->user()->save();
        request()->user()->notify(new NotifyPasswdChanged);
        return redirect('/profile/'.$request->user()->id.'?tab=passwd');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
    public function filePath(Request $request, string $inFileName)
    {
        $image_64 = $request->input($inFileName); //your base64 encoded data
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
        $replace = substr($image_64, 0, strpos($image_64, ',')+1);
      // find substring fro replace here eg: data:image/png;base64,
        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10).'.'.$extension;
        Storage::put('profiles/'.Auth::user()->getAuthIdentifier().'/'.$imageName , base64_decode($image));

        return 'storage/profiles/'.Auth::user()->getAuthIdentifier().'/'.$imageName;
    }

    public function updateImage(Request $request)
    {
        // dd($request->newImg);
        $this->authorize('update', $request->user()->profile);

    //     $image_64 = $request->input('img'); //your base64 encoded data
    //     $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
    //     $replace = substr($image_64, 0, strpos($image_64, ',')+1);
    //   // find substring fro replace here eg: data:image/png;base64,
    //     $image = str_replace($replace, '', $image_64);
    //     $image = str_replace(' ', '+', $image);
    //     $imageName = Str::random(10).'.'.$extension;
        // Storage::put('profiles/'.Auth::user()->getAuthIdentifier().'/'.$imageName , base64_decode($image));

        $profile = $request->user()->profile;

        // $profile->imagePath = 'storage/profiles/'.Auth::user()->getAuthIdentifier().'/'.$imageName;
        // $profile->croppedImage = 'storage/profiles/'.Auth::user()->getAuthIdentifier().'/'.$imageName;

        $profile->croppedImage = $this->filePath($request, 'img');

        if($request->has('newImg') && $request->newImg != null){
            // $request->user->profile->imagePath = $request->file('newImg');
            $profile->imagePath = $this->filePath($request, 'newImg');
        }

        $profile->save();

        return response()->json('Ok', 200);
    }
}
