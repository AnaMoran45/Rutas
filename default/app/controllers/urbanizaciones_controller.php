<?php 
    
 Load::models('urbanizaciones');

    class urbanizacionesController extends AppController
    {
        public function index($page=1) 
        {
            View::template('estilos_rutas');
            $this->titulo = "urbanizaciones";
            $urbanizaciones = new urbanizaciones();
            $this->Listaurbanizaciones = $urbanizaciones->geturbanizaciones($page);
        }

        //create 

        public function create()
        {
            View::template('estilos_rutas');
            $this->titulo = "urbanizaciones";
            if (input::hasPost('urbanizaciones')) {
                $urbanizaciones = new urbanizaciones(Input::post('urbanizaciones'));
                if ($urbanizaciones->save()) {
                    Flash::Valid("urbanizacion agregada correctamente");
                    Input::delete();
                    return Redirect::to();
                }
                Flash::error("error al crear la urbanizacion");
            }
        }

        //edit

        public function edit($id)
        {
            View::template('estilos_rutas');
            $this->titulo ="urbanizaciones";
            $urbanizaciones = new urbanizaciones();
            if (Input::hasPost('urbanizaciones')) {

                if(!$urbanizaciones->update(Input::post('urbanizaciones'))) {
                    Flash::error("error al editar vuelva a intentar");
                }else {
                    Flash::valid("creado urbanizacion exitosamente");
                    return Redirect::to();
                }
                
            }else{
                $this->urbanizaciones = $urbanizaciones->find((int)$id);
            }
        }
        
        //delete

        public function del($id)
        {

            $urbanizaciones = new urbanizaciones();
            if(!$urbanizaciones->delete((int)$id)){
                Flash::error("error al ingesar la urbanizacion");
            }else{
                Flash::valid("ingresado con exito");
            }
            return Redirect::to();
        }
    }   
?>