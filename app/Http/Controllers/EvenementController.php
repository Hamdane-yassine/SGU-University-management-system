<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile as HttpUploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use ZipArchive;

use function PHPSTORM_META\map;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evenements = Evenement::latest()->paginate(5);
        return view('evenements.index', compact('evenements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('evenements.event-editor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $files = $request->file('attachments');
        $files = $request->file('attachments');
        $headingImg = '';
        $request->validate([
            'date'=>'date|required',
            'resume'=>'required',
            'corps'=>'required',
            'attachments.*'=>'file|mimes:png,jpg,pdf|max:20000',
            'attachments'=>'max:3',
            ],
            ['attachments.max'=>'vous avez uploader plus que 3 fichiers']
        );
        $evenement = Evenement::create([
            'ID_chef'=>auth()->user()->getAuthIdentifier(),
            'titre'=>$request->input('titre'),
            'date'=>$request->input('date'),
            'html'=>$request->input('corps'),
            'resume'=>$request->input('resume'),
        ]);
        // dd($request->file('attachments'));
        if(is_array($request->file('attachments'))){
            if(count($request->file('attachments')) > 1){
                $filePaths = array();
                foreach ($files as $file) {
                    // $filePaths .= array_push($file->store('attachments/'.$evenement->idEvenement));
                    if(preg_match('/(headingImg)/',$file->getClientOriginalName()))
                        $headingImg = $file->storeAs('evenements/'.$evenement->idEvenement.'/attachements',$file->getClientOriginalName());
                    else
                        array_push($filePaths,$file->storeAs('evenements/'.$evenement->idEvenement.'/attachements',$file->getClientOriginalName()));
                }
                $evenement->attachments = $filePaths;
            }
            else if(count($request->file('attachments')) == 1){
                if(preg_match('/(headingImg)/',$request->file('attachments')[0]->getClientOriginalName()))
                    $headingImg = $request->file('attachments')[0]->storeAs('evenements/'.$evenement->idEvenement.'/attachements',$request->file('attachments')[0]->getClientOriginalName());
                else
                    $evenement->attachments = array($request->file('attachments')[0]->storeAs('evenements/'.$evenement->idEvenement.'/attachements',$request->file('attachments')[0]->getClientOriginalName()));
            }
        }
        $evenement->headingImg = $headingImg;
        $evenement->save();
        // $files->store('attachments/'.$evenement->idEvenement);
        return redirect('/evenement/'.$evenement->idEvenement);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function show(Evenement $evenement)
    {
        $attachments = array();
        $attArr = json_decode($evenement->attachments);
        $headingImg = $evenement->headingImg;
        $attachments= array($evenement->attachments);
        // if($attArr){
        //     if(count($attArr) > 0){
        //         foreach ($attArr as $key) {
        //             if(preg_match('/.(jpg|jpeg|png|csv|txt|zip|csv|excel|pdf)/i',$key)){
        //                 array_push($attachments, $key);
        //             }
        //         }
        //     }
        // }
        // dd($attachments);
        return view('evenements.event-detail', compact('evenement','attachments','headingImg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function edit(Evenement $evenement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evenement $evenement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evenement $evenement)
    {
        //
    }

    public function downloadAttachements(Evenement $evenement)
    {
        $files = File::files(public_path('storage/evenements/2/attachements'));

        $zip = new ZipArchive;

        $fileName = '/storage/temp/Example.zip';
        //if smthing went wrog back to last modif
        if ($zip->open(public_path($fileName), ZipArchive::CREATE|ZipArchive::OVERWRITE) === TRUE)
        {

        foreach ($files as $key => $value) {
            $file = basename($value);
            $zip->addFile($value, $file);
        }

        $zip->close();
        }

        return response()->download(public_path($fileName));
    }
}
