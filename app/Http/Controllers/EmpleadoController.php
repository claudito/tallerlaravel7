<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use DB;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
            try {
                

              if( $request->ajax() ) {


                  $result = Empleado::select(DB::raw("

                       id,
                       name,
                       position,
                       office,
                       age,
                       DATE_FORMAT(start_date,'%d/%m/%Y') start_date,
                       salary

                
                  "))->get();

                return array( 'data'=>$result );



             }   


                return view('empleados.index');


            } catch (\Illuminate\Database\QueryException $e) {


               // return $e->getMessage();

                return  array(

                    'title' => 'Error',
                    'text'  => $e->getMessage(),
                    'icon'  => 'error'

                );


            }



            //return view('empleados.index');

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

        //dd( $request->all() );
       /* Empleado::create([

            'name'          => $request->name,
            'position'      => $request->position,
            'office'        => $request->office,
            'age'           => $request->age,
            'start_date'    => $request->start_date,
            'salary'        => $request->salary

        ]);*/

        try {
            

             Empleado::updateOrCreate(

                        ['id'=>$request->id],//Campos de verificación para crear o actualizar

                        //Valores de registro o actualización
                        [

                            'name'          => $request->name,
                            'position'      => $request->position,
                            'office'        => $request->office,
                            'age'           => $request->age,
                            'start_date'    => $request->start_date,
                            'salary'        => $request->salary

                      ]

                );

        $text  = ( isset($request->id) ) ? 'Registro Actualizado' : 'Registro Agregado' ;

        return array(  

            'title' => 'Buen Trabajo',
            'text'  =>  $text,
            'icon'  => 'success'


        );





        } catch (\Illuminate\Database\QueryException $e) {


             return  array(

                    'title' => 'Error',
                    'text'  => $e->getMessage(),
                    'icon'  => 'error'

                );
            
        }


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

           $result = Empleado::where('id',$id)->first();

               // $result = Empleado::find($id);

            //$result = Empleado::firstWhere('id', $id);

            return $result;



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

        Empleado::where('id',$id)->delete();



          return array(  

            'title' => 'Buen Trabajo',
            'text'  => 'Registro Eliminado',
            'icon'  => 'success'


        );


    }
}
