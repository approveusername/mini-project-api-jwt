<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("file");
    }


    function sms_send(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://digimate.airtel.in:15443/BULK_API/SendMessage?loginID=sanyasi_ht1user&password=sanyasi%40123&mobile=8860692459&text=Welcome%20to%20Sanyasi%20Ayurveda%2C%20Please%20Verify%20your%20account%20using%20OTP%201234&senderid=SNYASI&DLT_TM_ID=1001096933494158&DLT_CT_ID=1007886324515395158&DLT_PE_ID=1001996761819717196&route_id=DLT_SERVICE_IMPLICT&Unicode=0&camp_name=sanyasi_tuser',
            CURLOPT_RETURNTRANSFER => true,
            /* CURLOPT_HTTPHEADER => array(
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36",
                "Accept-Language:en-US,en;q=0.5"
            ), */
            CURLOPT_VERBOSE =>true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            // CURLOPT_SSL_VERIFYHOST=>false,
            // CURLOPT_SSL_VERIFYPEER=>false,
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            return curl_error($curl);
        }
        curl_close($curl);
        return $response;

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
        $file = $request->file('photo');
        $request->validate([
            'photo' => 'required'
        ]);

        // $path = $file->store('images', 'public'); // storage/app/public/images me file uplaod krega (agr images folder nhi h to bna dega)
        // $path = $file->store('images', 'local'); // Or $file->store('images'); by default hota hai ye storage/app/images me file uplaod krega (agr images folder nhi h to bna dega) ye 
        // $path = $file->storeAs('images', $file->getClientOriginalName(), 'public'); // storage/app/public/images me file uplaod krega (agr images folder nhi h to bna dega)
        
        
        // Move the uploaded file to the resources/assets/images directory
        $imageName = $file->getClientOriginalExtension();
        $file->move(resource_path('assets/images'), $imageName);

        return redirect()->route('file.index')->with('success', 'uploaded');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
