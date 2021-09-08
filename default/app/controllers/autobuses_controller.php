<?php

    Load::models('autobuses');

    //Index
    class AutobusesController extends AppController
    {
        public function index($page=1)
        {
            View::template('estilos_rutas');
            $this->titulo = "Autobuses - Index";
            $autobus = new Autobuses();
            $this -> lista_autobuses = $autobus -> getAutobuses($page);
        }

        //Create

        public function create()
        {
            View::template('estilos_rutas');
            $this->titulo = "Autobuses - Create";

            if (Input::hasPost('autobuses')) {
                $autobus = new Autobuses(Input::post('autobuses'));

                if ($autobus->create()) {
                    Flash::valid("Registro creado exitosamente");
                    Input::delete();
                    return Redirect::to();
                }
                Flash::error("Fallo al crear registro, vuelva a intentarlo");
            }
        }

        //Edit

        public function edit($Id)
        {
            View::template('estilos_rutas');
            $this -> titulo = "Autobuses - Edit";
            $autobus = new Autobuses();

            if (Input::hasPost('autobuses')) {

                if (!$autobus->update(Input::post('autobuses'))) {
                    Flash::error("No se pudo editar el registro, vuelva a intentarlo");
                }else{
                    Flash::valid("Registro actualizado");
                    return Redirect::to();
                }
            }else{
                $this->autobuses = $autobus->find((int)$Id);
            }

        }

        //Delete

        public function del($Id)
        {
            $autobus = new Autobuses();

            if (!$autobus->delete((int)$Id)) {
                Flash::error("El registro no pudo eliminarse, vuelva a intentarlo");
            }else {
                Flash::valid("Registro elminado");
            }
            return Redirect::to();
        }
    }

?>