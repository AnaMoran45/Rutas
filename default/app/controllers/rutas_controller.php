<?php

    Load::models('rutas');

    //Index
    class rutasController extends AppController
    {
        public function index($page=1)
        {
            View::template('estilos_rutas');
            $this->titulo = "rutas - Index";
            $rutas = new rutas();
            $this -> listarutas = $rutas -> getrutas($page);
        }

        //Create

        public function create()
        {
            View::template('estilos_rutas');
            $this->titulo = "rutas - Create";

            if (Input::hasPost('rutas')) {
                $rutas = new rutas(Input::post('rutas'));

                if ($rutas->create()) {
                    Flash::valid("Registro creado exitosamente");
                    Input::delete();
                    return Redirect::to();
                }
                Flash::error("Fallo al crear registro, vuelva a intentarlo");
            }
        }

        //Edit

        public function edit($id)
        {
            View::template('estilos_rutas');
            $this -> titulo = "rutas - Edit";
            $rutas = new rutas();

            if (Input::hasPost('rutas')) {

                if (!$rutas->update(Input::post('rutas'))) {
                    Flash::error("No se pudo editar el registro, vuelva a intentarlo");
                }else{
                    Flash::valid("Registro actualizado");
                    return Redirect::to();
                }
            }else{
                $this->rutas = $rutas->find((int)$id);
            }

        }

        //Delete

        public function del($id)
        {
            $rutas = new rutas();

            if (!$rutas->delete((int)$id)) {
                Flash::error("El registro no pudo eliminarse, vuelva a intentarlo");
            }else {
                Flash::valid("Registro elminado");
            }
            return Redirect::to();
        }
    }

?>