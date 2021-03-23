@extends('layouts.main')

@section('content')

    <link rel="stylesheet" href={{asset('assets/css/congratulation.css')}}>

    <div id = "container">
        <div id= "center">
            <div style="display:flex;justify-content: center;">
               <div id="check_mark">
                   ✔
               </div>
            </div>
            <hr>
            <p id="thanks">Thank you!</p>
            <p class="text-item"><b>Cod Of Order: <i>44</i> </b></p>
            <p class="text-item" style="color:gray;font-weight: 700;">You can find information in list of purchases</p>
            <form style="text-align: center;" action="{{asset('/boughtanswer')}}">
               <button id="return"name="back" value="back" type="submit">Back To Purchases</button>
            </form>
        </div>
    </div>
@endsection
    