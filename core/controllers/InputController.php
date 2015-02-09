<?php
class InputController extends Controller {

    public function __construct()
    {
        if (Auth::check()) {
            $this->data['user'] = Auth::user();
        }
    }

    public function add($formId)
    {
        $this->data['form'] = Formr::findOrFail($formId);

        $this->data['params']['formId'] = $formId;

        return View::make('admin.formr.inputs.create', $this->data);
    }

    /**
     * 
     *
     * A FINIR :
     * BUG DETECTE : LE DERNIER CHECKBOX DE LA PAGE CONTACT NE VEUT PAS REMONTER /!\
     * 
     * @param  [type] $formId    [description]
     * @param  [type] $inputId   [description]
     * @param  [type] $direction [description]
     * @return [type]            [description]
     */
    public function move($formId, $inputId, $direction)
    {
        $form = Formr::findOrFail($formId);
        $input = FormMap::where('input_id', $inputId)
                    ->firstOrFail();

        if ($direction == "up") {
            if ($input->order > 1) {
                // Récupere le précédent
                $prevInput = FormMap::where('form_id', $formId)
                    ->where('order', $input->order-1)
                    ->firstOrFail();

                // On descend le suivant
                $prevInput->order = $input->order;
                $prevInput->save();
                // Et on remonte celui qu'on veut remonter
                $input->order = $input->order-1;
                $input->save();
                return Redirect::back()->with('success', "L'ordre a été changé");
            } else {
                return Redirect::back()->with('error', "Cet Input est déjà au plus haut");
            }
        } else {
            // Récupere le suivant
            $nextInput = FormMap::where('form_id', $formId)
                    ->where('order', $input->order+1)
                    ->firstOrFail();
            // On remonte le suivant
            $nextInput->order = $input->order;
            $nextInput->save();
            // Et on descend celui qu'on veut descendre
            $input->order = $input->order+1;
            $input->save();
            return Redirect::back()->with('success', "L'ordre a été changé");
        }

        $this->data['params']['formId'] = $formId;
    }

}