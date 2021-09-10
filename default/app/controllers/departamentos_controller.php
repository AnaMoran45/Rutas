<?php 
Load::models('departamentos');

class DepartamentosController extends AppController
{
    public function index($page=1) 
    {
        View::template('estilos_rutas');
        $this->titulo = "Departamentos";
        $departamento = new Departamentos();
        $this->ListaDepartamentos = $departamento->getDepartamentos($page);
    }

    //create 

    public function create()
    {
        View::template('estilos_rutas');
        $this->titulo = "Departamentos";
        if (input::hasPost('departamentos')) {
            $departamento = new Departamentos(Input::post('departamentos'));
            if ($departamento->save()) {
                Flash::Valid("departamento agregado correctamente");
                Input::delete();
                return Redirect::to();
            }
            Flash::error("error al crear departamento");
        }
    }

    //edit

    public function edit($id)
    {
        View::template('estilos_rutas');
        $this->titulo ="departamentos";
        $departamento = new Departamentos();
        if (Input::hasPost('departamentos')) {

            if(!$departamento->update(Input::post('departamentos'))){
                Flash::error("error al editar departamentos");
            } else {
                Flash::valid("creado departamento exitosamente");
                return Redirect::to();
            }
        }else{
            $this->departamentos = $departamento->find((int)$id);
        }
    }

    //delete

    public function del($id){
        $departamento = new Departamentos();
        if(!$departamento->delete((int)$id)){
            Flash::error("error al ingesar el departamento");
        }else{
            Flash::valid("ingresado con exito");
        }
        return Redirect::to();
    }
}
