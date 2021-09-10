<?php 
Load::models('municipios');

class MunicipiosController extends AppController
{
    public function index($page=1) 
    {
        View::template('estilos_rutas');
        $this->titulo = "Municipios";
        $municipio = new Municipios();
        $this->listaMunicipios = $municipio->getMunicipios($page);
    }

    //create 

    public function create()
    {
        View::template('estilos_rutas');
        $this->titulo = "municipios";
        if (input::hasPost('municipios')) {
            $municipio = new Municipios(Input::post('municipios'));
            if ($municipio->save()) {
                Flash::Valid("municipio agregado correctamente");
                Input::delete();
                return Redirect::to();
            }
            Flash::error("error al crear municipio");
        }
    }

    //edit

    public function edit($id)
    {
        View::template('estilos_rutas');
        $this->titulo ="municipios";
        $municipio = new Municipios();
        if (Input::hasPost('municipios')) {

            if(!$municipio->update(Input::post('municipios'))){
                Flash::error("error al editar municipios");
            } else {
                Flash::valid("creado municipio exitosamente");
                return Redirect::to();
            }
        }else{
            $this->municipios = $municipio->find((int)$id);
        }
    }

    //delete

    public function del($id){
        $municipio = new Municipios();
        if(!$municipio->delete((int)$id)){
            Flash::error("error al ingesar el municipio");
        }else{
            Flash::valid("ingresado con exito");
        }
        return Redirect::to();
    }
}
