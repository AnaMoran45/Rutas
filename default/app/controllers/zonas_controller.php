<?php 
    
 Load::models('zonas');

    class zonasController extends AppController
    {
        public function index($page=1) 
        {
            View::template('estilos_rutas');
            $this->titulo = "zonas";
            $zonas = new zonas();
            $this->Listazonas = $zonas->getzonas($page);
        }

        //create 

        public function create()
        {
            View::template('estilos_rutas');
            $this->titulo = "zonas";
            if (input::hasPost('zonas')) {
                $zonas = new zonas(Input::post('zonas'));
                if ($zonas->save()) {
                    Flash::Valid("zona agregada correctamente");
                    Input::delete();
                    return Redirect::to();
                }
                Flash::error("error al crear zona");
            }
        }

        //edit

        public function edit($id)
        {
            View::template('estilos_rutas');
            $this->titulo ="zonas";
            $zonas = new zonas();
            if (Input::hasPost('zonas')) {

                if(!$zonas->update(Input::post('zonas'))) {
                    Flash::error("error al editar vuelva a intentar");
                }else {
                    Flash::valid("creado zona exitosamente");
                    return Redirect::to();
                }
                
            }else{
                $this->zonas = $zonas->find((int)$id);
            }
        }
        
        //delete

        public function del($id)
        {

            $zonas = new zonas();
            if(!$zonas->delete((int)$id)){
                Flash::error("error al ingesar la zona");
            }else{
                Flash::valid("ingresado con exito");
            }
            return Redirect::to();
        }
    }   
?>