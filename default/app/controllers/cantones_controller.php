<?php

    Load::models('cantones');

    //Index
    class CantonesController extends AppController
    {
        public function index($page=1)
        {
            View::template('estilos_rutas');
            $this->titulo = "Cantones - Index";
            $canton = new Cantones();
            $this -> lista_cantones = $canton -> getCantones($page);
        }

        //Create

        public function create()
        {
            View::template('estilos_rutas');
            $this->titulo = "Cantones - Create";

            if (Input::hasPost('cantones')) {
                $canton = new Cantones(Input::post('cantones'));

                if ($canton->create()) {
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
            $this -> titulo = "Cantones - Edit";
            $canton = new Cantones();

            if (Input::hasPost('cantones')) {

                if (!$canton->update(Input::post('cantones'))) {
                    Flash::error("No se pudo editar el registro, vuelva a intentarlo");
                }else{
                    Flash::valid("Registro actualizado");
                    return Redirect::to();
                }
            }else{
                $this->cantones = $canton->find((int)$id);
            }

        }

        //Delete

        public function del($id)
        {
            $canton = new Cantones();

            if (!$canton->delete((int)$id)) {
                Flash::error("El registro no pudo eliminarse, vuelva a intentarlo");
            }else {
                Flash::valid("Registro elminado");
            }
            return Redirect::to();
        }
    }
